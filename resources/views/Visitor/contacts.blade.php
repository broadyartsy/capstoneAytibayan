<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contacts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('visitor.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="grid-container">
	<!-- header -->
		<!-- partial:partials/_header.html -->
		@include('ITStaff.Body.header')
		<!-- header -->

		<!-- Sidebar -->
		@include('ITStaff.Body.sidebar')
		<!-- Sidebar -->

		<!-- main content -->
		@yield('itstaff')
		<!-- main content -->
		
		<!-- Footer -->
		@include('ITStaff.Body.footer')
		<!-- Footer -->
</div>
	<div class="row">
		<div class="col" id="title">
			<h4><b>Location</b></h4>
			<div id="location_">
				<img src="{{ URL('images/APAO.png') }}" class="img-fluid" id="location_img">
			</div>
			<div class="col">
			<div class="row" style="margin: 10px;">
				<div id="marker_style"><i class="fa fa-map-marker" id="marker_icon"></i></div>
				<div class="col" id="address">Albay Farmer's Village Complex, Camalig, Philippines</div>
			</div>
			</div>
			
			<div style="text-align: end; margin: 10px">
			<i class="fa fa-facebook" id="fb_icon"></i>
			<i class="fa fa-instagram" id="ig_icon"></i>
			<i class="fa fa-twitter" id="tw_icon"></i>
			</div>
		</div>
		<div class="col" style="margin-left: 10px; margin-top: 10px;">
			<div class="col-12" id="left_">
				<div id="proj_coordinator">Program Coordinators</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="col-12" id="coordinators">
						<div class="row">
							<div>
								<img src="{{ URL('images/default.png') }}" class="img-fluid" alt="" id="coordinator_img">
							</div>
							<div id="c_description">
								<div id="c_name">Marife S. Azares</div>
								<div id="c_program">BINIHI NG PAG-ASA PROGRAM</div>
								<div id="phone"><i class="fa fa-phone" id="phone_icon"></i>XXXXXXXXXXX</div>
								<div id="email"><i class="fa fa-envelope" id="email_icon"></i>email.com</div>
							</div>
						</div>
					</div>
					<div class="col-12" id="coordinators">
						<div class="row">
							<div>
								<img src="{{ URL('images/default.png') }}" class="img-fluid" alt="" id="coordinator_img">
							</div>
							<div id="c_description">
								<div id="c_name">Marife S. Azares</div>
								<div id="c_program">AKBAY PROGRAM</div>
								<div id="phone"><i class="fa fa-phone" id="phone_icon"></i>XXXXXXXXXXX</div>
								<div id="email"><i class="fa fa-envelope" id="email_icon"></i>email.com</div>
							</div>
						</div>
					</div>
					<div class="col-12" id="coordinators">
						<div class="row">
							<div>
								<img src="{{ URL('images/default.png') }}" class="img-fluid" alt="" id="coordinator_img">
							</div>
							<div id="c_description">
								<div id="c_name">Marife S. Azares</div>
								<div id="c_program">LEAD PROGRAM</div>
								<div id="phone"><i class="fa fa-phone" id="phone_icon"></i>XXXXXXXXXXX</div>
								<div id="email"><i class="fa fa-envelope" id="email_icon"></i>email.com</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="col-12" id="coordinators">
						<div class="row">
							<div>
								<img src="{{ URL('images/default.png') }}" class="img-fluid" alt="" id="coordinator_img">
							</div>
							<div id="c_description">
								<div id="c_name">Marife S. Azares</div>
								<div id="c_program">AGRIPINAY PROGRAM</div>
								<div id="phone"><i class="fa fa-phone" id="phone_icon"></i>XXXXXXXXXXX</div>
								<div id="email"><i class="fa fa-envelope" id="email_icon"></i>email.com</div>
							</div>
						</div>
					</div>
					<div class="col-12" id="coordinators">
						<div class="row">
							<div>
								<img src="{{ URL('images/default.png') }}" class="img-fluid" alt="" id="coordinator_img">
							</div>
							<div id="c_description">
								<div id="c_name">Marife S. Azares</div>
								<div id="c_program">ABAKA MO, PISO MO</div>
								<div id="phone"><i class="fa fa-phone" id="phone_icon"></i>XXXXXXXXXXX</div>
								<div id="email"><i class="fa fa-envelope" id="email_icon"></i>email.com</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col" id="inquiry">
				<h5 id="inquiry_">Inquiry</h5>
				<form method="post" action="" enctype="multipart/form-data">
					<div class="col">
						<div class="row">
							<div class="col-6">
								<input type="text" name="Visitor" hidden>
								<label id="label_">Full Name:</label>
								<input class="form-control" type="text" id="textbox">
							</div>
							<div class="col-6">
								<label id="label_">Email:</label>
								<input class="form-control" type="text" name="email" id="textbox">
							</div>
						</div>
					</div>
					<div class="col">
						<div class="row">
							<div class="col-6">
								<label id="label_">Contact Number:</label>
								<input class="form-control" type="text" name="contact" id="textbox">
							</div>
							<div class="col-6">
								<label id="label_">To:</label>
								<input class="form-control" type="text" name="to" id="textbox">
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
</body>
</html>