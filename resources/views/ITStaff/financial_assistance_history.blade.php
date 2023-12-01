@extends('ITStaff.main')

@section('content')
@include('ITStaff.Body.sidebar')
<div class="title">
    <h1>Financial Assitance Transactions</h1>
</div>

<div class="table-header">
    <div class="table-header-left">
        <label for="unread-filter">Filter: </label>
        <select id="unread-filter">
            <option value="all">All</option>
            <option value="binhingpagasa">binhingpagasa</option>
            <option value="abakamopisomo">abakamopisomo</option>
            <option value="agripinay">abakamopisomo</option>
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
                <th>Financial Assistance Amount</th>
                <th>Date and Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assistanceTransactions as $assistanceTransaction)
            <tr>
                <td>{{ $assistanceTransaction->id }}</td>
                <td>{{ $assistanceTransaction->transaction_type }}</td>
                <td>{{ $assistanceTransaction->user->first_name }} {{ $assistanceTransaction->user->middle_name }} {{ $assistanceTransaction->user->last_name }}</td>
                <td>{{ $assistanceTransaction->program->program_name }}</td>
                <td>{{ $assistanceTransaction->assistance->project }}</td>
                <td>{{ $assistanceTransaction->assistance->amount }}</td>
                <td>{{ $assistanceTransaction->created_at }}</td>
                <td>{{ $assistanceTransaction->assistancestatus->financial_assistance_status_name }}</td>
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
