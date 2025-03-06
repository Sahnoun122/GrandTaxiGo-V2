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
use Iluminate\Support\Facades\Auth;


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

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
       
 
        $charge = Charge::create([
            'amount' => 100, 
            'currency' => 'eur',
            // 'email' => auth()->user()->email, 
            'source' => $request->stripeToken,
            'description' => 'KHADIJATON'
        ]);
        // dd($charge);
        $payment = new Payments();
        $payment->id_passager = auth()->user()->id;
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
