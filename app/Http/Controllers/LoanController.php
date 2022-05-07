<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Models\Loan;
use Auth;
use Notification;
use App\Notifications\LoanApplied;

class LoanController extends Controller
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
        $loans = Loan::whereBelongsTo(Auth::user())->get();
        return view('loans.index')->with('loans', $loans);
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
        $request->validate([
            'loan_amount' => 'required|integer',
            'interest_rate' => 'required|integer',
            'period' => 'required|integer',
        ]);


        $loan = new Loan;
        $loan->loan_amount = $request->loan_amount;
        $loan->period = $request->period;
        $loan->interest_rate = $request->interest_rate;
        $loan->user_id = Auth::user()->id;

        $loan->save();

        $admin_user = env('ADMIN_EMAIL');
        Notification::send($admin_user, new LoanApplied($loan));  
        $success = 'Loan successfully applied for.';
        return back()->with(['success'=> $success]);
    }

    public function calculate_loan(Request $request){

        $request->validate([
            'loan_amount' => 'required|integer',
            'interest_rate' => 'required|integer',
            'period' => 'required|integer',
        ]);

        $product = $this->multiply($request->loan_amount, $request->interest_rate);
        $product = $this->multiply($product, $request->period);
        $interest = $this->divide($product, 100);
        $amount_to_be_paid_back = $this->add($request->loan_amount, $interest);

        
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
