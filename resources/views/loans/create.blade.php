@extends('layouts.template')

@section('content')
    <div class="container">
        
        @if ((session('amount_to_be_paid_back')))
            <div class="row">
                {{session('amount_to_be_paid_back')}}
            </div> 
            <div class="row">
                <form action="{{route('loans.store')}}" method="post">
                    @csrf
                    <input type="hidden" class="form-input" name= 'loan_amount' value="{{session('loan_amount')}}">
                    <input type="hidden" class="form-input" name= 'interest_rate' value="{{session('interest_rate')}}">
                    <input type="hidden" class="form-input" name= 'period' value="{{session('period')}}">
                    <input type="submit" value="Get Loan">
                </form>
            </div>
        @else
            @if(session('success'))
                <h4 class="text-success">{{session('success')}}</h4>
            @else
                
            @endif
            <div class="row">
                <form action="{{url('calculate_loan')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="loan_amount">Amount</label>
                        <input id="loan_amount" type="integer" class="form-input" required name= 'loan_amount'>
                    </div>
                    <div class="form-group">
                        <label for="interest_rate">Interest Rate</label>
                        <input id="interest_rate" type="integer" class="form-input" required name= 'interest_rate'>
                    </div>
                    <div class="form-group">
                        <label for="period">Number of Years</label>
                        <input id="period" type="integer" class="form-input" required name= 'period'>
                    </div>
                    <input type="submit" value="Get Loan Details">
                </form>
            </div>
        @endif
    </div>
@endsection