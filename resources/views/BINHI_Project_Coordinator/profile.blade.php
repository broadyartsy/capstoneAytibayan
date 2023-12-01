<!DOCTYPE html>
<html>

<head>
    <title>Account Profile</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('Assets/css/UserProfile.css') }}">

    {{-- Jquery CDN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


</head>


<body class="profile">
    <div class="main-content">
        <!-- Top navbar -->

        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
            style="max-height: 150px; background-image: url('/images/background.png'); background-size: cover; background-position: center top;">


            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">

                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2">Hello {{ $userProfileData->first_name }}!</h1>
                    <a href="{{ route('BINHI_Project_Coordinator.beneficiary') }}" class="btn btn-info ">Back to Home</a>


                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="{{ !empty($userProfileData->photo) ? url('Uploads/Coordinator_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                                            class="img-fluid rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <div>
                                            <span class="heading">{{ $userProfileData->first_name }}</span>
                                            <span class="description">Given Name</span>
                                        </div>
                                        <div>
                                            <span class="heading">{{ $userProfileData->middle_name }}</span>
                                            <span class="description">Midldle Name</span>
                                        </div>
                                        <div>
                                            <span class="heading">{{ $userProfileData->last_name }}</span>
                                            <span class="description">Last Name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    {{ $userProfileData->email }}
                                   <span class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">

                                    <i class="ni location_pin mr-2"></i>Email Address<br>
                                </div>

                                <h3>
                                    {{ $userProfileData->phone }}
                                    <span class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">

                                    <i class="ni location_pin mr-2"></i>Phone Number<br>
                                </div>


                                <h3>
                                    {{ $userProfileData->barangay }}, {{ $userProfileData->city }},
                                    {{ $userProfileData->province }}, {{ $userProfileData->zip }}
                                  <span
                                        class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">

                                    <i class="ni location_pin mr-2"></i>Address<br>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">My Account</h3>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('binhiprojectcoordinator.editprofile') }}"
                                enctype="multipart/form-data">
                                {{-- by using enctype="multipart/form-data", you are specifying that the form data should be encoded in a way that supports file uploads, enabling the submission of files from the client to the server. --}}

                                @csrf{{-- By including the @csrf directive in your forms, you add an additional layer of protection against CSRF attacks, safeguarding the integrity and security of your application. --}}

                                {{-- name="" is important for updating data --}}
                                
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">

                                        <label class="form-control-label" for="input-ProfileImage">Profile Image</label>


                                        <div class="header1">
                                            <div class="mt-2">
                                            <div class="custom-file">
                                                <label class="custom-file-label" id="custom-file-label" for="input-ProfileImage">Choose a file</label>
                                                <input type="file" class="custom-file-input form-control form-control-alternative" id="input-ProfileImage" name="photo">
                                            </div>

                                        <div class="image-container">
                                                <img id="image-preview"
                                                    src="{{ !empty($userProfileData->photo) ? url('Uploads/Coordinator_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                                                    alt="User Profile Image" class="img-fluid-small  rounded-circle">
                                                    {{-- <span class="delete-icon" id="delete-image-btn">×</span> --}}
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-FirstName">First
                                                    Name</label>
                                                <input type="text" id="Input-FirstName"
                                                    class="form-control form-control-alternative"
                                                    placeholder="FirstName" contenteditable="true"
                                                    value="{{ $userProfileData->first_name }}" name="first_name">
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-MiddleName">Middle
                                                    Name</label>
                                                <input type="text" id="input-MiddleName"
                                                    class="form-control form-control-alternative"
                                                    placeholder="MiddleName" contenteditable="true"
                                                    value="{{ $userProfileData->middle_name }}" name="middle_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-LastName">Last
                                                    Name</label>
                                                <input type="text" id="input-LastName"
                                                    class="form-control form-control-alternative"
                                                    placeholder="LastName" contenteditable="true"
                                                    value="{{ $userProfileData->last_name }}" name="last_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email
                                                    address</label>
                                                <input type="email" id="input-email"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Email Address" value="{{ $userProfileData->email }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-Role">Role</label>
                                                <input type="text" id="input-Role"
                                                    class="form-control form-control-alternative" placeholder="Role"
                                                    value="{{ $userProfileData->role->role_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-program">Program</label>
                                                <input type="text" id="input-program"
                                                    class="form-control form-control-alternative" placeholder="program"
                                                    value="{{ $userProfileData->program->program_name }}" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-Phone">Phone
                                                    Number</label>
                                                <input type="number" class="form-control form-control-alternative"
                                                    placeholder="Phone" contenteditable="true"
                                                    value="{{ $userProfileData->phone }}" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-address">Address</label>
                                                <input id="input-address"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Address" type="text" contenteditable="true"
                                                    value="{{ $userProfileData->barangay }}"
                                                    name="primary_address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text" id="input-city"
                                                    class="form-control form-control-alternative" placeholder="City"
                                                    contenteditable="true" value="{{ $userProfileData->city }}"
                                                    name="city">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-province">Province</label>
                                                <input type="text" id="input-province"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Province" contenteditable="true"
                                                    value="{{ $userProfileData->province }}" name="province">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-postal-code">Postal
                                                    code</label>
                                                <input type="number" id="input-postal-code"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Postal code" contenteditable="true"
                                                    value="{{ $userProfileData->zip }}" name="zip">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="button-container">
                                    <button>Save Changes</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script>
    $(document).ready(function() {
        const imageInput = $('#input-ProfileImage');
        const imagePreview = $('#image-preview');
        const deleteImageBtn = $('#delete-image-btn');

        // Function to hide the delete button
        function hideDeleteButton() {
            deleteImageBtn.hide();
        }

        // Function to show the delete button
        function showDeleteButton() {
            deleteImageBtn.show();
        }

        // Function to update the image preview
        function updateImagePreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }

        // Hide the delete button initially if the default picture is viewed
        if (imagePreview.attr('src') === '{{ asset('Uploads/user-icon-png-person-user-profile-icon-20.png') }}') {
            hideDeleteButton();
        }

        // Listen for file input change
        imageInput.change(function(e) {
            const selectedFile = e.target.files[0];
            if (selectedFile) {
                updateImagePreview(selectedFile);
                showDeleteButton();
            } else {
                hideDeleteButton();
            }
        });

        // Listen for delete image button click
        deleteImageBtn.click(function() {
            imageInput.val(''); // Clear the file input
            imagePreview.attr('src', '{{ asset('Uploads/user-icon-png-person-user-profile-icon-20.png') }}'); // Restore the default image
            hideDeleteButton();
        });

        // Additional script for image input change (if needed)
        $('#input-ProfileImage').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
</body>
