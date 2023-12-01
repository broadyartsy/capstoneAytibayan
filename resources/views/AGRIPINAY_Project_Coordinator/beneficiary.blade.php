@extends('AGRIPINAY_Project_Coordinator.projectcoordinator_main')

@section('content')
@include('AGRIPINAY_Project_Coordinator.Body.sidebarproj')
    
        <div class="title">
            <h1>Beneficiaries</h1>
        </div>
        <div class="boxes1">
            <div class="box box-5">
                <h1>Beneficiaries</h1>
                <p>{{ $agripinayBeneficiariesCount }}</p>
            </div>
            <div class="box box-5 ">
                <h1>Active</h1>
                <p>{{ $agripinayActiveCount }}</p>
            </div>
            <div class="box box-6">
                <h1>Inactive</h1>
                <p>{{ $agripinayInactiveCount }}</p>
            </div>
        </div>
                <div class="button-container">
                    <button class="button_top" data-bs-toggle="modal" data-bs-target="#projectModal">
                        <i class="fa-solid fa-list-check" style="color: #ffffff;"></i> Program Activities
                    </button>
                </div>

  <!--ADD PROJECTS-->
    <!--PALAGAY NA LANG DITO JEF -->   
               
  <div class="table-header">
  <div class="table-header-left">
    <label for="status-filter">Status: </label>
    <select id="status-filter">
        <option value="all">All</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
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
        <div id="printableContent">
        <div class="print-header">
            <img src="\images\APAO-R5.jpg" alt="Albay Provincial Agricultural Office Logo">
            <h3>Republic of Albay, Province of Albay</h3>
            <h5>ALBAY PROVINCIAL AGRICULTURAL OFFICE</h5>
            <h4>AbakaBuhayan Project, "AGRIPINAY MO, PISO MO" CASH INCENTIVE SCHEME</h4>
            </div>
                <table class="table">
                    <thead>
                    <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Province</th>
                            <th scope="col">Email</th>
                            <th scope="col">Project</th>
                            <th scope="col">Action</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agripinayBeneficiaries as $agripinayBeneficiary)

                            <!--view_beneficiaries-->
                            <div class="modal fade" id="view_beneficiary_updates{{ $agripinayBeneficiary->id }}" tabindex="-1"  data-backdrop="false" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">Beneficiary:  {{ $agripinayBeneficiary->first_name }} {{ $agripinayBeneficiary->middle_name }} {{ $agripinayBeneficiary->last_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="sched-header">Updates</div>
                                            <div class="project_box">
                                            @foreach($updates->reverse() as $update)
                                            @if ($agripinayBeneficiary->email === $update->email)
                                            <div class="box">
                                                <div class="project-info">
                                                <a href="{{ asset('Uploads/Updates/'.$update->image) }}" target="_blank">
                                                    <img src="{{ asset('Uploads/Updates/'.$update->image) }}" alt="Beneficiary's Picture" class="img-thumbnail">
                                                </a>
                                                    <p class="update-title"> {{ $update->title }}</p>
                                                </div>
                                                    <p class="update-date">Posted: {{ $update->created_at->format('Y-m-d h:i A') }} </p>
                                                    <p class="update-date">Last Edited: {{ $update->updated_at->format('Y-m-d h:i A') }} </p>
                                            </div>
                                            @endif
                                            @endforeach
                                            </div>
                                        </div>
                                        
                                        @foreach($benefSchedules->reverse() as $schedule)
                                        <!--VIEW SCHEDULE-->
                                        <div class="modal fade" id="view-schedule-modal{{ $agripinayBeneficiary->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static"  data-bs-backdrop="static" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-title">View Schedule</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="schedule-container">
                                                            @foreach($benefSchedules->reverse() as $schedules)
                                                                <div class="sched-card">
                                                                    <div class="box">
                                                                        <div class="sched-body">
                                                                        <p class="sched-date">Date: {{ $schedules->date }}</p>
                                                                        <p class="sched-time">Time: {{ $schedules->time }}</p>
                                                                        <p class="sched-description">Description: {{ $schedules->description }}</p>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <button class="add-project_modal" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_editschedule{{ $schedule->id }}"><i class="fas fa-edit"></i></button>
                                                                            <button class="add-project_modal" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#modal_deleteschedule{{ $schedule->id }}"><i class="fas fa-trash-alt"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--EDIT Schedule-->
                                        <div class="modal fade" id="modal_editschedule{{ $schedule->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static"  data-bs-backdrop="static" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-title">Edit Project</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('agripinayedit.schedule') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="project-info-edit">
                                                                <input type="hidden" name="benef_id" value="{{ $agripinayBeneficiary->id }}">
                                                                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                                                <div class="mb-3">
                                                                    <label for="schedule-description" class="form-label">Description:</label>
                                                                    <input type="hidden" name="benef_id" value="{{ $agripinayBeneficiary->id }}">
                                                                    <input name="description" type="text" class="form-control" id="schedule-description" value="{{ $schedule->description }}" required>
                                                                    <input type="hidden" name="from" value="{{ $programName }}">
                                                                    <input type="hidden" name="recipient_email" value="{{ $agripinayBeneficiary->email }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="schedule-date" class="form-label">Date:</label>
                                                                    <input name="date" type="date" class="form-control" id="schedule-date" value="{{ $schedule->date }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="schedule-time" class="form-label">Time:</label>
                                                                    <input name="time" type="time" class="form-control" id="schedule-time" value="{{ $schedule->time }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="add">Save Changes</button>
                                                        </div>

                                                    </form>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal_deleteschedule{{ $schedule->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="modal_delete" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-title">Event Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body">
                                                        <form method="POST" action="{{ route('agripinaydelete.schedule') }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                                            </div>
                                                                <div class="col-md-12 mb-4">
                                                                    <div class="form-outline">
                                                                    
                                                                    </div>
                                                                    @if(session('error'))
                                                                        <div class="alert alert-danger">
                                                                            {{ session('error') }}
                                                                        </div>
                                                                    @endif
                                                            <p style="color:red">Are you sure you want to delete this Set Schedule?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="add" id="saveChanges">Delete</button>
                                                                </div>
                                                        </form>
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>
                                        @endforeach              

                                        <button class="add-project_modal" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#view-schedule-modal{{ $agripinayBeneficiary->id }}">View Schedule</button>
                                        <button class="add-project_modal" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#add-schedule-modal{{ $agripinayBeneficiary->id }}">Add Schedule</button>
                                        <div class="modal-footer">
                                            <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Add Schedule Modal -->
                            <div class="modal fade" id="add-schedule-modal{{ $agripinayBeneficiary->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="add-schedule-form" action="{{ route('agripinayadd.schedule') }}" method="post">
                                            @csrf
                                        <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="schedule-description" class="form-label">Description:</label>
                                                    <input type="hidden" name="benef_id" value="{{ $agripinayBeneficiary->id }}">
                                                    <input name="description" type="text" class="form-control" id="schedule-description" required>
                                                    <input type="hidden" name="from" value="{{ $programName }}">
                                                    <input type="hidden" name="recipient_email" value="{{ $agripinayBeneficiary->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="schedule-date" class="form-label">Date:</label>
                                                    <input name="date" type="date" class="form-control" id="schedule-date" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="schedule-time" class="form-label">Time:</label>
                                                    <input name="time" type="time" class="form-control" id="schedule-time" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="add" id="save-schedule-button">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal View for Add --}}
                            <div id="add-value-popup-{{ $agripinayBeneficiary->id }}" class="add-value-popup">
                                <div class="add-value-popup-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">View Beneficiary</h5>
                                        <span class="add-value-popup-close"
                                        onclick="hideAddValuePopup('{{ $agripinayBeneficiary->id }}')">&times;</span>
                                </div>  
                               
                                    <h2>Add Beneficiary</h2>
                                    <form action="{{ route('agripinayprojectcoordinator.progressAdd') }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf

                                        <input type="hidden" name="userId" value="{{ $agripinayBeneficiary->id }}">

                                        <label for="name">Beneficiary Name:</label>
                                        <input type="text" id="name" name="name"
                                            value="{{ $agripinayBeneficiary->first_name }} {{ $agripinayBeneficiary->middle_name }} {{ $agripinayBeneficiary->last_name }}"
                                            readonly>
                                        <label for="project">Project:</label>
                                        <input type="text" id="project" name="project" required>
                                        @error('project')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="amount">Amount:</label>
                                        <input type="number" id="amount" name="amount" required>
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="hidden" name="financialassistancestatus_id" value="2">

                                        <button type="submit" class="add">Save Changes</button>
                                    </form>
                                </div>
                            </div>

                            {{-- Modal View for Update --}}
                            <div id="update-status-popup-{{ $agripinayBeneficiary->id }}" class="update-status-popup">
                                <div class="update-status-popup-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Update Beneficiary</h5>
                                        <span class="update-status-popup-close"
                                        onclick="hideUpdateStatusPopup('{{ $agripinayBeneficiary->id }}')">&times;</span>
                                </div>  
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="col-md-12">
                                                    <img class="ht-50 wd-50 rounded-circle"
                                                        src="{{ !empty($agripinayBeneficiary->photo) ? url('Uploads/Beneficiary_Images/' . $agripinayBeneficiary->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                                                        alt="profile">
                                                </div>
                                                <br>
                                                <span class="h4 ms-3">{{ $agripinayBeneficiary->first_name }} {{ $agripinayBeneficiary->middle_name }} {{ $agripinayBeneficiary->last_name }}</span>
                                                <br><br>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Email:</h5>
                                                <p id="modal-recipient">{{ $agripinayBeneficiary->email }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Program:</h5>
                                                <p id="modal-recipient">{{ $agripinayBeneficiary->program->program_name }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Role:</h5>
                                                <p id="modal-message">{{ $agripinayBeneficiary->role->role_name }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Contact Number:</h5>
                                                <p id="modal-message">{{ $agripinayBeneficiary->phone }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>Address:</h5>
                                                <p id="modal-message">{{ $agripinayBeneficiary->barangay }}, {{ $agripinayBeneficiary->city }}, {{ $agripinayBeneficiary->province }} {{ $agripinayBeneficiary->zip }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <tr>
                                <td>{{ $agripinayBeneficiary->id }}</td>
                                <td>{{ $agripinayBeneficiary->first_name }} {{ $agripinayBeneficiary->middle_name }}
                                    {{ $agripinayBeneficiary->last_name }}</td>
                                <td>{{ $agripinayBeneficiary->barangay }} {{ $agripinayBeneficiary->city }}</td>
                                <td>{{ $agripinayBeneficiary->province }}</td>
                                
                                <td>{{ $agripinayBeneficiary->email }}</td>

                                <td>N/A</td>
                                <td class="no-print">
                                <input type="hidden" name="benef_email" value="{{ $agripinayBeneficiary->email }}" > 
                                <button class="tooltip-button" data-tooltip="View" class="add-modal" data-bs-toggle="modal" data-bs-target="#view_beneficiary_updates{{ $agripinayBeneficiary->id }}"><i class="fa-solid fa-eye fa-2xs"></i></button>
                                    {{--<button class="tooltip-button" data-tooltip="Update"
                                        onclick="showUpdateStatusPopup({{ $agripinayBeneficiary->id }})"><i
                                            class="fa-solid fa-pen-to-square fa-2xs"></i></button> --}}
                                </td>
                                <td>{{ $agripinayBeneficiary->status->status_name }}</td>
                            </tr>
                        </div>
                        @endforeach
                    </tbody>
                </table>   
            </div>
                <div class="pagination">
                    <button id="prev-page">Previous</button>
                    <div id="page-numbers"></div>
                    <button id="next-page">Next</button>
                </div>

                <div id="pagination-message"></div>
              </div>
                
              <!--status popup-->
             
    
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

        <div class="popup-status" id="statusPopup"></div>
        <!--project-->
<div class="modal fade" id="projectModal" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Projects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">
             <div class= "project_header">
                <!--
                <img src="\images\project_background1.png"> -->
                <div class= "project_box">
                        @foreach($project->reverse() as $projects)
                        <!--EDIT PROJECT-->
                        <div class="modal fade" id="modal_editproject{{ $projects->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static"  data-bs-backdrop="static" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Edit Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('agripinayedit.project') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="project-info-edit">
                                                <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                                <div class="mb-3">
                                                    <label for="projectTitle" class="form-label">Title:</label>
                                                    <input type="text" class="form-control" id="projectTitle" value="{{ $projects->title }}" name="title">
                                                    <input type="text" class="form-control" id="projectTitle" value="{{ $projects->from }}" name="from">
                                                </div>

                                                <div class="row mb-3 image-update">
                                                <div class="col-sm-10">
                                                    <label for="projectImage" class="col-sm-2 col-form-label">Image:</label>
                                                        <label id="drop-img">
                                                            <input name="attachment" type="file" id="input-file" value="{{ $projects->attachment }}" hidden>
                                                            <div id="img-view">
                                                                <img src="{{ asset('Uploads/Updates/'.$projects->attachment) }}" class="img-fluid" alt="Image Icon">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="projectVisibility" class="form-label">Edit Visibility:</label>
                                                    <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="recipient">
                                                                <option>{{ $projects->recipient }}</option>
                                                                <option>{{ $programName }}</option>
                                                                <option>Public</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="projectDescription" class="form-label">Description:</label>
                                                    <input type="text" class="form-control" id="projectDescription" value="{{ $projects->message }}" name="message">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="add">Save Changes</button>
                                        </div>

                                    </form>
                                    </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal_deleteproject{{ $projects->id }}" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" aria-labelledby="modal_delete" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('agripinaydelete.project') }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="row">
                                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                            </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                       
                                                    </div>
                                                    @if(session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                            <p style="color:red">Are you sure you want to delete this Project?</p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="add" id="saveChanges">Delete</button>
                                                </div>
                                        </form>
                                            </div>
                                    </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="project-info">
                                <h5>Title: {{ $projects->title }}</h5>
                                <img src="{{ asset('Uploads/Updates/'.$projects->attachment) }}">
                                <h2>Visibility: {{ $projects->recipient }}</h2>
                                <hr class="rounded">
                                <div class="description">
                                    <p>Description: {{ $projects->message }}</p>
                                </div>
                            </div>
                            <div class="footer">
                                <button class="edit-btn" title="Edit Project"  data-bs-toggle="modal" data-bs-target="#modal_editproject{{ $projects->id }}" >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="delete-btn" title="Delete Project" data-bs-toggle="modal" data-bs-target="#modal_deleteproject{{ $projects->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                        </div>

                        @endforeach   
                    </div>
                </div>
                </div>
             <button type="button" class="add-project_modal" data-bs-toggle="modal" data-bs-target="#modal_addproject">Add Project</button>
    
            <div class="modal-footer">
                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <!--ADD PROJECT-->
                        <div class="modal fade" id="modal_addproject" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" data-bs-backdrop="static" aria-labelledby="event_modal" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Add Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('agripinayadd.project') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                                <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                    <label id="label_">Title</label>
                                                    <input class="form-control" type="text" id="Title" placeholder="Title.... " name="title" required>   
                                                    <input class="form-control" type="text" id="Title" value="{{ $programName }}" name="from" hidden>                           
                                                </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                        <div class="form-group">
                                                            <label for="edit-recipient">To:</label>
                                                            <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title...." name="recipient" required>
                                                                <option>{{ $programName }}</option>
                                                                <option>Public</option>
                                                            </select>
                                                        </div>
                                                        </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <label id="label_">Message:</label>
                                                            <textarea class="form-control" rows="3" placeholder="Write something..." name="message" required></textarea>
                                                            </div>
                                                            <div class="form-outline">
                                                                <label id="drop-img">
                                                                <input name="image" type="file" id="input-file" required hidden>
                                                                        <div id="img-view">
                                                                            <span id="error-message" style="color: red;"></span>
                                                                                <img src="/images/image_icon.png">
                                                                            <p> Drag and drop or click here <br> to upload picture</p>
                                                                        </div>
                                                                </label>
                                                            </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="add" onclick="validateForm()">Save Changes</button>
                                                </div>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                            </div>
                        </div>

@endsection

<script>
        function validateForm() {
            var fileInput = document.getElementById('input-file');
            var errorMessage = document.getElementById('error-message');

            // Check if a file is selected
            if (fileInput.files.length === 0) {
                errorMessage.textContent = 'Please fill out this field.';
            } else {
                // Reset the error message if a file is selected
                errorMessage.textContent = '';

                // Process the form or do other actions
                // Example: document.getElementById('myForm').submit();
            }
        }
    </script>
     <script src="{{ asset('Assets/js/progress.js') }}"></script>