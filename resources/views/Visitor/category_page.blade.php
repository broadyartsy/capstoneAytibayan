<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('Assets/css/visitor.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title> Program </title>
    <link rel="icon" href="\images\APAO logo.png" type="image icon">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body class="infos">


<!-- header -->
<!-- partial:partials/_header.html -->
@include('Visitor.Body.navbar')
<!-- header -->




<!-- main content -->
@yield('visitor')
<!-- main content -->




    <!-- About Section -->
    <div id="about-section">
        <div id="logo">
            <img src="\images\logo.png" alt="Logo">
            <img src="{{ !empty($program->image) ? url('Uploads/Program_images/' . $program->image) : url('Uploads/no-image.jpg') }}" alt="Logo">
        </div>
        <h2 id="about-heading"></h2>
        <div id="program-name"> {{ $program->program_name }} </div>
        <div id="program-location"> {{ $program->location }} </div>
        <div id="program-email"> {{ $program->email }} </div>
        <img id="about-image" src="{{ !empty($program->background_image) ? url('Uploads/Program_images/' . $program->background_image) : url('Uploads/no-image.jpg') }}" alt="Category Image">

        

        <div id="about-program" class="about-content">
            <h3>About</h3>
            <p>{{ $program->description }}</p>
             
        </div>
    </div>

    
</body>
</html>
    <div id="main-container">
   
        <div id="left-container">
            <div class="box">
                <h1>Number of Beneficiaries</h1>
                <p>{{$program->user()->whereHas('role', function($query) {
                    $query->where('role_name', 'beneficiary');
                })->count()}}</p>
            </div>
            <div class="box">
                <div class="line-chart">
                    <div class="chart-title">
                        <h4></h4>
                    </div>
                    <div id="line-chart"></div>
                </div>
            </div>
            <div class="box1">
                <h1>How To Apply</h1>
                <h2>1</h2>
                <p>{{ $program->quiry }}</p>
                {{-- <h2>2</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <h2>3</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <h2>4</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> --}}
            </div>
            <div class="box1">
            <h1>Guidelines & Requirements</h1>
                <h2>1</h2>
                <p>{{ $program->requirements }}</p>
                {{-- <h2>2</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <h2>3</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <h2>4</h2>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> --}}
            </div>
        </div>
        <div id="right-container">
              <!-- Content for the right section -->
              <div class="title" >
                 <h3>Projects</h3>
            </div>
            @if($project->isEmpty())
            <div class="project">
                <p>No projects yet</p>
            </div>
            @else
                @foreach($project->reverse() as $project)
                    <div class="project">
                        <div class ="project-image">
                            <img src="{{ asset('Uploads/Updates/'.$project->attachment) }}">
                        </div>
                        <div class="eme">
                            <h1>Title: {{ $project->title }}</h1>
                            <h2>Description: {{ $project->message }}</h2>
                        </div>
                    </div>
                @endforeach
                @endif
            <div class="col" id="inquiry">
				<h5 id="inquiry_">Inquiry</h5>
				<form method="post" action="{{ route('specificinquiry.send') }}">
					@csrf
                    <div class="col">
						<div class="row">
							<div class="col-6">
								<label id="label_">Full Name:</label>
								<input class="form-control" type="text" id="textbox" name="fullname">
                                <input class="form-control" type="text" id="textbox" name="from" value="Public User" hidden>
							</div>
							<div class="col-6">
								<label id="label_">Email:</label>
								<input class="form-control" type="text" name="email" id="textbox" required>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="row">
							<div class="col-6">
								<label id="label_">Contact Number:</label>
								<input class="form-control" type="text" name="contact" id="textbox" required>
							</div>
							<div class="col-6">
								<label id="label_">To:</label>
								<input class="form-control" type="text" name="to" id="textbox" value="{{ $program->program_name }}" readonly>
							</div>
						</div>
					    </div>
					<div>    
					<div class="col-12" style="margin: 5px;">
						<label id="label_">Message:</label>
						<input class="form-control" type="text" name="message" id="textbox_m">
					</div>
					<div class="col" id="button_">
						<input type="submit" class="btn" value="Send" id="send_">
					</div>
					</div>
			   	</form>
			</div>
        </div>

    </div>
    {{-- apex charts cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var beneficiaries = @json($beneficiaries);
        var cities = beneficiaries.map(function(beneficiary) {
            return beneficiary.city;
        });
        var beneficiaryCount = beneficiaries.map(function(beneficiary) {
            return beneficiary.count;
        });

        // Your JavaScript code for the chart, using the data above
        var options = {
            series: [{
                name: "Beneficiaries",
                data: beneficiaryCount
            }],
            chart: {
                height: 250,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
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
                text: 'Beneficiaries Per City',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: cities,
            }
        };

        var chart = new ApexCharts(document.querySelector("#line-chart"), options);
        chart.render();
    </script>

    <script>
        function showInfo(category) {
            const aboutHeading = document.getElementById('about-heading');
            const aboutImage = document.getElementById('about-image');
            const beneficiaries = document.getElementById('beneficiaries');
            const sampleGraph = document.getElementById('sample-graph');
            const applicationGuidelines = document.getElementById('application-guidelines');
            const requirements = document.getElementById('requirements');
            const projectsTableBody = document.getElementById('projects-table-body');

            const categoryInfo = {
                // Same category information as in the previous code
            };

            if (category in categoryInfo) {
                aboutHeading.textContent = categoryInfo[category].heading;
                aboutImage.src = categoryInfo[category].imageSrc;
                beneficiaries.textContent = categoryInfo[category].beneficiaries;
                sampleGraph.innerHTML = categoryInfo[category].sampleGraph;
                applicationGuidelines.textContent = categoryInfo[category].applicationGuidelines;
                requirements.textContent = categoryInfo[category].requirements;

                // Render projects table
                const projects = categoryInfo[category].projects;
                projectsTableBody.innerHTML = '';
                for (const project of projects) {
                    const row = document.createElement('tr');
                    const nameCell = document.createElement('td');
                    const descriptionCell = document.createElement('td');
                    const dateCell = document.createElement('td');

                    nameCell.textContent = project.name;
                    descriptionCell.textContent = project.description;
                    dateCell.textContent = project.date;

                    row.appendChild(nameCell);
                    row.appendChild(descriptionCell);
                    row.appendChild(dateCell);
                    projectsTableBody.appendChild(row);
                }
            }
        }

        // Get the category from the URL query string and show the information
        const urlParams = new URLSearchParams(window.location.search);
        const categoryToShow = urlParams.get('category');
        if (categoryToShow) {
            showInfo(categoryToShow);
        }
    </script>
</body>
</html>
