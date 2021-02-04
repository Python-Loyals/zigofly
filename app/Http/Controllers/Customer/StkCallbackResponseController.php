<?php

namespace App\Http\Controllers\Customer;

use App\Checkout;
use App\Events\StkResponse;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Quote;
use App\StkRequest;
use App\Transaction;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


            $quote->load('payment');

            if (!$quote->payment){
                $transaction = new Transaction([
                    'receipt_number' => $receipt,
                    'amount' => $amount,
                ]);

                $transaction->payment()->associate($quote);
                $transaction->save();

                //update quote to paid
                $quote->update(['status' => 3]);

                //create order
                $order = Order::create([
                    'sub_total' => $quote->amount,
                    'total'     => $quote->amount,
                    'user_id'   => $quote->customer->id
                ]);

                foreach ($quote->products as $product) {
                    $orderItem = new OrderItem([
                        'quantity'  => (int) $product->quantity
                    ]);

                    $orderItem->product()->associate($product);
                    $orderItem->order()->associate($order);

                    $orderItem->save();
                }
            }else{
                return response()->json([
                        "message" => 'Quote already paid'
                    ]
                );
            }

            $message = 'Your payment for quote '.$stkRequest->bill_ref_number.' was successful.';

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

    public function order(Request $request)
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

        $checkoutId = array_filter(explode('ZFO-', $stkRequest->bill_ref_number))[1];
        $checkout = Checkout::find($checkoutId);

        //if quote does not exist
        if (!$checkout){
            return response()->json([
                'error' => 'That order does not exist'
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

            Cart::restore($checkout->user_id);

            if (Cart::count() > 0){
                $cartItems = Cart::content();

                $order = Order::create([
                    'sub_total' => Cart::subtotal(),
                    'total'     => Cart::total(),
                    'user_id'   => $checkout->user_id
                ]);

                foreach ($cartItems as $cartItem) {
                    $orderItem = new OrderItem([
                        'quantity'  => (int) $cartItem->qty,
                        'color'     => $cartItem->options->color ?? '',
                        'size'     => $cartItem->options->size ?? '',
                        'other_options'     => $cartItem->options->other_options ?? '',
                    ]);

                    $product = Product::find($cartItem->id);

                    $orderItem->product()->associate($product);
                    $orderItem->order()->associate($order);

                    $orderItem->save();
                }

                Cart::destroy($checkout->user_id);
                Cart::store($checkout->user_id);

                $order->load('payment');
                $t = Transaction::where('receipt_number', $receipt)->first();

                if (!$order->payment && !$t){
                    $transaction = new Transaction([
                        'receipt_number' => $receipt,
                        'amount' => $amount,
                    ]);

                    $transaction->payment()->associate($order);
                    $transaction->save();
                }
                elseif($t){
                    return response()->json([
                            "message" => 'Transaction already exists'
                        ]
                    );
                }
            }
            else{
                return response()->json([
                   'message' => 'you have no items in cart'
                ], Response::HTTP_NOT_FOUND);
            }

            $message = 'Your payment for order '.$stkRequest->bill_ref_number.' was successful.';

            event(new StkResponse($checkout->user_id, $message));
        }else{
            $stkRequest->response()->updateOrCreate([],[
                'merchant_request_id' => $merchant_request_id,
                'result_code' => $response_code,
                'result_description' => $response_desc
            ]);

            event(new StkResponse($checkout->user_id, $response_desc, true));
        }

        return $stkRequest->load('response');
    }
}
