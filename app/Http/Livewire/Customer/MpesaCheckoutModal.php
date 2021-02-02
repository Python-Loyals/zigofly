<?php

namespace App\Http\Livewire\Customer;

use App\Checkout;
use App\StkRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Safaricom\Mpesa\Mpesa;

class MpesaCheckoutModal extends Component
{
    public $phone;

    const CONVERSION_AMOUNT = 110;

    protected $rules = [
        'phone' => ['required', 'regex:/^(0|\+?254)(\d){9}$/'],
    ];

    public function mount()
    {
        $this->phone = \Auth::user()->phone;
    }

    public function render()
    {
        return view('livewire.customer.mpesa-checkout-modal');
    }

    public function pay()
    {
        $this->validate();

        $checkout = Checkout::create([
            'user_id' => \Auth::id(),
            'amount' => Cart::total() * self::CONVERSION_AMOUNT
        ]);

        $this->phone = preg_replace('/^(0|\+?254)/', '254', $this->phone);

        $mpesa = new Mpesa();
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
//        $Amount = Cart::total() * self::CONVERSION_AMOUNT;
        $Amount = 1;
        $PartyA = $this->phone;
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $this->phone;
        $CallBackURL= route('api.mpesa.order.stk_callback');
        $AccountReference = 'ZFO-'.$checkout->id;
        $TransactionDesc = 'test';
        $Remarks = 'test';
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType,
            $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        $temp = json_decode($stkPushSimulation, true);
        if (isset($temp['errorMessage']) || $temp['ResponseCode'] != 0){
            $this->emit('stk_error', ['message' => $temp['errorMessage']]);
        }elseif(isset($temp['ResponseCode']) ){
            $stk_request = StkRequest::create([
                'request_id' => $temp['CheckoutRequestID'],
                'msisdn' => $this->phone,
                'bill_ref_number' => $AccountReference,
                'amount'    => $Amount
            ]);
            $this->emit('stk_success', ['message' => 'A payment request has been sent to your phone.']);
        }
    }
}
