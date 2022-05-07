@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Welcome, {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

            </div>
        </div>

    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Check your loan History</div>

                <div class="card-body">
                    <a href="loans" class="btn btn-primary">
                        View Loans 
                    </a>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Take a Low Interest Loan</div>

                <div class="card-body">
                    <a href="loans/create" class="btn btn-primary">
                        Take Loan
                    </a>
                </div>

            </div>
        </div>
        

    </div>
</div>
@endsection
