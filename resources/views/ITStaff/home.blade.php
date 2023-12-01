<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Home</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <!-- Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('Assets/css/itstaff.css') }}">
    <link rel="icon" href="\images\APAO logo.png" type="image icon">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body class="home">

    @include('ITStaff.Body.sidebar')
   
    <div class="dash-content">
        <div class="picture">
            <img src="\images\background.png" alt="Logo">
        </div>
        
        <div class="user-stats">
                <div class="total-users">
                    <div class=name>
                        <h1>Beneficiaries</h1>
                    </div>
                    <p>Number of beneficiaries in the Sustainable Livelihood Program. </p>
                    <div class="number-box1">
                        <div class="label-number">
                            <span class="label"></span>
                            <span class="number">{{ $totalbeneficiaries }} Beneficiaries</span>
                        </div>
                        <div class="number-line total-line"></div>
                    </div>
                </div>
                    <div class="inactive-active-users">
                        <div class=name>
                            <h1>Accounts</h1><br>
                        </div>
                        <p>Total Number of Users </p>
                        <div class="number-box1">
                            <div class="label-number">
                                <span class="label"></span>
                                <span class="number">59</span>
                            </div>
                            <div class="number-line total-line"></div>
                        </div>
                    </div>
                
                    <div class="boxes1">
                        <div class="box box-1">
                            <h1>Beneficiary Status</h1>
                            <div class="chart-inner" id="pie-chart"></div>
                        </div>
                        <div class="box box-1 ">
                            <h1>Active Beneficiaries per Program</h1>
                            <div id="bar-chart"></div>
                        </div>
                        <div class="box box-1">
                            <h1>Monthly Beneficiaries</h1>
                            <div class="chart-inner" id="line-chart"></div>
                        </div>
                    
                        <div class="box box-1">
                            <h1>Overall System Users</h1>
                            <div class="chart-inner" id="pie-chart1"></div>
                        </div>
                    </div>

            
         
        </div>
             
       
        <div class="title1">
            <h1>programs</h1>
        </div>
        <div class="coord">
                <div class="box">
                    <span class="text">Project Coordinators</span>
                    <span class="number">{{ $totalcoordinators }}</span>
                    <button type="button" class="add-modal" data-bs-toggle="modal"
                        data-bs-target="#modal_announcement">View</button>
                </div>
            </div>
    
        
     <div class="overview">


            <div class="boxes">
                @foreach ($programs as $program)
                    <div class="box box1">
                    <img src="{{ !empty($program->image) ? url('Uploads/Program_images/' . $program->image) : url('Uploads/no-image.jpg') }}" alt="Image 1">
                        <span class="text">{{ $program->program_name }}</span>
                        <span class="label">Total</span>
                        <span class="totalnumber">{{ $total = $program->user()->whereHas('role', function($query) {
                            $query->where('role_name', 'beneficiary');
                        })->count() }} Beneficiaries</span>
                        <div class="number-line totalline">
                            @if ($total > 0)
                                <div class="colored-line total" style="width: 100%;"></div>
                            @else
                                <div class="colored-line total" style="width: 0;"></div>
                            @endif
                        </div>

                        <span class="label">Active:</span>
                        <span class="activenumber">{{ $active = $program->user()->whereHas('role', function($query) {
                            $query->where('role_name', 'beneficiary');
                        })->whereHas('status', function($query) {
                            $query->where('status_name', 'Active');
                        })->count() }} Beneficiaries</span>
                        <div class="number-line activeline">
                            <div class="colored-line active" style="width: {{ $total ? ($active / $total) * 100 : 0 }}%;"></div>
                        </div>

                        <span class="label">Inactive</span>
                        <span class="inactivenumber">{{ $inactive = $program->user()->whereHas('role', function($query) {
                            $query->where('role_name', 'beneficiary');
                        })->whereHas('status', function($query) {
                            $query->where('status_name', 'Inactive');
                        })->count() }} Beneficiaries</span>
                        <div class="number-line inactiveline">
                            <div class="colored-line inactive" style="width: {{ $total ? ($inactive / $total) * 100 : 0 }}%;"></div>
                        </div>


                        <a href="{{ route('itstaff.editProgramView', $program->id) }}" class="custom-link">
                            <button class="custom-button">View</button>
                        </a>


                    </div>
                @endforeach

                

                {{-- <a href="{{ route('itstaff.addProgramView') }}" class="add-button">
                    <button class="plus-button">+</button>
                </a> --}}
            </div>
        </div>

        

    </div>


    <!--MODAL COORDINATOR-->
    <div class="modal fade" id="modal_announcement" tabindex="-1" data-backdrop="false" data-bs-backdrop="static" 
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">PROJECT COORDINATORS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               
                <div class="modal-body">
                    
                    <div class="accordion" id="coordinator_info">
                        @foreach ($coordinators as $key => $coordinator)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="coordinator{{ $key + 1 }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $key + 1 }}"
                                        aria-expanded="false" aria-controls="collapse{{ $key + 1 }}">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="coordinator_img">
                                                    <img
                                                        src={{ !empty($coordinator->photo) ? url('Uploads/ITStaff_Images/' . $coordinator->photo) : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h5>{{ $coordinator->first_name }} {{ $coordinator->middle_name }}
                                                    {{ $coordinator->last_name }}</h5>
                                                @if ($coordinator->program)
                                                    <p>Program Name: {{ $coordinator->program->program_name }}</p>
                                                @else
                                                    <p>No Program Assigned</p>
                                                @endif

                                            </div>

                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse{{ $key + 1 }}" class="accordion-collapse collapse"
                                    aria-labelledby="coordinator{{ $key + 1 }}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row" style="text-align: center;">
                                            <div class="col">
                                                <div class="card_coordinator_img">
                                                    <img src="{{ !empty($coordinator->program->image) ? url('Uploads/Program_images/' . $coordinator->program->image) : url('Uploads/no-image.jpg') }}"
                                                        alt="Program logo">
                                                </div>
                                                <div class="col" style="padding-top:5px">
                                                    @if ($coordinator->program)
                                                        <p>Program Name: {{ $coordinator->program->program_name }}</p>
                                                    @else
                                                        <p>No Program Assigned</p>
                                                    @endif
                                                    <p>Project Coordinator</p>
                                                </div>
                                            </div>
                                        

                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <div class="col" style="padding-top:5px">
                                                <p>
                                                    {{ $coordinator->program->description }}
                                                </p>
                                            </div>
                                        </div>
                                      
                                     
             

                                        
                                    </div>
                                
                            </div>
                           
                        @endforeach
                       
                    </div>
                   
                </div>

                <div class="modal-footer"> </div>

            </div>
        </div>
    </div>


    {{-- apex charts cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var programNames = {!! json_encode($programNames) !!};
        var beneficiaryCounts = {!! json_encode($beneficiaryCounts) !!};
        var months = {!! json_encode($months) !!};
        var monthCount = {!! json_encode($monthCount) !!};
        var totalActiveandInactiveBeneficiaries = {!! json_encode($totalActiveandInactiveBeneficiaries) !!};
        var totalUserAccountsCount = {!! json_encode($totalUserAccountsCount) !!};

        // ---------------------------Charts-----------------------------

//-------------------------------------Bar Chart----------------------------

        var barChartOptions = {
            series: [{
            data: beneficiaryCounts
        }],
            chart: {
            type: 'bar',
            height: '100%',
            width:'100%',
            toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
                show: true
            },
        },
        colors: [
            "#7bb701",
            "#f0a60f",
            "#7bb701",
            "#f0a60f",
            "#7bb701",
            "#f0a60f",
            "#7bb701",
            "#f0a60f",
            "#7bb701",
            "#f0a60f",
            "#7bb701",
            "#f0a60f"
        ],
        plotOptions: {
            bar: {
            distributed: true, //distributes the custom colors defined
            borderRadius: 4,
            horizontal: false,
            columnWidth: '40%',
           
            }
        },
        dataLabels: {
            enabled: true
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: programNames,
        },
        yaxis: {
            title: {
                text: "Beneficiaries"
            }
        }
        };

            var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
        barChart.render();

        // -----------------------------------Line chart-----------------------------
        var options = {
        series: [{
        name: "Beneficiaries",
        data: monthCount
        }],
        chart: {
        height: '100%',
        width:'100%',
  
        type: 'line',
        zoom: {
        enabled: false
        },
        toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
            show: true
        },
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'straight',
        colors: '#f0a60f',
        },
        markers: {
        size: 5,
        },
        title: {
        text: 'Beneficiary Trends by Month',
        align: 'left'
        },
        grid: {
        row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
        },
        },
        xaxis: {
        categories: months,
        }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart"), options);
        chart.render();

        // -------------------------------- Pie chart----------------------
        var options = {
          series: totalActiveandInactiveBeneficiaries,
          chart: {
  
          type: 'pie',
          toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
                show: true
            },
            width:'100%', // Set the width of the chart
        height: 450,
        },
        colors: [
            "#7bb701",
            "#f0a60f",
          
        ],
        labels: ['Active', 'Inactive'],
    responsive: [
        {
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
       
        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();

        // -------------------------------- Pie chart2----------------------
        var options = {
          series: totalUserAccountsCount,
          chart: {
  
          type: 'donut',
          toolbar: { //toolbar enabled, users can DL the chart into svg, csv, and png
                show: true
            },
            width:'100%', // Set the width of the chart
        height: 900,
        },
        colors: [
            "#7bb701",
            "#f0a60f",
            "#56b1cf",
          
        ],
   
        labels: ['IT Staffs', 'Coordinators', 'Beneficiaries'],
    responsive: [
        {
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
    </script>

    <!-- custom JS -->
    <script src="{{ asset('Assets/js/itstaff.js') }}"></script>

    <!--SA MODAL/POPUP TO AH -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
