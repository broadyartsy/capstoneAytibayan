<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Schedule</title>
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

<body class="schedule">

@include('beneficiary.Body.sidebar')
<div class="title">
        <h1>schedule</h1>
    </div>
<div class="schedule-wrapper"> <!-- Wrapping div -->
    <div class="signboard outer">
      <div class="signboard front inner anim04c">
        <li class="year anim04c">
          <span></span>
        </li>
        <ul class="calendarMain anim04c">
          <li class="month anim04c">
            <span></span>
          </li>
          <li class="date anim04c">
            <span></span>
          </li>
          <li class="day anim04c">
            <span></span>
          </li>
        </ul>
        <li class="clock minute anim04c">
          <span></span>
        </li>
        <li class="calendarNormal date2 anim04c">
          <span></span>
        </li>
      </div>
      <div class="signboard left inner anim04c">
        <li class="clock hour anim04c">
          <span></span>
        </li>
        <li class="calendarNormal day2 anim04c">
          <span></span>
        </li>
      </div>
      <div class="signboard right inner anim04c">
        <li class="clock second anim04c">
          <span></span>
        </li>
        <li class="calendarNormal month2 anim04c">
          <span></span>
        </li>
      </div>
    </div>
  </div>
  <div class="schedule-descrip">
    <h1>List of Schedules</h1>

    @if($schedules->isEmpty())
        <p>No schedules have been posted yet.</p>
    @else
        @foreach($schedules->reverse() as $schedule)
            @php
                $daySched = \Carbon\Carbon::parse($schedule->date)->format('d');
                $monthSched = \Carbon\Carbon::parse($schedule->date)->format('M');
                $yearSched = \Carbon\Carbon::parse($schedule->date)->format('Y');
            @endphp
            <div class="schedule-item">
                <div class="left-content">
                    <div class="schedule-description">{{ $schedule->description }}</div>
                    <div class="schedule-time">{{ $schedule->time }}</div>
                </div>
                <div class="right-content">
                    <div class="schedule-date-container">
                        <div class="schedule-date">{{ $daySched }}</div>
                        <div class="schedule-month">{{ $monthSched }}</div>
                        <div class="schedule-year">{{ $yearSched }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
    <div class="container">
  <div class="calendar">
    <header>
     
      <div class="icons">
        <span id="prev" class="material-symbols-rounded">chevron_left</span>
        <p class="current-date"></p>
        <span id="next" class="material-symbols-rounded">chevron_right</span>
      </div>
      <div class="labels">
        <div class="label current-label">
          <div class="shape circle"></div>
          Current Date
        </div>
        <div class="label monitoring-label">
          <div class="shape square"></div>
          Scheduled Dates
        </div>
      </div>
    </header>
    <div class="calendar-content">
      <ul class="weeks">
        <li>Sun</li>
        <li>Mon</li>
        <li>Tue</li>
        <li>Wed</li>
        <li>Thu</li>
        <li>Fri</li>
        <li>Sat</li>
      </ul>
      <ul class="days">

      </ul>
    </div>
  </div>
</div>





 
</body>
<script>
$(document).ready(function () {

var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= [ "Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday" ];

var newDate = new Date();
newDate.setDate(newDate.getDate());
	
setInterval( function() {
	var hours = new Date().getHours();
	$(".hour").html(( hours < 10 ? "0" : "" ) + hours);
    var seconds = new Date().getSeconds();
	$(".second").html(( seconds < 10 ? "0" : "" ) + seconds);
    var minutes = new Date().getMinutes();
	$(".minute").html(( minutes < 10 ? "0" : "" ) + minutes);
    
    $(".month span,.month2 span").text(monthNames[newDate.getMonth()]);
    $(".date span,.date2 span").text(newDate.getDate());
    $(".day span,.day2 span").text(dayNames[newDate.getDay()]);
    $(".year span").html(newDate.getFullYear());
}, 1000);	



$(".outer").on({
    mousedown:function(){
        $(".dribbble").css("opacity","1");
    },
    mouseup:function(){
        $(".dribbble").css("opacity","0");
    }
});



});
</script>



<script>
const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];
@if(!empty($schedule))
  const scheduledDates = @json($schedule->pluck('date')->toArray());
@else
  const scheduledDates = ["No Set Schedules Yet."];
@endif
const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
  let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
  let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
  let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
    let isScheduled = scheduledDates.includes(`${currYear}-${(currMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`) ? "scheduled" : "";
    liTag += `<li class="${isToday} ${isScheduled}">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
  }

  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag;
};
renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});
</script>






</html>
