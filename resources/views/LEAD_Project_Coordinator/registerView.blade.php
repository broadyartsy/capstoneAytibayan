@extends('LEAD_Project_Coordinator.projectcoordinator_main')

@section('content')
@include('LEAD_Project_Coordinator.Body.sidebarproj')

<div class="title">
    <h1>Registration</h1>
</div>

<div class="table-header">
    <div class="table-header-left">
        <label for="unread-filter">Filter: </label>
        <select id="unread-filter">
            <option value="all">All</option>
            <option value="unread">Read</option>
            <option value="read">Unread</option>
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
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Program</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                {{-- Modal View --}}
                <div class="modal fade" id="itStaffRegister{{ $user->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="col-md-12">
                                            <img class="ht-50 wd-50 rounded-circle"
                                                src="{{ !empty($user->photo) ? url('Uploads/Beneficiary_Images/' . $user->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                                                alt="profile">
                                        </div>
                                        <br>
                                        <span class="h4 ms-3">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</span>
                                        <br><br>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Email:</h5>
                                        <p id="modal-recipient">{{ $user->email }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Program:</h5>
                                        <p id="modal-recipient">{{ $user->program->program_name }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Role:</h5>
                                        <p id="modal-message">{{ $user->role->role_name }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Contact Number:</h5>
                                        <p id="modal-message">{{ $user->phone }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>Address:</h5>
                                        <p id="modal-message">{{ $user->barangay }}, {{ $user->city }}, {{ $user->province }} {{ $user->zip }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Update User Status-->
                <div class="modal fade" id="modal_edit{{ $user->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Edit User:</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <img class="ht-50 wd-50 rounded-circle"
                                            src="{{ !empty($user->photo) ? url('Uploads/Beneficiary_Images/' . $user->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                                            alt="profile">
                                    </div>
                                    <br>
                                    <span class="h4 ms-3">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</span>
                                    <br><br>
                                        <form action="{{ route('leadprojectcoordinator.registerEditUser') }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <h5>User Role:</h5>
                                                <p id="modal-recipient">{{ $user->role->role_name }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <div class="form-outline">
                                                <label id="inputStatus">User Status:</label>
                                                <select id="inputStatus" class="form-select" name="inputStatus">
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}"@if ($user->status_id == $status->id) selected @endif>{{ $status->status_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                    
                                        <div class="modal-footer">
                                            <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="add">Save Changes</button>
                                        </div>
                                        </div>
                                        </form>
                                </div>
                            </div>
                    </div>
                </div>

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->middle_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->program->program_name }}</td>
                    <td>{{ $user->role->role_name }}</td>
                    <td>{{ $user->status->status_name }}</td>
                    <td>
                        <button class="tooltip-button" data-tooltip="View" class="add-modal" data-bs-toggle="modal"
                        data-bs-target="#itStaffRegister{{ $user->id }}">
                            <i class="fa-solid fa-eye fa-2xs"></i>
                        </button>
                        <button class="tooltip-button" data-tooltip="Edit" class="add-modal" data-bs-toggle="modal"
                        data-bs-target="#modal_edit{{ $user->id }}"><i
                                class="fa-solid fa-pen-to-square fa-2xs"></i></button>
                        <button class="tooltip-button" data-tooltip="Blacklist"><a href="{{ route('leadprojectCoordinator.BlacklistUser', $user->id) }}" id="blacklist"><i class="fa-solid fa-ban fa-2xs"></i></a></button>
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

        <form>        
            <div class="btn-bottom">
                @auth
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="add-modal">
    
                            Register
    
                        </a>
                    @endif
                @endauth
            </div>
            </div>
        </form>

<div class="modal fade" id="itStaffRegister" tabindex="-1" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title">Beneficiary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                mathias ikaw na lang maglagay ng ibang info dito

            </div>
    </div>   
</div>
</div>

@endsection
