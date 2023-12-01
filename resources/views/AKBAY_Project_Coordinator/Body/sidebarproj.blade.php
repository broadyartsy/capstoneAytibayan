<nav>
    <div class="logo-name">
    <div class="logo-image">
            <a href="{{ route('visitor.home') }}">
                <img src="\images\Logo_Agripinay.png" alt="Logo">
            </a>
        </div>

        <span class="logo_name">AKBAY</span>
    </div>

    @php
        //Access the authenticated user's id
$id = Illuminate\Support\Facades\AUTH::user()->id;

//Access the specific row data of the user's id
        //when using a model in blade.php, indicate the direct path of the model
        $userProfileData = App\Models\User::find($id);
    @endphp

    <div class="menu-items">
        <ul class="nav-links">
        <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.beneficiaries' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.beneficiaries') }}">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Beneficiaries</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.announcement' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.announcement') }}" >
                    <i class="uil uil-bell"></i>
                    <span class="link-name">Announcement</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.event' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.event') }}" >
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Event</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.inquiry' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.inquiry') }}">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Inquiry</span>
                </a>
            </li>

            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.progress' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.progress') }}">
                    <i class="uil uil-check-circle"></i>
                    <span class="link-name">Progress</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.BlacklistView' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectCoordinator.BlacklistView') }}">
                    <i class="uil uil-x"></i>
                    <span class="link-name">Blacklisted</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'akbayprojectcoordinator.registerView' ? 'active' : '' }}">
                <a href="{{ route('akbayprojectcoordinator.registerView') }}" >
                    <i class="uil uil-user-plus"></i>
                    <span class="link-name">Registration</span>
                </a>
            </li>

            <div class="mode-toggle">

            </div>
            </li>

        </ul>
        <ul class="logout-mode">


            <li><a href="{{ route('akbayprojectCoordinator.logout') }}">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

        </ul>

    </div>
</nav>
<div class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="heading">
            <h1>ALBAY PROVINCIAL AGRICULTURAL OFFICE</h1>
        </div>
        <div class="profile-dropdown">
            <a href="#">
                <i><img src="{{ !empty($userProfileData->photo) ? url('Uploads/Coordinator_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                    class="rounded-circle" alt="User Profile Image"></i>

            </a>
            <ul class="sub-menus">
                <li class="profile-info">
                    <div class="profile-image">
                        <img src="{{ !empty($userProfileData->photo) ? url('Uploads/Coordinator_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                            class="rounded-circle" alt="User Profile Image">
                    </div>
                    <span class="linkname">{{ $userProfileData->first_name }} {{ $userProfileData->last_name }}</span>
                </li>
                <li>
                    <a href="{{ route('akbayprojectcoordinator.viewprofile') }}">
                        <i class="uil uil-user"></i> Profile
                    </a>
                </li>
                <li><a href="{{ route('akbayprojectcoordinator.viewchangepassword') }}"><i class="uil uil-lock"></i> Change Password</a></li>
            </ul>
        </div>





    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{ asset('Assets/js/coordinator.js') }}"></script>
