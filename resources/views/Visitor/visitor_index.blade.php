@extends('Visitor.visitor_home')
@section('visitor')
<button id="scrollToTopButton"><i class="fas fa-arrow-up"></i> </button>


    <div class="page-content">
        <div class="main-cards">
            <div class="image-section">
                <img src="{{ asset('images/apao_visitor.png') }}" alt="apao image" class="apao-big-image">
            </div>
            <div class="horizontal-scroll-image-section">
                <div class="horizontal-scroll-image-content">
                 <img src="{{ asset('images/Lead1.png') }}" alt="apao image" class="apao-horizontal-images">
                    <img src="{{ asset('images/Abaka2.png') }}" alt="apao image" class="apao-horizontal-images">
                    <img src="{{ asset('images/Lead2.png') }}" alt="apao image" class="apao-horizontal-images">
                    <img src="{{ asset('images/Abaka3.png') }}" alt="apao image" class="apao-horizontal-images">
                </div>

            </div>
            <div class="beneficiay-chart-section">
                <div class="beneficiay-chart-section-charts-card">
                    <div class="chart-title">
                        <h4>Number of Beneficiaries</h4>
                    </div>
                    <div id="bar-chart"></div>
                </div>
            </div>
            <div class="beneficiay-chart-section1">
                <div class="beneficiay-chart-section-charts-card">
                    <div class="chart-title">
                        <h4>Monthly Beneficiaries</h4>
                    </div>
                    <div id="line-chart"></div>
                </div>
            </div>
            <div class="top-story-section">
                <div class="top-story-title">
                    <h4>Top Stories</h4>
                </div>
                <div class="stories-main">
                    <div class="story-card">
                        <div class="story-card-image">
                            <img src="{{ asset('images/APAO-R5.jpg') }}" alt="story image">
                        </div>
                        <div class="story-card-content">
                            <h5>EARLIER: Provincial Agriculturist Cheryll O. Rebeta and Assistant Provincial Agriculturist Daryl John O. Buenconsejo attended 
                                the Technical Budget Hearing of the Sangguniang Panlalawigan ng Albay, on November 16, 2023 held at the SPA Session Hall in 
                                Legazpi City.In the session, Provincial Agriculturist Cheryll O. Rebeta presented the proposed annual budget for CY 2024 for 
                                the Albay Provincial Agricultural Office (APAO). The engagement aimed to discuss and scrutinize the financial plan to ensure 
                                its alignment with the objectives and needs of the agriculture sector in the province.</h5>
                        </div>
                    </div>
                    <div class="story-card">
                        <div class="story-card-image">
                            <img src="{{ asset('images/APAO-R5.jpg') }}" alt="story image">
                        </div>
                        <div class="story-card-content">
                            <h5>A briefing was conducted to PAFC Chairperson Rene Delos Reyes, PAFC Co-Chair/Provincial Agriculturist Cheryll O. Rebeta, and 
                                PAFC Secretariat-Coordinator Arminda Padilla by RAFC Regional Executive Officer Aloha Gigi I. Bañaria on November 14, 2023, 
                                at the PMED Conference Room, Department of Agriculture RFO5 in Pili, Camarines Sur. 
                                The briefing focused on the preparation for the National Validation for the Search for Outstanding PAFC, including the roles 
                                of the PAFC Chairperson and PAFC Secretariat-Coordinator.</h5>
                        </div>
                    </div>
                </div>
                <div class="story-read-more">
                    <a href="https://www.facebook.com/apao.albay2023" target="_blank" rel="noopener noreferrer"
                        class="read-more-button">Read More ></a>
                </div>
            </div>
            <div class="description-section">
                <p>In the province of Albay, located in Bicol Region Philippines, the Albay Provincial Agricultural Office 
                    (APAO) is the office assigned in implementing sustainable livelihood programs and is responsible for 
                    promoting agricultural development in Albay. There are currently five different SLPs operating in its 
                    office; the Abaka Mo Piso Mo Cash Incentive Scheme, Binhi ng Pag-asa Program, AgriPinay, Livelihood
                     Enhancement Agricultural Development (LEAD) Program, and the Agrikultura: Kaagapay ng Bayang Pinoy 
                     (AkBay) program. Each program requires APAO to gather data in marginalized communities, especially 
                     farmers in which it includes their demographic profile. 
                </p>
            </div>
      
    <div class="announcements-section">
    <div class="announcements-title">
        <h4>Announcements</h4>
    </div>
    

            @if($announcement->isEmpty())
                <p>No announcements at the moment.</p>
            @else
            @foreach($announcement->reverse() as $announcement)
            @php
                $dayEvent = \Carbon\Carbon::parse($announcement->created_at)->format('d');
                $monthEvent = \Carbon\Carbon::parse($announcement->created_at)->format('M');
                $timeEvent = \Carbon\Carbon::parse($announcement->created_at)->format('h:i A');
            @endphp
        <div class="announcements-card">
            <div class="announcements-card-date-time">
                <div class="announcements-card-date-time-title">
                    <span class="material-symbols-outlined">
                        schedule
                    </span>
                        <span class="announcement-time">{{ $timeEvent }}</span>
                </div>
                <h4>{{ $announcement->title }}</h4>
                <hr class="announcement">
                <h5>{{ $announcement->message }}</h5>
                <h6>{{ $announcement->created_at->format('Y-m-d') }}</h6>
            </div>
        </div>
    @endforeach
    @endif
</div>

            <div class="events-section">
                <div class="events-title">
                    <h4>Upcoming Events</h4>
                </div>
                <div class="events-main">
            @if($events->isEmpty())
                <p>No events at the moment.</p>
            @else
                @foreach($events->reverse() as $event)
            <div class="events-card">
                        <div class="events-card-title-date">
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
                        <div class="events-card-content">
                            <div>
                                <h4>Title: {{ $event->title }}</h4>
                            </div>
                            <h5>{{ $event->message }}</h5>
                            <div>
                                <div class="event-time">Posted: {{$event->created_at->format('Y-m-d h:i A') }}</div>
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

    <section class="about" id="aboutSection">

        <!--background slides!-->
        <div class="slides">
            <div class="slide slide1">
                <img id="img" src="\images\apao_main.png">
            </div>
            <div class="slide slide2">
                <img id="img" src="\images\image2.png">
            </div>
            <div class="slide slide3">
                <img id="img" src="\images\image3.png">
            </div>

        </div>

        <div class="container">
            <div class="box_about lightbox" onclick="openImage(this)">
                <h2>Organizational Chart</h2>
                <img src="\images\apao_orgchart.png">
            </div>

            <div class="main">
                <h2> Vision </h2>
                <div class="line"></div>
                <p>A developed countryside and sustainable production areas led by strong, organized and self-reliant farmers and fisherfolk equipped
                    with modern technologies and entrepreneurial capability ensuring steady supply of farm produceto meet food sufficiency.
                </p>
                <h2> Mission </h2>
                <div class="line"></div>
                <p>To have an available and affordable food for Albayanos.</p>
                <h2 id="missionHeader"> Objectives </h2>
                <div class="line"></div>
                <p>To sustain production od staple foods(rice, corn, and root crops) and high value crops through the transfer of cost-effective,
                environment-friendly technologies to small farmers as well as increase in production areas.
                </p>
                <p>To improve financial food security through enhanced production, entrepreneurship, and greater market access.
                </p>
                <p>To encourage climate change adaptation measures in agriculture and fisheries to ensure food security through extension services, technical assistance,
                    and on-site research and demonstration farms.
                </p>
            </div>

            <div class="box_about lightbox" onclick="openImage(this)">
                <h2>History</h2>
                <img src="\images\history.png" alt="History Image" class="history">
                <div class="txt_history">APAO started in 2009 and drives to established agricultural development in Albay, it has been pivotal in 
                    implementing transformative programs. With a focus on data-driven decisions, 
                    APAO gathers demographic information from farmers to tailor effective initiatives, showcasing a history 
                    marked by adaptability and commitment to sustainable growth in Albay's agricultural sector.</div>
            </div>

        </div><script type="module" src=""></script>
    </section>

    <!------------------ PROGRAM ---------------------->

    <section class="programs_view" id="programsView">
        <div class="title">
            <h1>PROGRAMS</h1>
        </div>
        <div class="container">
            @foreach($programs as $program)
                <div class="box" id="agripinay">
                    <div class="content">
                        <img src="{{ !empty($program->image) ? url('Uploads/Program_images/' . $program->image) : url('Uploads/no-image.jpg') }}" alt="{{ $program->program_name }} logo">
                        <h3>{{ $program->program_name }}</h3>
                        <a href="{{ route('visitor.programsView', $program->id) }}" class="custom-link">
                            <button class="custom-button">View</button>
                        </a>
                    </div>
                </div>
                <!-- Replace 'column_name' with the actual column name you want to display -->
            @endforeach
            {{-- <div class="box" id="binhi-ng-pagasa">

                <div class="content">
                    <img src="\images\Logo_BinhiNgPagasa.png" alt="Image 1">
                    <h3>binhi ng pag-asa</h3>
                    <button onclick="showCategory('binhi-ng-pagasa')" id="binhiButton">View</button>
                </div>
            </div>
            <div class="box" id="agripinay">
                <div class="content">
                    <img src="\images\Logo_AgriPinay.png" alt="Image 2">
                    <h3>agripinay</h3>
                    <button onclick="showCategory('agripinay')">View</button>
                </div>
            </div>
            <div class="box" id="akbay">
                <div class="content">
                    <img src="\images\Logo_Akbay.png" alt="Image 3">
                    <h3>akbay</h3>
                    <button onclick="showCategory('akbay')">View</button>
                </div>
            </div>
            <div class="box" id="abaka-mo-piso-mo">
                <div class="content">
                    <img src="\images\Logo_AbacaMoPisoMo.png" alt="Image 4">
                    <h3>abaka mo, piso mo</h3>
                    <button onclick="showCategory('abaka-mo-piso-mo')">View</button>
                </div>
            </div>
            <div class="box" id="lead">
                <div class="content">
                    <img src="\images\Logo_Lead.png" alt="Image 5">
                    <h3>LEAD</h3>
                    <button onclick="showCategory('lead')">View</button>
                </div>
            </div> --}}
        </div>

        <script>
            function showCategory(category) {
                // Construct the URL for the category page with the selected category as a query parameter
                const url = "{{ route('Visitor.category.page', ['category' => ':category']) }}";
                const finalUrl = url.replace(':category', category);

                // Redirect the current window to the category page URL
                window.location.href = finalUrl;
            }
        </script>
    </section>

    <!------------------ CONTACT ---------------------->
    <section class="contact" id="contact">
    
        <div class="row">
            <div class="col location" id="title" style="margin-left: 10px; margin-top: 10px;">
                <h4><b>Location</b></h4>
                <div class="google-maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3884.687236006442!2d123.67126757469015!3d13.182109510228907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a10785c74a4761%3A0xd97e88fa71115e84!2sAlbay%20Farmers%20Bounty%20Village!5e0!3m2!1sen!2sph!4v1700218921809!5m2!1sen!2sph" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col">
                    <div class="row" style="margin: 10px;">
                        <div id="marker_style"><i class="fa fa-map-marker" id="marker_icon"></i></div>
                        <div class="col" id="address">Albay Farmer's Bounty Village Complex, Camalig, Albay, Philippines</div>
                        
                    </div>
                </div>

                <div style="text-align: end; margin: 10px">
                <a href="mailto:albay.agri@gmail.com" target="_blank" rel="noopener noreferrer">
                     <i class="fa fa-envelope" id="email_icons"></i>
                 </a>
                    <a href="https://www.facebook.com/apao.albay2023" target="_blank" rel="noopener noreferrer">
                        <i class="fa fa-facebook" id="fb_icon"></i>
                    </a>
                    <span title="No Account" class="no-account-hover">
                        <i class="fa fa-instagram" id="ig_icon"></i>
                    </span>
                    <span title="No Account" class="no-account-hover">
                        <i class="fa fa-twitter" id="tw_icon"></i>
                    </span>
                   
                </div>


            </div>
            <div class="col" style="margin-left: 10px; margin-top: 10px;">
                <div class="col-12" id="left_">
                    <div id="proj_coordinator">Program Coordinators</div>
                </div>
            <div class="container">
                <div class="row">
                    @foreach ($coordinators as $coordinator)
                        <div class="col-md-4">
                            <div id ="coordinators">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ !empty($coordinator->photo)
                                            ? ($coordinator->role->role_name === 'itstaff'
                                                ? url('Uploads/ITStaff_Images/' . $coordinator->photo)
                                                : (in_array($coordinator->role->role_name, [
                                                    'binhiprojectcoordinator',
                                                    'abakaprojectcoordinator',
                                                    'agripinayprojectcoordinator',
                                                    'akbayprojectcoordinator',
                                                    'leadprojectcoordinator',
                                                ])
                                                    ? url('Uploads/Coordinator_Images/' . $coordinator->photo)
                                                    : url('Uploads/Beneficiary_Images/' . $coordinator->photo)))
                                            : url('Uploads/user-icon-png-person-user-profile-icon-20.png') }}" class="img-fluid" alt="" id="coordinator_img">
                                    </div>
                                    <div class="col-8">
                                        <div id="c_description">
                                            <div id="c_name">{{ $coordinator->first_name }} {{ $coordinator->middle_name }} {{ $coordinator->last_name }}</div>
                                            <div id="c_program">{{ $coordinator->program->program_name }}</div>
                                            <div id="phone"><i class="fa fa-phone" id="phone_icon"></i>{{ $coordinator->phone }}</div>
                                            <div id="email"><i class="fa fa-envelope" id="email_icon"></i>{{ $coordinator->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat this structure for other coordinators -->
                        </div>
                    @endforeach

                    
                    </div>
                </div>
                <div class="col" id="inquiry">
                    <h5 id="inquiry_">Inquiry</h5>
                    <form method="post" action="{{ route('visitor.inquiry') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <label id="label_">Full Name:</label>
                                    <input class="form-control" type="text" id="textbox" name="fullname" required>
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
                                    <select class="form-control" type="text" name="to" id="textbox" required>
                                        @foreach($programs as $program)    
                                            <option>{{ $program->program_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                           
                            <div class="col-12" style="margin: 5px;">
                                <label id="label_">Message:</label>
                                <input class="form-control" type="text" name="message" id="textbox_m" required>
                            </div>
                           
                            <div class="col" id="button_">
                                <input type="submit" class="btn" value="Send" id="send_">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

<!-- Read Announcement Modal -->
<div class="modal fade" id="read_announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="announcements-card">
                    <div class="announcements-card-date-time">
                        <div class="announcements-card-date-time-title">
                            <span class="material-symbols-outlined">
                            </span>
                            <span class="announcement-time"> </span>
                        </div>
                    </div>
        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="closee" data-bs-dismiss="modal">Close</button>
                <button type="button" class="add" id="save-schedule-button">Save</button>
            </div>
        </div>
    </div>
</div>
   <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
    //EVENT 
    const cards = document.querySelectorAll('.events-card-title-date');

    cards.forEach((card, index) => {
        if (index % 2 === 0) {
            card.classList.add('orange-bg'); // Add orange background class
        } else {
            card.classList.add('green-bg'); // Add green background class
        }
    });
</script>
    <script>
        var programNames = {!! json_encode($programNames) !!};
        var beneficiaryCounts = {!! json_encode($beneficiaryCounts) !!};
        var months = {!! json_encode($months) !!};
        var monthCount = {!! json_encode($monthCount) !!};
    </script>
@endsection
 