@extends('AKBAY_Project_Coordinator.projectcoordinator_main')

@section('content')
@include('AKBAY_Project_Coordinator.Body.sidebarproj')
    

    <div class="title">
        <h1>Announcement</h1>
    </div>
    <div class="table-header">
        <div class="table-header-left">
            <label for="unread-filter">Filter: </label>
            <select id="unread-filter">
                <option value="all">All</option>
                <option value="PUBLIC">Public</option>
                <option value="Akbay">Beneficiaries</option>
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
                            <th>Title</th>
                            <th>To</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcement->reverse() as $announcements)
                        <!--VIEW Announcement-->
                        <div class="modal fade" id="modal_view{{ $announcements->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="#modal_view" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Announcement Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body" style="justify-content: left; padding-left:0%; margin-left:10%">
                                    <div class="row">
                                    <div class="col">
                                    <div class="col-md-12">
                                        <h5>Title:</h5>
                                        <p id="modal-title">{{ $announcements->title }}</p>
                                    </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <h5>To:</h5>
                                            <p id="modal-recipient">{{ $announcements->to }}</p>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5>Message:</h5>
                                            <p id="modal-message">{{ $announcements->message }}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!--UPDATE Announcement-->
                    <div class="modal fade" id="modal_edit{{ $announcements->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="#modal_edit" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                    <form action="{{ route('update.announcementcoordinatorakbay') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                            <div class="row">
                                            <input type="hidden" name="announcement_id" value="{{ $announcements->id }}">
                                                <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="edit-title">Title:</label>
                                                    <input type="text" class="form-control" id="edit-title" name="title" value="{{ $announcements->title }}">
                                                </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="edit-recipient">To:</label>
                                                    <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="to">
                                                    <option>AKBAY</option>
                                                    <option>PUBLIC</option>
                                                    </select>
                                                </div>
                                                </div>
                                                    <div class="col-md-12 mb-4">
                                                <div class="form-group">
                                                    <label for="edit-message">Message:</label>
                                                    <textarea class="form-control" id="edit-message" name="message">{{ $announcements->message }}</textarea>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="add" id="saveChanges">Save Changes</button>
                                            </div>
                                    </form>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!--DELETE Announcement-->
                    <div class="modal fade" id="modal_delete{{ $announcements->id }}" tabindex="-1" data-backdrop="false" aria-labelledby="#modal_delete" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('delete.announcementcoordinatorakbay') }}">
                                            @csrf
                                            @method('DELETE')
                                        <div class="row">
                                        <input type="hidden" name="delete_id" value="{{ $announcements->id }}">
                                        <div class="col">
                                        <div class="col-md-12">
                                            <h5>Title:</h5>
                                            <p id="modal-title">{{ $announcements->title }}</p>
                                        </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <h5>To:</h5>
                                                <p id="modal-recipient">{{ $announcements->to }}</p>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Message:</h5>
                                                <p id="modal-message">{{ $announcements->message }}</p>
                                            </div>
                                            @if(session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <p style="color:red">Are you sure you want to delete this Announcement?</p>
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
                            <td>{{ $announcements->title }}</td>
                            <td>{{ $announcements->to }}</td>
                            <td>{{ $announcements->message }}</td>
                            <td>{{ $announcements->date }}</td>
                            <td>
                            <button class="tooltip-button" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_view{{ $announcements->id }}">
                                <i class="fa-solid fa-eye fa-2xs"></i>
                            </button>
                            <button class="tooltip-button" data-tooltip="Edit" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_edit{{ $announcements->id }}">
                                <i class="fa-solid fa-pen-to-square fa-2xs"></i>
                            </button>
                            <button class="tooltip-button" data-tooltip="Delete" class="delete-btn" data-bs-toggle="modal" data-bs-target="#modal_delete{{ $announcements->id }}">
                                <i class="fa-solid fa-trash fa-2xs"></i>
                            </button>
                            </td>
                        </tr>
                        @endforeach
                </body>
                </table>
                <div class="pagination">
                    <button id="prev-page">Previous</button>
                    <div id="page-numbers"></div>
                    <button id="next-page">Next</button>
                </div>

                <div id="pagination-message"></div>
                </div>
    

            <div class="btn-bottom">
            <button type="button" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_announcement">
                Add</button> 
            </div>

   <!--MODAL ANNOUNCEMENT INSERT-->
<div class="modal fade" id="modal_announcement" tabindex="-1" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <form action="{{ route('store.announcementcoordinatorakbay') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <input type="date" name="date" id="date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" hidden>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <label id="label_">Title</label>
                            <input class="form-control" type="text" id="Title" placeholder="Title.... " name="title">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                            <label id="label_">To:</label>
                                <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="to">
                                    <option>AKBAY</option>    
                                    <option>Public</option>
                                 </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-outline">
                                <label id="label_">Message:</label>
                                <textarea class="form-control" rows="3" placeholder="Write something..." name="message"></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="add">Save</button>
                        </div>
                </form>
                    </div>
    </div>
</div>
</div>

@endsection
