<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('Assets/css/UserProfile.css') }}">
    <script src="https://kit.fontawesome.com/6297197d39.js" crossorigin="anonymous"></script>

</head>
{{-- @php
        //Access the authenticated user's id
$id = Illuminate\Support\Facades\AUTH::user()->id;

//Access the specific row data of the user's id
        //when using a model in blade.php, indicate the direct path of the model
        $userProfileData = App\Models\User::find($id);
    @endphp --}}

<body class="profile">
    <div class="main-content">
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
            style="max-height: 150px; background-image: url('/images/background.png'); background-size: cover; background-position: center top;">
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2"></h1>
                    <a href="{{ route('beneficiary.home') }}" class="btn btn-info ">Back to Home</a>
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
                                        <img src="{{ !empty($userProfileData->photo) ? url('Uploads/Beneficiary_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
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
                                            <span class="heading">{{ $userProfileData->first_name }} </span>
                                            <span class="description">Given Name</span>
                                        </div>
                                        <div>
                                            <span class="heading">{{ $userProfileData->middle_name }}</span>
                                            <span class="description">Midldle Name</span>
                                        </div>
                                        <div>
                                            <span class="heading"> {{ $userProfileData->last_name }}</span>
                                            <span class="description">Last Name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    {{ $userProfileData->email }}<span class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">

                                    <i class="ni location_pin mr-2"></i>Email Address<br>
                                </div>

                                <h3>
                                    {{ $userProfileData->phone }}<span class="font-weight-light"></span>
                                </h3>
                                <div class="h5 font-weight-300">

                                    <i class="ni location_pin mr-2"></i>Phone Number<br>
                                </div>


                                <h3>
                                    {{ $userProfileData->primary_address }}, {{ $userProfileData->city }},
                                    {{ $userProfileData->province }}, {{ $userProfileData->zip }}<span
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
                                    <h3 class="mb-0">Password Configuration</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('beneficiary.editchangepassword') }}">
                                @csrf
                                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="inputOldPassword">Old Password</label>
                                        <div class="input-group">
                                        <input type="password" name="inputOldPassword"
                                            class="form-control form-control-alternative @error('inputOldPassword') is-invalid @enderror"
                                            id="inputOldPassword" placeholder="Old Password" autocomplete="off">
                                        <span class="eyeicon" id="eyeIconOld" style="display: none;" onclick="togglePasswordVisibility('inputOldPassword', 'eyeIconOld')">
                                            <i class="fas fa-eye-slash" style="color: #808080;"></i>
                                        </span>
                                    </div>
                                    @error('inputOldPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                            
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="inputNewPassword">New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="inputNewPassword"
                                                class="form-control form-control-alternative @error('inputNewPassword') is-invalid @enderror"
                                                id="inputNewPassword" placeholder="New Password" autocomplete="off">
                                            <span class="eyeicon" id="eyeIconNew" style="display: none;" onclick="togglePasswordVisibility('inputNewPassword', 'eyeIconNew')">
                                                <i class="fas fa-eye-slash" style="color: #808080;"></i>
                                            </span>
                                        </div>
                                        @error('inputNewPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group focused">
                                        <label class="form-control-label" for="inputConfirmNewPassword">Confirm New
                                            Password</label>
                                            <div class="input-group">
                                                <input type="password" name="inputNewPassword_confirmation"
                                                    class="form-control form-control-alternative" id="inputConfirmNewPassword"
                                                    placeholder="Confirm New Password" autocomplete="off">
                                                <span class="eyeicon" id="eyeIconConfirmNew" style="display: none;" onclick="togglePasswordVisibility('inputConfirmNewPassword', 'eyeIconConfirmNew')">
                                                    <i class="fas fa-eye-slash" style="color: #808080;"></i>
                                                </span>
                                            </div>
                                    </div>
                                <hr class="my-4">
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('Assets/js/changepass.js') }}"></script>

</body>

</html>
