@extends('Beneficiary.beneficiary_main')

@section('content')
    @include('beneficiary.Body.sidebar')

    <div class="title">
        <h1>Home</h1>
    </div>

    @php
        // Access the authenticated user's id
    $id = Illuminate\Support\Facades\Auth::user()->id;

// Access the specific row data of the user's id
// When using a model in blade.php, indicate the direct path of the model
$userProfileData = App\Models\User::find($id);

$authUser = Illuminate\Support\Facades\Auth::user();

$description = App\Models\FinancialAssistanceStatus::find(1)->description;

        $statusName = App\Models\FinancialAssistanceStatus::find(1)->financial_assistance_status_name;

if ($authUser->assistance) {
    $userAssistanceStatus = auth()->user()->financialAssistanceStatus->financial_assistance_status_name;
}
elseif ($authUser->loan){
    $userAssistanceStatus = auth()->user()->loanstatus->loan_status_name;
}
else {
    $userAssistanceStatus = $statusName;
}

        

        

        $descriptionStarted = App\Models\FinancialAssistanceStatus::find(2)->description;

        $descriptionPending = App\Models\FinancialAssistanceStatus::find(3)->description;

        $descriptionApproved = App\Models\FinancialAssistanceStatus::find(4)->description;

        $descriptionDisbursed = App\Models\FinancialAssistanceStatus::find(5)->description;

        $descriptionLoan = App\Models\Loanstatus::find(1)->description;

        $statusNameLoan = App\Models\Loanstatus::find(1)->loan_status_name;

        $descriptionStartedLoan = App\Models\Loanstatus::find(2)->description;

        $descriptionPendingLoan = App\Models\Loanstatus::find(3)->description;

        $descriptionApprovedLoan = App\Models\Loanstatus::find(4)->description;

        $descriptionDisbursedLoan = App\Models\Loanstatus::find(5)->description;


    @endphp

  <div class="card-container">

        <!-- Card 1 -->
        <div class="row">
            <div class="col-md-4">
                <div class="card-progress">
                    <h2 class="card-title">PROGRESS</h2>
                    <div class="card-content">
                        @if ($authUser->assistance)
                            <div class="chart" id="progressChart">
                                <span class="progress-value"></span>
                            </div>
                            <h6>{{ ucwords($authUser->financialAssistanceStatus->financial_assistance_status_name) }}</h6>

                            <div class="progressbar">
                                <ul>
                                    @if ($authUser->assistance->financialassistancestatus_id === 2)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStarted }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPending }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApproved }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursed }}</p>
                                        </li>
                                    @elseif ($authUser->assistance->financialassistancestatus_id === 3)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStarted }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPending }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApproved }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursed }}</p>
                                        </li>
                                    @elseif ($authUser->assistance->financialassistancestatus_id === 4)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStarted }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPending }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three active" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApproved }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursed }}</p>
                                        </li>
                                    @elseif ($authUser->assistance->financialassistancestatus_id === 5)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStarted }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPending }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three active" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApproved }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four active" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursed }}</p>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        @elseif ($authUser->loan)
                        <div class="chart" id="progressChart">
                            <span class="progress-value"></span>
                        </div>
                        <h6>{{ ucwords($authUser->loanstatus->loan_status_name) }}</h6>

                            <div class="progressbar">
                                <ul>
                                    @if ($authUser->loan->loanstatus_id === 2)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStartedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPendingLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApprovedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursedLoan }}</p>
                                        </li>
                                    @elseif ($authUser->loan->loanstatus_id === 3)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStartedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPendingLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApprovedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursedLoan }}</p>
                                        </li>
                                    @elseif ($authUser->loan->loanstatus_id === 4)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStartedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPendingLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three active" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApprovedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursedLoan }}</p>
                                        </li>
                                    @elseif ($authUser->loan->loanstatus_id === 5)
                                        <li>
                                            <div class="progress one active" style="cursor: auto;">
                                                <p>1</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionStartedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress two active" style="cursor: auto;">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionPendingLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress three active" style="cursor: auto;">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionApprovedLoan }}</p>
                                        </li>
                                        <li>
                                            <div class="progress four active" style="cursor: auto;">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text">{{ $descriptionDisbursedLoan }}</p>
                                        </li>
                                    @endif

                                </ul>
                            </div>

                        @else
                            <div class="chart" id="progressChart">
                                <span class="progress-value"></span>
                            </div>
                            <h4>{{ ucwords($statusName) }}</h4>

                            <div class="progressbar">
                                <ul>
                                    <li>
                                        <h5>{{ $description }}</h5>
                                    </li>

                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        
            <!-- Special prject -->
            <div class="col-md-8">
                <div class="card-project">
                    <h2 class="card-title">PROJECTS</h2>
                    <div class="card-content">
                    @if($project->isEmpty())
                    <div class="project-info">
                        <p>No projects yet</p>
                    </div>
                    @else
                        @foreach($project->reverse() as $project)
                        <div class="project-info">
                            <div class="project-image">
                                <img src="{{ asset('Uploads/Updates/'.$project->attachment) }}"  class="img-fluid">
                            </div>
                            <div class="project-body">
                                <div class="project-title">Title: {{ $project->title }}</div>
                                <div class="project-text">Description: {{ $project->message }}</div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card-announcement">
                            <h2 class="card-title">ANNOUNCEMENT</h2>
                            <div class="card-content">
                            @if($announcement->isEmpty())
                                <p>No announcements at the moment.</p>
                            @else
                                @foreach($announcement->reverse() as $announcements)
                                    @php
                                        $dayEvent = \Carbon\Carbon::parse($announcements->created_at)->format('d');
                                        $monthEvent = \Carbon\Carbon::parse($announcements->created_at)->format('M');
                                        $timeEvent = \Carbon\Carbon::parse($announcements->created_at)->format('h:i A');
                                    @endphp
                                 
                                <div class="announcement-info">
                                <div class="announcements-card-date-time-title">
                                    <span class="material-symbols-outlined">
                                        schedule
                                    </span>
                                        <span class="announcement-time">{{ $timeEvent }}</span>
                                </div>
                                    <div class="announcement-time"> From: {{ $announcements->from }}</div>
                                    <div class="announcement-title"> {{ $announcements->title }}</div>
                                    <hr class="announcement">
                                    <div class="announcement-text">{{ $announcements->message }}</div>
                                    <div class="footer">
                                  <div class="date">{{ $announcements->created_at->format('Y-m-d') }}</div>
                                 

                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-event">
                            <h2 class="card-title">EVENT</h2>
                            <div class="card-content">
                            @if($events->isEmpty())
                                <p>No events at the moment.</p>
                            @else
                            @foreach($events->reverse() as $event)
                                <div class="event-info">
                                    <div class="event-date">
                                    @php
                                        $dayEvent = \Carbon\Carbon::parse($event->date)->format('d');
                                        $monthEvent = \Carbon\Carbon::parse($event->date)->format('M');
                                        $yearEvent = \Carbon\Carbon::parse($event->date)->format('Y');
                                        $timeEvent = \Carbon\Carbon::parse($event->created_at)->format('H:i:s');
                                    @endphp
                                        <div class="year">{{ $yearEvent }}</div>
                                        <div class="date">{{ $dayEvent }}</div>
                                        <div class="month">{{ $monthEvent }}</div>
                                       
                                    </div>

                                    <div class="event-body">
                                        <div class="event-title">Title: {{ $event->title }}</div>
                                        <div class="event-text">{{ $event->message }}</div>
                                        
                                       
                                        <div class="footer">
                                        <div class="time"> Posted: {{$event->created_at->format('Y-m-d h:i A')}}</div>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
