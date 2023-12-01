<nav>
    <div class="logo-name">

        @php
        //Access the authenticated user's id
$id = Illuminate\Support\Facades\AUTH::user()->id;

//Access the specific row data of the user's id
        //when using a model in blade.php, indicate the direct path of the model
        $userProfileData = App\Models\User::find($id);
    @endphp

    <div class="logo-image">
            <a href="{{ route('visitor.home') }}">
                <img src="\images\Logo_AbacaMoPisoMo.png" alt="Logo">
            </a>
        </div>

        <span class="logo_name">{{ $userProfileData->program->program_name }}</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
        <li class="{{ Route::currentRouteName() ==  'beneficiary.home' ? 'active' : '' }}">
                <a href="{{ route('beneficiary.home') }}">
                    <i class="uil uil-home"></i>
                    <span class="link-name">Home</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() ==  'beneficiary.schedule' ? 'active' : '' }}">
                <a href="{{ route('beneficiary.schedule') }}" >
                    <i class="uil uil-schedule"></i>
                    <span class="link-name">Schedule</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() ==  'beneficiary.updates' ? 'active' : '' }}">
                <a href="{{ route('beneficiary.updates') }}" >
                    <i class="uil uil-process"></i>
                    <span class="link-name">Send Updates</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteName() ==  'beneficiaryprogram.profile' ? 'active' : '' }}">
                <a href="{{ route('beneficiaryprogram.profile') }}" >
                    <i class="uil uil-user-square"></i>
                    <span class="link-name">Program Profile</span>
                </a>
            </li>


           

            <div class="mode-toggle">

            </div>
            </li>

        </ul>
        <ul class="logout-mode">


            <li><a href="{{ route('beneficiary.logout') }}">
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
    <div class="icons">
    <div class="notification-icon" id="notification-button">
    <i class="uil uil-bell">
    @if($userProfileData->unreadNotifications->count())
    <span class="badge badge-light" style="color: orange; font-weight: bold;position: absolute; top: -4px; right: 0;">{{ $userProfileData->unreadNotifications ->count() }}</span>
    @endif
    </i>

    <!-- Notification Dropdown -->
    <div class="notification-dropdown" id="notification-dropdown">
        <h2>Notifications</h2>
        <li><a  href="{{ route('markAsRead') }}">Mark All as Read</a></li>

        <div>
    @if($userProfileData->unreadNotifications->isNotEmpty() || $userProfileData->readNotifications->isNotEmpty())
        @foreach($userProfileData->unreadNotifications as $notification)
            <ul>
                <li style="background-color: lightgray;">
                    <a href="{{ route('schedule.benef') }}">
                        {{ isset($notification->data['message']) ? $notification->data['message'] . ',' : '' }}
                        {{ isset($notification->data['date']) ? $notification->data['date'] . ',' : '' }}
                        {{ isset($notification->data['time']) ? $notification->data['time'] : '' }}
                    </a>
                </li>
            </ul>
        @endforeach

        @foreach($userProfileData->readNotifications as $notification)
            <ul>
                <li>
                    <a href="#">
                        {{ isset($notification->data['message']) ? $notification->data['message'] . ',' : '' }}
                        {{ isset($notification->data['date']) ? $notification->data['date'] . ',' : '' }}
                        {{ isset($notification->data['time']) ? $notification->data['time'] : '' }}
                    </a>
                </li>
            </ul>
        @endforeach
    @else
    <p class="no-notifications">No notifications.</p>
    @endif
</div>
</div>
</div>
            <div class="message-icon">
            <a href="{{ route('beneficiary.inquiry') }}" class="{{ Route::currentRouteName() ==  'beneficiary.inquiry' ? 'active' : '' }}">
                    <i class="uil uil-comment-dots"></i>
                </a>
            </div>
        </div>
        <div class="profile-dropdown">
            <a href="#">
                <i><img src="{{ !empty($userProfileData->photo) ? url('Uploads/Beneficiary_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                    class="rounded-circle" alt="User Profile Image"></i>

            </a>
            <ul class="sub-menus">
                <li class="profile-info">
                    <div class="profile-image">
                        <img src="{{ !empty($userProfileData->photo) ? url('Uploads/Beneficiary_Images/' . $userProfileData->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}"
                            class="rounded-circle" alt="User Profile Image">
                    </div>
                    <span class="linkname">{{ $userProfileData->first_name }} {{ $userProfileData->middle_name }}{{ $userProfileData->last_name }}</span>
                </li>
                <li>
                    <a href="{{ route('beneficiary.viewprofile') }}">
                        <i class="uil uil-user"></i> Account
                    </a>
                </li>
                <li><a href="{{ route('beneficiary.viewchangepassword') }}"><i class="uil uil-lock"></i> Change Password</a></li>
            </ul>
        </div>





    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  



    <script src="{{ asset('Assets/js/beneficiary.js') }}"></script>
