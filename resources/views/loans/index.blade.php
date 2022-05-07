@extends('layouts.template')

@section('content')
    <div class="container">
        
    
        <table id="table_id" data-order='[[ 1, "asc" ]]' data-page-length='25'>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Amount Borrowed</th>
                    <th>Amount to be Paid Back</th>
                    <th>Interest Rate</th>
                    <th>Loan Tenure</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$loan->loan_amount}}</td>
                        <td>{{$loan->loan_amount}}</td>
                        <td>{{$loan->interest_rate}}</td>
                        <td>{{$loan->period}}</td>
                        <td>{{$loan->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection