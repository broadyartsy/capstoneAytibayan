@extends('AGRIPINAY_Project_Coordinator.projectcoordinator_main')

@section('content')
@include('AGRIPINAY_Project_Coordinator.Body.sidebarproj')
    
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
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Key</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Orly</td>
                            <td>Grona</td>
                            <td>Encabo</td>
                            <td>091234567890</td>
                            <td>orlybinhi@gmail.com</td>
                            <td>********</td>
                            <td>3#sdhduf</td>
                            <td>
                            <button class="tooltip-button" data-tooltip="View" onclick="openPopup('Joriza Oliva', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishingLorem ipsum is placeholder text commonly used in the graphic, print, and publishing', 'jorizaoliva@gmail.com', '09772703763', '2023-09-01')">
                            <i class="fa-solid fa-eye fa-2xs"></i>
                            </button>
                            <button class="tooltip-button" data-tooltip="Edit"><i class="fa-solid fa-pen-to-square fa-2xs"></i></button>
                            </td>
                        </tr>
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

            <form action="{{ route('registration') }}" method="post">        
        <div class="btn-bottom">
            <button type="button" class="add">
                Register</button> 
            </div>
    </div>
</form>

<div class="modal fade" id="myModal" tabindex="-1" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="row">
                            <div class="field">
                                <div class="col-4 mb-3">
                                    <label id="label_">Title</label>
                                    <input class="form-control" type="text" id="Title" placeholder="Title.... ">
                                </div>
                                <div class="col-4 mb-3">
                                    <label id="label_">To:</label>
                                    <select class="form-control" type="email" id="to"  onchange= "changeStatus()" placeholder="Title....">
                                        <option value="one"> orly@gmail.com </option>
                                        <option value="two"> joriza@gmail.com</option>
                                        <option value="one"> mathias@gmail.com </option>
                                        <option value="one"> jayferson@gmail.com </option>
                                    </select>
                                    </div>
                                <div class="col-4 mb-3">
                                    <label id="label_">Date</label>
                                        <input class="form-control"  type="date" id="Date" placeholder="Title....">
                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="col-12">
                                <label id="label_">Message:</label>
                                <input class="form-control" type="text" name="message" id="textbox_m" placeholder="Write something...">
                            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="add">Save</button>
         </div>
    </di >
</div>

@endsection
