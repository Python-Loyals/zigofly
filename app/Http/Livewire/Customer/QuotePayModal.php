<?php

namespace App\Http\Livewire\Customer;

use App\Events\StkResponse;
use Livewire\Component;
use Safaricom\Mpesa\Mpesa;

class QuotePayModal extends Component
{
    public $quote, $phone;

    const CONVERSION_AMOUNT = 110;

    protected $rules = [
        'phone' => ['required', 'regex:/^(0|\+?254)(\d){9}$/'],
    ];

    public function mount($quote)
    {
        $this->quote = $quote;
        $this->phone = \Auth::user()->phone;
    }
    public function render()
    {
        return view('livewire.customer.quote-pay-modal');
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
        $AccountReference = 'ZFQ-'.$this->quote->id;
        $TransactionDesc = 'test';
        $Remarks = 'test';
        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType,
            $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        $temp = json_decode($stkPushSimulation, true);
        if (isset($temp['errorMessage']) || $temp['ResponseCode'] != 0){
            $this->emit('stk_error', ['message' => $temp['errorMessage']]);
        }elseif(isset($temp['ResponseCode']) ){
            $this->emit('stk_success', ['message' => 'Your withdrawal request was received and is being processed']);
        }
        event(new StkResponse(\Auth::id()));
    }

    private function generatePassword()
    {
        $BusinessShortCode = '174379';
        $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $Timestamp = date('YmdHis');

        return base64_encode($BusinessShortCode.$Passkey.$Timestamp);
    }
}
