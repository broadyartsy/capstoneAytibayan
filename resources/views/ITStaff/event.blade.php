@extends('ITStaff.main')

@section('content')
@include('ITStaff.Body.sidebar')
<div class="title">
        <h1>Events</h1>
</div>
<div class="table-header">
        <div class="table-header-left">
            <label for="unread-filter">Filter: </label>
            <select id="unread-filter">
                <option value="all">All</option>
                <option value="PUBLIC">PUBLIC</option>
                <option value="Abaka Mo, Piso Mo">Abaka Mo, Piso Mo</option>
                <option value="LEAD">LEAD</option>
                <option value="AgriPinay">AgriPinay</option>
                <option value="Akbay">Akbay</option>
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
                            <th>From</th>
                            <th>Title</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->reverse() as $events)
                        <!-- Modal View-->
                        <div class="modal fade" id="view_itstaff{{ $events->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                    <div class="col">
                                    <div class="col-md-12">
                                        <h5>Title:</h5>
                                        <p id="modal-title">{{ $events->title }}</p>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12">
                                                <h5>To:</h5>
                                                <p id="modal-recipient">{{ $events->to }}</p>
                                            </div>
                                    </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <h5>Description:</h5>
                                            <p id="modal-recipient">{{ $events->message }}</p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5>Date:</h5>
                                            <p id="modal-message">{{ $events->date }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Update Event-->
                        <div class="modal fade" id="modal_edit{{ $events->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                                <form action="{{ route('update.event') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                <div class="row">
                                                    <input type="hidden" name="event_id" value="{{ $events->id }}">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                    <label id="label_">Title</label>
                                                    <input class="form-control" type="text" id="Title" placeholder="Title.... " name="title" value="{{ $events->title }}">                            </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                        <div class="form-group">
                                                            <label for="edit-recipient">To:</label>
                                                            <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="to">
                                                            <option>{{ $events->to }}</option>
                                                            @foreach($programs as $program)
                                                            <option>{{ $program->program_name }}</option>
                                                            @endforeach
                                                            <option>Public</option>
                                                            </select>
                                                        </div>
                                                        </div>

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                    <label id="label_">Date</label>
                                                        <input class="form-control"  type="date" id="Date" placeholder="Title...." name="date" value="{{ $events->date }}">
                                                </div>
                                                </div>
                            
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <label id="label_">Message:</label>
                                                            <textarea class="form-control" rows="3" placeholder="Write something..." name="message">{{ $events->message }}</textarea>
                                                            </div>
                                                            <div class="form-outline">
                                                      
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

                            <!--DELETE Announcement-->
                            <div class="modal fade" id="modal_delete{{ $events->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="#modal_delete" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('delete.event') }}">
                                            @csrf
                                            @method('DELETE')
                                        <div class="row">
                                        <input type="hidden" name="delete_id" value="{{ $events->id }}">
                                        <div class="row">
                                        <div class="col-md-12">
                                        <h5>Title:</h5>
                                        <p id="modal-title">{{ $events->title }}</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>To:</h5>
                                                <p id="modal-recipient">{{ $events->to }}</p>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <h5>Description:</h5>
                                                <p id="modal-recipient">{{ $events->message }}</p>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Date:</h5>
                                                <p id="modal-message">{{ $events->date }}</p>
                                        </div>
                                            @if(session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <p style="color:red">Are you sure you want to delete this Event?</p>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="add" id="saveChanges">Delete</button>
                                        </div>
                                        </form>
                                        </div>
                            </div>
                        </div>

                        <tr>
                        <td class="column">{{ $events->from }}</td>
                        <td class="column">{{ $events->title }}</td>
                        <td class="column">{{ $events->to }}</td>
                        <td class="column message-column">{{ $events->message }}</td>
                        <td class="column">{{ $events->created_at }}</td>
                        <td class="column">
                            <button class="tooltip-button" data-tooltip="View" data-bs-toggle="modal" data-bs-target="#view_itstaff{{ $events->id }}">
                            <i class="fa-solid fa-eye fa-2xs"></i>
                            </button>
                            <button class="tooltip-button" data-tooltip="Edit" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $events->id }}"><i class="fa-solid fa-pen-to-square fa-2xs"></i></button>
                            <button class="tooltip-button" data-tooltip="Delete" class="delete-btn" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $events->id }}">
                                <i class="fa-solid fa-trash fa-2xs"></i></button>
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

        <div class="btn-bottom">
            <button type="button" class="add-modal" data-bs-toggle="modal" data-bs-target="#event_modal">
                Add</button> 
            </div>
    </div>
   <!--Buttons-->

<!--Store Event-->
<div class="modal fade" id="event_modal" tabindex="-1" data-backdrop="false" data-bs-backdrop="static"  aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Events</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                        <form action="{{ route('store.event') }}" enctype="multipart/form-data" method="post">
                            @csrf
                        <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <label id="label_">Title</label>
                            <input class="form-control" type="text" id="Title" placeholder="Title.... " name="title">  
                            <input class="form-control" type="text" id="Title" value="{{ $roleName }}" name="from" hidden>                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                    <label id="label_">To:</label>
                                        <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="to">
                                        @foreach($programs as $program)
                                        <option>{{ $program->program_name }}</option>
                                        @endforeach
                                        <option>Public</option>
                                        </select>
                                    </div>
                                </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <label id="label_">Date</label>
                                <input class="form-control"  type="date" id="Date" placeholder="Title...." name="date">
                        </div>
                        </div>
    
                        <div class="col-md-12 mb-4">
                            <div class="form-outline">
                                <label id="label_">Message:</label>
                                    <textarea class="form-control" rows="3" placeholder="Write something..." name="message"></textarea>
                                    </div>
                                    <div class="form-outline">
                               
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="add">Save</button>
                        </div>
                        </div>
                        </form>
                </div>
            </div>
    </div>
</div>
        
@endsection      
