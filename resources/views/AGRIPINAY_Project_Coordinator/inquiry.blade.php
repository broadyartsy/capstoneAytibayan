@extends('AGRIPINAY_Project_Coordinator.projectcoordinator_main')

@section('content')
@include('AGRIPINAY_Project_Coordinator.Body.sidebarproj')
    

  

    <div class="title">
        <h1>Inquiry</h1>
    </div>
    @if ($unreadCount > 0)
            <div class="alert alert-info">
                You have {{ $unreadCount }} unread messages.
            </div>
    @endif
    <div class="table-header">
        <div class="table-header-left">
           <!-- <label for="unread-filter">Filter: </label>
            <select id="unread-filter">
                <option value="all">All</option>
                <option value="unread">Read</option>
                <option value="read">Unread</option>
            </select>-->
            <label for="unread-filter">From: </label>
            <select id="unread-filter">
                <option value="all">All</option>
                <option value="Public User">Public</option>
                <option value="Beneficiary">Beneficiary</option>
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
                            <th>Full Name</th>
                            <th>From</th>
                            <th>Message</th>
                            <th>Email Address</Address></th>
                            <th>Contact Number</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($inquiry->reverse() as $inquiry)
                        <!--MODAL VIEW-->
                        <form action="{{ route('agripinaymark.AsRead' ) }}" method="post">
                            @csrf
                        <div class="modal fade" id="view_itstaff{{ $inquiry->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="modal_view" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Inquiry Details</h5>
                                            <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-4" style="width: 100%;">
                                                    <div class="form-outline">
                                                        <label for="Title">Full Name:</label>
                                                        <p class="form-control" type="text" id="Title" placeholder="Title...." name="title">{{ $inquiry->fullname }}</p>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6 mb-4" style="width: 100%;">
                                                    <div class="form-outline">
                                                    <label id="label_">Email Address:</label>
                                                        <p class="form-control" type="text" name="to">{{ $inquiry->email }}</p>
                                                    </div>
                                                </div>
                                            <div class ="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Date">Contact Number:</label>
                                                        <p class="form-control" type="date" id="Date" name="date">{{ $inquiry->contacts }}</p>
                                                    </div>
                                                </div>
                                            

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Date">Date:</label>
                                                        <p class="form-control" type="date" id="Date" name="date">{{ $inquiry->created_at->format('Y-m-d h:i A')  }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Message">Message:</label>
                                                        <p class="form-control" rows="3" id="Message" placeholder="Write something..." name="message">{{ $inquiry->message }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="submit" class="close" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </form>
                        <!--MODAL Reply-->
                        <div class="modal fade" id="modal_reply{{ $inquiry->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="modal_edit" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Reply</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                        <form action="{{ route('reply.inquirycoordinatoragripinay') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Title">Recipient Name:</label>
                                                        <input class="form-control" type="text" id="Title" placeholder="Title...." name="fullname" value="{{ $inquiry->fullname }}">
                                                    </div>
                                                </div>
                                                    <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                    <label for="edit-recipient">Recipient Email:</label>
                                                        <input class="form-control" type="text" id="Title" placeholder="Title...." name="recipient_email" value="{{ $inquiry->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Date">Subject:</label>
                                                        <input class="form-control" type="text" id="Subject" name="subject" value="{{ $roleName }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <label for="Message">Body:</label>
                                                        <textarea class="form-control" rows="3" id="Message" placeholder="Write something..." name="body" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="add" id="saveChanges">Send</button>
                                                </div>
                                        </form>
                                            </div>
                                    </div>
                            </div>
                        </div>

                        <!--MODAL DELETE-->
                        <div class="modal fade" id="modal_delete{{ $inquiry->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="modal_delete" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('delete.inquirycoordinatoragripinay') }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="row">
                                            <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                                                <div class="col-md-12 mb-4">
                                                    @if(session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                            <p style="color:red">Are you sure you want to delete this Announcement?</p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="close" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="add" id="saveChanges">Delete</button>
                                                </div>
                                        </form>
                                            </div>
                                    </div>
                            </div>
                        </div>
                        <tr class="{{ $inquiry->is_unread ? 'unread' : 'read' }}">

                        <td class="column">{{ $inquiry->fullname }}</td>
                        <td class="column">{{ $inquiry->from }}</td>
                        <td class="column message-column">{{ $inquiry->message }}</td>
                        <td class="column">{{ $inquiry->email }}</td>
                        <td class="column">{{ $inquiry->contacts }}</td>
                        <td class="column">{{ $inquiry->created_at->format('Y-m-d')  }}</td>
                        <td class="column">
                        <button class="tooltip-button" data-tooltip="View" data-bs-toggle="modal" data-bs-target="#view_itstaff{{ $inquiry->id }}"><i class="fa-solid fa-eye fa-2xs"></i></button>
                        <button class="tooltip-button" data-tooltip="Reply" data-bs-toggle="modal" data-bs-target="#modal_reply{{ $inquiry->id }}"><i class="fas fa-reply fa-2xs"></i></button>    
                        <button class="tooltip-button" data-tooltip="Delete" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $inquiry->id }}"><i class="fa-solid fa-trash fa-2xs"></i></button>

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
                        <div id="message-popup" class="popup" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="#modal_view" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)" >
                <div class="popup-content">
                    <span class="popup-close" onclick="closePopup()">&times;</span>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Inquiry Details</h5>
                    </div>
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