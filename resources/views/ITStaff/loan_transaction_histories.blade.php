@extends('ITStaff.main')

@section('content')
@include('ITStaff.Body.sidebar')
<div class="title">
    <h1>Loan Transactions</h1>
</div>

<div class="table-header">
    <div class="table-header-left">
        <label for="unread-filter">Filter: </label>
        <select id="unread-filter">
            <option value="all">All</option>
            <option value="lead">lead</option>
            <option value="agripinay">agripinay</option>
            <option value="akbay">akbay</option>
        </select>
        <label for="items-per-page">Items per page: </label>
        <select id="items-per-page">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="all">All</option>
        </select>
    </div>
    <div class="table-header-right">
        <div class="search-container">
            <input type="text" id="search" placeholder="Search">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
</div>


<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction Type</th>
                <th>Beneficiary</th>
                <th>Program</th>
                <th>Project Name</th>
                <th>Loan Amount</th>
                <th>Loan Term in Months</th>
                <th>Maturity Date</th>
                <th>Incoming Loan Status</th>
                <th>Current Loan Status</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanTransactions as $loanTransaction)
                <tr>
                    <td>{{ $loanTransaction->id }}</td>
                    <td>{{ $loanTransaction->transaction_type }}</td>
                    <td>{{ $loanTransaction->user->first_name }} {{ $loanTransaction->user->middle_name }} {{ $loanTransaction->user->last_name }}</td>
                    <td>{{ $loanTransaction->program->program_name }}</td>
                    <td>{{ $loanTransaction->loans->project }}</td>
                    <td>{{ $loanTransaction->loans->loan_amount }}</td>
                    <td>{{ $loanTransaction->loans->loan_term_in_months }}</td>
                    <td>{{ $loanTransaction->loans->date_of_maturity }}</td>
                    <td>{{ $loanTransaction->loanstatus->loan_status_name }}</td>
                    <td>{{ $loanTransaction->currentloanstatus->current_loan_status_name }}</td>
                    <td>{{ $loanTransaction->created_at }}</td>
                </tr>
            @endforeach
</tbody>
</table>
<div class="pagination">
    <button id="prev-page">Previous</button>
    <div id="page-numbers"></div>
    <button id="next-page">Next</button>
</div>

<div id="pagination-message"></div>
</div>

<!-- Popup for displaying message content and details -->
<div id="message-popup" class="popup">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <h2>Message Details</h2>
        <div class="popup-details">
            <div class="row">
                <div class="column">
                    <p><strong>Full Name:</strong></p>
                    <p><strong>Email Address:</strong></p>
                </div>
                <div class="column">
                    <p><span id="full-name"></span></p>
                    <p><span id="email-address"></span></p>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <p><strong>Contact Number:</strong></p>
                    <p><strong>Date:</strong></p>
                </div>
                <div class="column">
                    <p><span id="contact-number"></span></p>
                    <p><span id="date"></span></p>
                </div>
            </div>
            <div class="message-row">
                <p><strong>Message:</strong></p>
                <p><span id="message-content"></span></p>
            </div>
        </div>
        <div class="popup-actions">
            <button class="button">Reply</button>
            <button class="button">Delete</button>
        </div>
    </div>
</div>

            <div class="container-back">
                    <a href="{{ route('itstaff.home') }}" class="back">Back</a>
            </div>

@endsection
