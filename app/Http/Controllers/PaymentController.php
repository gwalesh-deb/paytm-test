<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use PaytmWallet;
use App\Event;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = [
            'order_id' => '1233221223322',
            'amount' => '1200.00',
            'name' => 'Jon Doe',
            'email' => 'jon@doe.com'
          ];

        //   $order = Indipay::prepare($parameters);
          $order = Indipay::gateway('CCAvenue')->prepare($parameters);


          return Indipay::process($order);
    }

    public function indipayresponse(Request $request)
    {
        // For default Gateway
        // $response = Indipay::gateway('CCAvenue')->response($request);
        $response = Indipay::gateway('Paytm')->response($request);

        dd($response);
    }


    public function paytmindex(Request $request)
    {
        // $parameters = [
        //     'order_id' => '1233221223322',
        //     'amount' => '1200.00',
        //     'name' => 'Jon Doe',
        //     'email' => 'jon@doe.com'
        //   ];

          $parameters = [
            'transaction_no' => '1233221223322',
            'amount' => '1200.00',
            'name' => 'Jon Doe',
            'email' => 'jon@doe.com'
          ];

        //   $order = Indipay::prepare($parameters);
          $order = Indipay::gateway('Paytm')->prepare($parameters);


          return Indipay::process($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }


    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function bookEvent()
    {
        return view('book_event');
    }


    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function eventOrderGen(Request $request)
    {
     $this->validate($request, [
          'name' => 'required',
          'mobile_number' =>'required|numeric|digits:10',
        ]);

        $input = $request->all();
        $input['order_id'] = rand(1111,9999);
        $input['amount'] = $request->amount;

        // Event::insert($input);

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $input['order_id'],
          'user' => '5',
          'mobile_number' => $request->mobile_number,
          'email' => $request->email,
          'amount' => $input['amount'],
          'callback_url' => route('paymentCallbackstatus')
        ]);
        return $payment->receive();
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paymentCallbackstatus(Request $request)
    {

        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();

        if($transaction->isSuccessful()){
        //   Event::where('order_id',$response['ORDERID'])->update(['status'=>'success', 'payment_id'=>$response['TXNID']]);

          dd('Payment Successfully Credited.');

        }else if($transaction->isFailed()){
        //   Event::where('order_id',$order_id)->update(['status'=>'failed', 'payment_id'=>$response['TXNID']]);
          dd('Payment Failed. Try again lator');
        }
    }
}
