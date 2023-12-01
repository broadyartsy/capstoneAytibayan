@extends('BINHI_Project_Coordinator.projectcoordinator_main')

@section('content')
    @include('BINHI_Project_Coordinator.Body.sidebarproj')


    <div class="title">
        <h1>Progress</h1>
    </div>

    @php
        //Access the authenticated user's id
$userRole = Illuminate\Support\Facades\AUTH::user()->role->role_name;

$userProgramId = Illuminate\Support\Facades\AUTH::user()->program->id;

$benefAssistanceStatuses = [];
//Access the specific row data of the user's id
        //when using a model in blade.php, indicate the direct path of the model
        // $userProfileData = App\Models\User::find($id);
    @endphp

    <div class="boxes">

        <div class="box box-1">
            <h1>Active and Inactive Beneficiaries</h1>
            <div class="chart-inner" id="pie-chart1"></div>
        </div>

        @if (App\Models\Financialassistance::count() > 0)
            @php
            //total pending benef
                $binhiStartedCount = App\Models\User::whereHas('role', function ($query) {
                        $query->where('role_name', 'beneficiary');
                    })
                    ->whereHas('program', function ($query) use ($userProgramId) {
                        $query->where('id', $userProgramId);
                    })
                    ->whereHas('assistance', function ($query) {
                        $query->where('financialassistancestatus_id', 2);
                    })
                    ->count();
                //total pending benef
                $binhiPendingCount = App\Models\User::whereHas('role', function ($query) {
                    $query->where('role_name', 'beneficiary');
                })
                    ->whereHas('program', function ($query) use ($userProgramId) {
                        $query->where('id', $userProgramId);
                    })
                    ->whereHas('assistance', function ($query) {
                        $query->where('financialassistancestatus_id', 3);
                    })
                    ->count();
                //total approved benef
                $binhiApprovedCount = App\Models\User::whereHas('role', function ($query) {
                    $query->where('role_name', 'beneficiary');
                })
                    ->whereHas('program', function ($query) use ($userProgramId) {
                        $query->where('id', $userProgramId);
                    })
                    ->whereHas('assistance', function ($query) {
                        $query->where('financialassistancestatus_id', 4);
                    })
                    ->count();
                //total disbursed benef
                $binhiDisbursedCount = App\Models\User::whereHas('role', function ($query) {
                    $query->where('role_name', 'beneficiary');
                })
                    ->whereHas('program', function ($query) use ($userProgramId) {
                        $query->where('id', $userProgramId);
                    })
                    ->whereHas('assistance', function ($query) {
                        $query->where('financialassistancestatus_id', 5);
                    })
                    ->count();

                $benefExistingProjectCount = App\Models\Financialassistance::count();

                $benefAssistanceStatuses = [$binhiStartedCount, $binhiPendingCount, $binhiApprovedCount, $binhiDisbursedCount];
            @endphp
            <div class="box box-11 ">
                <h1>Existing Beneficiry Projects</h1>
                <p>{{ $benefExistingProjectCount }}</p>
            </div>
            <div class="box box-2">
                <h1>Overall Financial Assistance Statuses</h1>
                <div class="chart-inner" id="pie-chart2"></div>
            </div>
            <div class="box box-3">
                <h1>Progress %</h1>
                <div class="progress-bar"></div>
                <p></p>
            </div>
        @else
            <div class="box box-1 ">
                <h1>Beneficiary Projects</h1>
                <p>No Projects</p>
            </div>
            <div class="box box-2">
                <h1>Overall Financial Assistance Statuses</h1>
                <p>Not Available</p>
            </div>
            <div class="box box-3">
                <h1>Steps Progress</h1>
                <div class="progress-bar"></div>
                <p></p>
            </div>
        @endif

    </div>


    <div class="table-header">
        <div class="table-header-left">
            <label for="unread-filter">Filter: </label>
            <select id="unread-filter">
                        <option value="all">All</option>
                        <option value="Camalig">Camalig</option>
                        <option value="Daraga">Daraga</option>
                        <option value="Guinobatan">Guinobatan</option>
                        <option value="Jovellar">Jovellar</option>
                        <option value="Legazpi City">Legazpi City</option>
                        <option value="Libon">Libon</option>
                        <option value="Ligao">Ligao</option>
                        <option value="Malilipot">Malilipot</option>
                        <option value="Malinao">Malinao</option>
                        <option value="Manito">Manito</option>
                        <option value="Oas">Oas</option>
                        <option value="Pioduran">Pioduran</option>
                        <option value="Sto.Domingo">Sto. Domingo</option>
                        <option value="Tabaco City">Tabaco City</option>
                        <option value="Tiwi">Tiwi</option>
                        <option value="Bacacay">Bacacay</option>
                        <option value="Camalig">Camalig</option>
                        <option value="Daraga">Daraga</option>
                        <option value="Guinobatan">Guinobatan</option>
                        <option value="Jovellar">Jovellar</option>
                        <option value="Legazpi City">Legazpi City</option>
                        <option value="Libon">Libon</option>
                        <option value="Ligao">Ligao</option>
                        <option value="Malilipot">Malilipot</option>
                        <option value="Malinao">Malinao</option>
                        <option value="Manito">Manito</option>
                        <option value="Oas">Oas</option>
                        <option value="Pioduran">Pioduran</option>
                        <option value="Sto.Domingo">Sto. Domingo</option>
                        <option value="Tabaco City">Tabaco City</option>
                        <option value="Tiwi">Tiwi</option>
            </select>
            <label for="status-filter">Status: </label>
            <select id="status-filter">
                        <option value="all">All</option>
                        <option value="started">Started</option>
                        <option value="unsettled">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="disbursed">Disbursed</option>
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
            <h4>AbakaBuhayan Project, "BINHI MO, PISO MO" CASH INCENTIVE SCHEME</h4>
            </div>
        <table class="table" id="beneficiaries-table">


            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Beneficiary</th>
                    <th scope="col">Barangay</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Project</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Hectares</th>
                    <th scope="col" class="no-print">Action</th>
                    <th scope="col">Assistance Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($binhiBeneficiaries as $binhiBeneficiary)
                    {{-- Modal View for Add --}}
                    <div id="add-value-popup-{{ $binhiBeneficiary->id }}" class="add-value-popup">
                        <div class="add-value-popup-content">
                            <span class="add-value-popup-close"
                                onclick="hideAddValuePopup({{ $binhiBeneficiary->id }})">&times;</span>
                            <h2>Add Beneficiary</h2>
                            <form action="{{ route('binhiprojectcoordinator.progressAdd') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf

                                <input type="hidden" name="userId" value="{{ $binhiBeneficiary->id }}">

                                <label for="name">Beneficiary Name:</label>
                                <input type="text" id="name" name="name"
                                    value="{{ $binhiBeneficiary->first_name }} {{ $binhiBeneficiary->middle_name }} {{ $binhiBeneficiary->last_name }}"
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
                                <label for="hectares">Number of Hectares:</label>
                                <input type="number" id="hectares" name="hectares" required min="1" max="5">
                                @error('hectares')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="financialassistancestatus_id" value="2">

                                <button type="submit" class="add">Save Changes</button>
                            </form>
                        </div>
                    </div>

                    {{-- Modal View for Update --}}
                    <div id="update-status-popup-{{ $binhiBeneficiary->id }}" class="update-status-popup">
                        <div class="update-status-popup-content">
                            <span class="update-status-popup-close"
                                onclick="hideUpdateStatusPopup({{ $binhiBeneficiary->id }})">&times;</span>
                            <h2>Beneficiary Progress Details</h2>
                            <p><strong>Beneficiary Name:</strong> <span>{{ $binhiBeneficiary->first_name }}
                                    {{ $binhiBeneficiary->middle_name }} {{ $binhiBeneficiary->last_name }}</span></p>
                            @if ($binhiBeneficiary->assistance)
                                <p><strong>Project:</strong> <span>{{ $binhiBeneficiary->assistance->project }}</span></p>
                                <p><strong>Amount:</strong> <span>{{ $binhiBeneficiary->assistance->amount }}</span></p>
                                <p><strong>Number of Hectares:</strong> <span>{{ $binhiBeneficiary->assistance->number_of_hectares }}</span></p>
                                <p><strong>Last Updated:</strong>
                                    <span>{{ $binhiBeneficiary->assistance->updated_at }}</span>
                                </p>
                            @endif

                            <label for="update-status-dropdown">Update Status:</label>
                            <form action="{{ route('binhiprojectcoordinator.progressUpdate') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf

                                <input type="hidden" name="userId" value="{{ $binhiBeneficiary->id }}">

                                @if ($binhiBeneficiary->assistance)
                                    <input type="hidden" name="assistanceId"
                                        value="{{ $binhiBeneficiary->assistance->id }}">


                                    <select id="update-status-dropdown" name="inputAssistanceUpdate">
                                        @foreach ($filteredassistanceStatuses as $filteredassistanceStatus)
                                            <option value="{{ $filteredassistanceStatus->id }}"
                                                @if ($filteredassistanceStatus->id == $binhiBeneficiary->assistance->financialassistancestatus_id) selected @endif>
                                                {{ $filteredassistanceStatus->financial_assistance_status_name }}</option>
                                        @endforeach
                                    </select>
                                @endif

                                <button type="submit" class="add">Save Changes</button>
                            </form>
                        </div>
                    </div>

                    <tr>
                        <td>{{ $binhiBeneficiary->id }}</td>
                        <td>{{ $binhiBeneficiary->first_name }} {{ $binhiBeneficiary->middle_name }} {{ $binhiBeneficiary->last_name }}</td>
                        <td>{{ $binhiBeneficiary->barangay }}</td>
                        <td>{{ $binhiBeneficiary->city }}</td>
                        <td>{{ $binhiBeneficiary->status->status_name }}</td>
                        @if ($binhiBeneficiary->assistance)
                            <td>{{ $binhiBeneficiary->assistance->project }}</td>
                            <td>{{ $binhiBeneficiary->assistance->amount }}</td>
                            <td>{{ $binhiBeneficiary->assistance->number_of_hectares }}</td>
                            <td class="no-print">
                                <button class="tooltip-button" data-tooltip="Add"
                                    onclick="showAddValuePopup({{ $binhiBeneficiary->id }})" disabled
                                    style="opacity: 0.5; cursor: not-allowed;"><i
                                        class="fa-solid fa-plus fa-2xs"></i></button>
                                <button class="tooltip-button" data-tooltip="Update"
                                    onclick="showUpdateStatusPopup({{ $binhiBeneficiary->id }})"><i
                                        class="fa-solid fa-pen-to-square fa-2xs"></i></button>

                            </td>
                            <td>{{ $binhiBeneficiary->financialAssistanceStatus->financial_assistance_status_name }}</td>
                        @else
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td class="no-print">
                                <button class="tooltip-button" data-tooltip="Add"
                                    onclick="showAddValuePopup({{ $binhiBeneficiary->id }})"><i
                                        class="fa-solid fa-plus fa-2xs"></i></button>
                                <button class="tooltip-button" data-tooltip="Update"
                                    onclick="showUpdateStatusPopup({{ $binhiBeneficiary->id }})" disabled
                                    style="opacity: 0.5; cursor: not-allowed;"><i
                                        class="fa-solid fa-pen-to-square fa-2xs"></i></button>

                            <td>{{ $assistanceUnsettledStatus->financial_assistance_status_name }}</td>
                        @endif
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
        <div class="button-container">
            <button id="printButton" class="button_top"> <i class="fa-solid fa-print" style="color: #ffffff;"></i> Print</button>
            <button id="exportButton" class="button_top"> <i class="fa-solid fa-file-arrow-down" style="color: #fafafa;"></i> Export</button>
        </div>
    </div>







    <div class="progress-container">
        <div class="progress-line">



            <!-- Steps with numbers will be added dynamically here -->
        </div>
        <ul id="progress-num" class="progress-num"></ul>

    </div>

    <div class="progress-section">
        <h3>Process</h3>
        <ul id="progress-list">
            <!-- Steps will be added dynamically here -->
        </ul>

        <div id="progress-percent"></div>
        <button id="add-step">Add Step</button>
        <button id="reset-steps">Reset Steps</button>
    </div>



    <script src="{{ asset('Assets/js/progressBinhi.js') }}"></script>

    {{-- apex charts cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var totalActiveAndInactiveCount = {!! json_encode($totalActiveAndInactiveCount) !!};

        var benefAssistanceStatuses = {!! json_encode($benefAssistanceStatuses) !!};

        // -------------------------------- Pie chart----------------------
        var options = {
            series: totalActiveAndInactiveCount,
            chart: {

                type: 'pie',
                toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
                    show: true
                },
                width: '100%', // Set the width of the chart
                height: 600,
            },
            colors: [
                "#7bb701",
                "#f0a60f",

            ],
            labels: ['Active', 'Inactive'],
            responsive: [{
                    breakpoint: 1000, // Set a breakpoint for smaller screens (e.g., tablets)
                    options: {
                        chart: {
                            width: '90%', // Adjust the width for smaller screens
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                {
                    breakpoint: 769, // Set a breakpoint for even smaller screens (e.g., mobile devices)
                    options: {
                        chart: {
                            width: '40%',

                            height: 450,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                {
                    breakpoint: 694, // Set a breakpoint for even smaller screens (e.g., mobile devices)
                    options: {
                        chart: {
                            width: '50%',

                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            ]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart1"), options);
        chart.render();

        // -------------------------------- Pie chart----------------------
        var options = {
            series: benefAssistanceStatuses,
            chart: {

                type: 'pie',
                toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
                    show: true
                },
                width: '100%', // Set the width of the chart
                height: 600,
            },
            colors: [
                "#7bb701",
                "#f0a60f",
                "#58c0e2",
                "#3F5E5A",

            ],
            labels: ['Started', 'Pending', 'Approved', 'Disbursed'],
            responsive: [{
                    breakpoint: 1000, // Set a breakpoint for smaller screens (e.g., tablets)
                    options: {
                        chart: {
                            width: '90%', // Adjust the width for smaller screens
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                {
                    breakpoint: 769, // Set a breakpoint for even smaller screens (e.g., mobile devices)
                    options: {
                        chart: {
                            width: '40%',

                            height: 450,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                {
                    breakpoint: 694, // Set a breakpoint for even smaller screens (e.g., mobile devices)
                    options: {
                        chart: {
                            width: '50%',

                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            ]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart2"), options);
        chart.render();
    </script>
@endsection
