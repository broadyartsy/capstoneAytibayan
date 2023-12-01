@extends('ITStaff.main')

@section('content')
@include('ITStaff.Body.sidebar')

<div class="title">
        <h1>TRANSACTION</h1>
</div>

<div class="container-transaction">
    <div class="card-transaction">
        <h4> Financial Assistance </h4>
        <div class="image">
            <img src="\images\assistance.png" alt="Logo">
        </div>
        <div class="text">
            <p> </p>
        </div>
        <a href="{{ route('itstaff.financialAssistanceTransactionsView') }}" class="button">
            Open
        </a>
    </div>
    <div class="card-transaction">
    <h4> Loans </h4>
        <div class="image">
            <img src="\images\loan.png" alt="Logo">
        </div>
        <div class="text">
            <p> </p>
        </div>
        <a href="{{ route('itstaff.loanTransactionsView') }}" class="button">
            Open
        </a>
    </div>
</div>



@endsection
