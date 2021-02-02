<?php

namespace App\Http\Livewire\Customer;

use Gloudemans\Shoppingcart\Cart;
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

        $this->phone = preg_replace('/^(0|\+?254)/', '254', $this->phone);

        $mpesa = new Mpesa();
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = self::CONVERSION_AMOUNT;
        $PartyA = $this->phone;
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $this->phone;
        $CallBackURL= 'https://peternjeru.co.ke/safdaraja/api/callback.php';
        $AccountReference = 'ZF0-';
        $TransactionDesc = 'test';
        $Remarks = 'test';
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType,
            $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        $temp = json_decode($stkPushSimulation, true);
        if (isset($temp['errorMessage']) || $temp['ResponseCode'] != 0){
            $this->emit('stk_error', ['message' => $temp['errorMessage']]);
        }elseif(isset($temp['ResponseCode']) ){
            $this->emit('stk_success', ['message' => 'A payment request has been sent to your phone.']);
        }
    }
}
