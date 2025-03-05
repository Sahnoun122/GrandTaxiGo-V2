<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Http\Requests\StorepaymentsRequest;
use App\Http\Requests\UpdatepaymentsRequest;

use Stripe\Stripe;
use Stripe\Charge;
use session;
use Stripe\Customer;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Traiter le paiement via Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
public function charge(Request $request)
{

    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
       
 
        $charge = Charge::create([
            'amount' => 5000, 
            'currency' => 'eur',
            'email' => auth()->user()->email, 
            'source' => $request->stripeToken,  
        ]);
        dd($charge);

        $payment = new Payments();
        $payment->user_id = auth()->user()->id;  
        $payment->stripe_payment_id = $charge->id; 
        $payment->amount = $charge->amount; 
        $payment->currency = $charge->currency;  
        $payment->status = $charge->status;  
        $payment->save();

        return back()->with('success_message', 'Paiement réussi !');

    } catch (\Exception $e) {
        return back()->with('error_message', 'Une erreur est survenue lors du paiement : ' . $e->getMessage());
    }
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('passager.payment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentsRequest $request, payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payments $payments)
    {
        //
    }
}
