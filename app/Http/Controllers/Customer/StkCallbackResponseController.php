<?php

namespace App\Http\Controllers\Customer;

use App\Events\StkResponse;
use App\Http\Controllers\Controller;
use App\Quote;
use App\StkRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StkCallbackResponseController extends Controller
{
    public function index(Request $request)
    {
        $response = $request->all();
        $response = $response['Body'];
        $request_id = $response['stkCallback']['CheckoutRequestID'];
        $response_code = $response['stkCallback']['ResultCode'];
        $response_desc = $response['stkCallback']['ResultDesc'];
        $merchant_request_id = $response['stkCallback']['MerchantRequestID'];

        $stkRequest = StkRequest::where('request_id', '=', $request_id)->first();

        if (!$stkRequest){
            return response()->json([
                'error' => 'That\'s not gonna work'
            ], Response::HTTP_NOT_FOUND);
        }

        $quoteId = array_filter(explode('ZFQ-', $stkRequest->bill_ref_number))[1];
        $quote = Quote::find($quoteId);

        //if quote does not exist
        if (!$quote){
            return response()->json([
                'error' => 'Tha quote does not exist'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($response_code == 0){
            $amount = $response['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
            $receipt = $response['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
            $phone = $response['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
            $stkRequest->response()->updateOrCreate([],[
                'merchant_request_id' => $merchant_request_id,
                'phone_number' => $phone,
                'receipt_number' => $receipt,
                'amount' => $amount,
                'result_code' => $response_code,
                'result_description' => $response_desc
            ]);
            $stkRequest->update(['paid' => 1]);

            $message = 'Your payment for '.$stkRequest->bill_ref_number.' was successful.';

            event(new StkResponse($quote->customer->id, $message));
        }else{
            $stkRequest->response()->updateOrCreate([],[
                'merchant_request_id' => $merchant_request_id,
                'result_code' => $response_code,
                'result_description' => $response_desc
            ]);

            event(new StkResponse($quote->customer->id, $response_desc, true));
        }

        return $stkRequest->load('response');
    }
}
