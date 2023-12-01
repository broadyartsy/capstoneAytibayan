<nav>
    <div class="logo-name">
        <div class="logo-image">
        <a href="{{ route('visitor.home') }}">
            <img src="\images\logo.png" alt="">
            </a>
        </div>

        <span class="logo_name">IT Staff</span>
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
            <li  class="{{ request()->is('ITStaff/home') ? 'active' : '' }}">
                <a href="{{ route('itstaff.home') }}">
                    <i class="uil uil-home"></i>
                    <span class="link-name">Home</span>
                </a>
            </li>
            <li  class="{{ request()->is('ITStaff/announcement') ? 'active' : '' }}">
                <a href="{{ route('itstaff.announcement') }}"
                   >
                    <i class="uil uil-bell"></i>
                    <span class="link-name">Announcement</span>
                </a>
            </li>
            <li class="{{ request()->is('ITStaff/event') ? 'active' : '' }}">
                <a href="{{ route('itstaff.event') }}" >
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Event</span>
                </a>
            </li>
            <li>
                <a href="{{ route('itstaff.TransactionsView') }}">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Transactions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('itstaff.BlacklistView') }}">
                    <i class="uil uil-x"></i>
                    <span class="link-name">Blacklisted</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() ==  'itstaff.registerView' ? 'active' : '' }}">
                <a href="{{ route('itstaff.registerView') }}">
                    <i class="uil uil-user-plus"></i>
                    <span class="link-name">Registration</span>
                </a>
            </li>
             
            {{-- @auth
                @if (Route::has('register'))
                <li class="{{ Route::currentRouteName() == 'itstaff.register' ? 'active' : '' }}">
                        <a href="{{ route('register') }}">
                            <i class="uil uil-user-plus"></i>
                            <span class="link-name">Registration</span>
                        </a>
                    </li>
                @endif
            @endauth --}}
           

            <div class="mode-toggle">

            </div>
            </li>

        </ul>
        <ul class="logout-mode">


            <li><a href="{{ route('itstaff.logout') }}">
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
                <i><img src="{{ !empty($userProfileData->photo) ? url('Uploads/ITStaff_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                        class="rounded-circle" alt="User Profile Image"></i>

            </a>
            <ul class="sub-menus">
                <li class="profile-info">
                    <div class="profile-image">
                        <img src="{{ !empty($userProfileData->photo) ? url('Uploads/ITStaff_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                            class="rounded-circle" alt="User Profile Image">
                    </div>
                    <span class="linkname">{{ $userProfileData->first_name }} {{ $userProfileData->middle_name }} {{ $userProfileData->last_name }}</span>
                </li>
                <li>
                    <a href="{{ route('itstaff.viewprofile') }}">
                        <i class="uil uil-user"></i> Profile
                    </a>
                </li>
                <li><a href="{{ route('itstaff.viewchangepassword') }}"><i class="uil uil-lock"></i> Change
                        Password</a></li>
            </ul>
        </div>





    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

    <script src="{{ asset('Assets/js/itstaff.js') }}"></script>
