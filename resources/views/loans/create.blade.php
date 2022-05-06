@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('loans')}}" method="POST">
                @csrf
                <input type="text" class="form-input" name= 'loan_amount'>
                <input type="text" class="form-input" name= 'interest_rate'>
                <input type="text" class="form-input" name= 'period'>
                <input type="submit" value="Get Loan Details">
            </form>
        </div>
    </div>
@endsection