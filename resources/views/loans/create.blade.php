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
            <div class="row">
                <form action="{{url('calculate_loan')}}" method="POST">
                    @csrf
                    <input type="text" class="form-input" name= 'loan_amount'>
                    <input type="text" class="form-input" name= 'interest_rate'>
                    <input type="text" class="form-input" name= 'period'>
                    <input type="submit" value="Get Loan Details">
                </form>
            </div>
        @endif
    </div>
@endsection