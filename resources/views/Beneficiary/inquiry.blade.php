<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inquiry</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('Assets/css/beneficiary.css') }}">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body class="inquiry">
@include('beneficiary.Body.sidebar')
  <div class="title">
          <h1>inquiry</h1>
    </div>
      <div class="inquiry-container">
        <div class="content">
          <div class="left-side">
            <div class="address details">
              <i class="fas fa-map-marker-alt"></i>
              <div class="topic">Address</div>
              <div class="text-one">Albay Farmer's Village Complex </div>
              <div class="text-two">Camalig, Albay, Philippines</div>
            </div>
            <div class="phone details">
              <i class="fas fa-phone-alt"></i>
              <div class="topic">Phone</div>
              <div class="text-one">+0098 9893 5647</div>
              <div class="text-two">+0096 3434 5678</div>
            </div>
            <div class="email details">
              <i class="fas fa-envelope"></i>
              <div class="topic">Email</div>
              <div class="text-one">APAO_albay@gmail.com</div>
              <div class="text-two">info.apao@gmail.com</div>
            </div>
          </div>
          <div class="right-side">
            <p></p>
          <form action="{{ route('beneficiary.inquiries') }}" method="post" enctype="multipart/form-data"> 
            @csrf
          <div class="input-box">
          <label class="label">Full Name:</label>
          <input type="text" placeholder="" name="fullname" value="{{ $userProfileData->first_name }} {{ $userProfileData->middle_name }} {{ $userProfileData->last_name }}" readonly>
        </div>
        <div class="input-box">
          <label class="label" >Personal Email:</label>
          <input type="email" value="{{ $userProfileData->email }}" name="email" readonly>
          <input type="text" value="{{ $roleName }}" name="from" hidden>
        </div>
        <div class="input-box">
          <label class="label">Contact Number:</label>
          <input type="text" value="{{ $userProfileData->phone }}" name="contact" required>
        </div>
        <div class="input-box">
          <label class="label">To:</label>
          <input type="text" placeholder="To" value="{{ $programName }}" name="recipient" readonly>
          <input type="email" value="{{ $programEmail }}" name="programEmail" hidden>
        </div>
        
        <div class="input-box message-box">
          <label class="label">Message:</label>
          <textarea type="text" placeholder="" name="message" required></textarea>
        </div>
            <div class="button">
              <input type="submit" value="Send" >
            </div>
          </form>
        </div>
        </div>
      </div>

        <div class="title1">
            <h1>Sent Messages</h1>
        </div>
        <div class="sentmessages">
        <table class="table">
          <tr>
              <th>Full Name</th>
              <th>Message</th>
              <th>Date</th>
          </tr>
          @foreach($inquiry->reverse() as $inquiries)
          <tr>
                            <td>{{ $inquiries->fullname }}</td>
                            <td>{{ $inquiries->message }}</td>
                            <td>{{ $inquiries->created_at->format('Y-m-d h:i A') }}</td>

         
          </tr>
          @endforeach 
        </table>
      
      </div>

     
  </div>
  
 
</body>
</html>