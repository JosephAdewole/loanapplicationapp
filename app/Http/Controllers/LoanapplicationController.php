<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;


class LoanapplicationController extends Controller
{

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;

        $this->soapWrapper->add('Baseurl', function ($service) {
            $service
                ->wsdl('http://www.dneonline.com/calculator.asmx?wsdl')
                ->trace(true);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('loans.create');
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

    public function calculate_loan(Request $request){

        $product = $this->multiply($request->loan_amount, $request->interest_rate);
        $product = $this->multiply($product, $request->period);
        $interest = $this->divide($product, 100);
        $amount_to_be_paid_back = $this->add($request->loan_amount, $interest);

        // return view('loans.create')
        //     ->with('amount_to_be_paid_back', $amount_to_be_paid_back);
        return back()->with(['amount_to_be_paid_back'=> $amount_to_be_paid_back, 'loan_amount'=> $request->loan_amount, 'interest_rate'=> $request->interest_rate, 'period'=>$request->period]);
    }

    private function add($intA, $intB){
        
        $results = $this->soapWrapper->call('Baseurl.Add', [[
            'intA' => $intA,
            'intB' => $intB,
        ]]);

        return($results->AddResult);
    }

    private function subtract($intA, $intB){
        
        $results = $this->soapWrapper->call('Baseurl.Subtract', [[
            'intA' => $intA,
            'intB' => $intB,
        ]]);

        return($results->SubtractResult);
    }
    private function multiply($intA, $intB){
        
        $results = $this->soapWrapper->call('Baseurl.Multiply', [[
            'intA' => $intA,
            'intB' => $intB,
        ]]);

        return($results->MultiplyResult);
    }

    private function divide($intA, $intB){
        
        $results = $this->soapWrapper->call('Baseurl.Divide', [[
            'intA' => $intA,
            'intB' => $intB,
        ]]);

        return($results->DivideResult);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
