@extends('ABAKA_Project_Coordinator.projectcoordinator_main')

@section('content')
    @include('ABAKA_Project_Coordinator.Body.sidebarproj')
<div class="title">
    <h1>Blacklisted Users</h1>
</div>

<div class="table-header">
    <div class="table-header-left">
       {{-- <label for="unread-filter">Filter: </label>
        <select id="unread-filter">
            <option value="all">All</option>
            <option value="read">itstaff</option>
            <option value="binhi">binhingpagasa</option>
            <option value="abaka">abakamopisomo</option>
            <option value="lead">lead</option>
            <option value="agripinay">agripinay</option>
            <option value="akbay">akbay</option>
        </select>--}}
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
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Program</th>
                <th>Role</th>
                <th>Actions</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->middle_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->program->program_name }}</td>
                    <td>{{ $user->role->role_name }}</td>
                    <td>
                        <button class="tooltip-button" data-tooltip="Restore"><a href="{{ route('abakaprojectcoordinator.RestoreUser', $user->id) }}" id="restore"><i class="fa-solid fa-suitcase-medical fa-2xs"></i></a></button>
                    </td>
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

@endsection
