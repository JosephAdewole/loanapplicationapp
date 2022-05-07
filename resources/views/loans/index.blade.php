@extends('layouts.template')

@section('content')
    <div class="container">
        
        <table style="width: 67%; margin: 0 auto 2em auto;" cellspacing="0" cellpadding="3" border="0">
            <thead>
                <tr>
                    <th>Search Field</th>
                    <th>Search text</th>
                </tr>
            </thead>
            <tbody>
                
                <tr id="filter_col1" data-column="0">
                    <td>S/N</td>
                    <td align="center"><input type="number" class="column_filter" id="col0_filter"></td>
                    
                </tr>
                <tr id="filter_col2" data-column="1">
                    <td>Amount Borrowed</td>
                    <td align="center"><input type="number" class="column_filter" id="col1_filter"></td>
                   
                </tr>
                <tr id="filter_col3" data-column="2">
                    <td>Amount To be Paid Back</td>
                    <td align="center"><input type="number" class="column_filter" id="col2_filter"></td>
                </tr>
                <tr id="filter_col5" data-column="4">
                    <td>Interest Rate</td>
                    <td align="center"><input type="number" class="column_filter" id="col3_filter"></td>
                </tr>
                <tr id="filter_col6" data-column="5">
                    <td>Loan Tenure</td>
                    <td align="center"><input type="number" class="column_filter" id="col4_filter"></td>
                </tr>
                <tr id="filter_col6" data-column="5">
                    <td>Date</td>
                    <td align="center"><input type="date" class="column_filter" id="col5_filter"></td>
                </tr>
            </tbody>
        </table>
        <table id="table_id" data-order='[[ 1, "asc" ]]' data-page-length='10' class="table">
            <thead class="thead-dark">
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