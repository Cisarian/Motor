<!DOCTYPE html>
<html>
<head>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>
<body>
<input id='addEvent' type="button" value='Add Event' />
<div id='calendar'></div>

<script>


$(document).ready(function(){
    var calendar = $('#calendar').fullCalendar({ })
    });


    

    

</script>

@forelse($cars as $car)

<script>

window.addEventListener('load', function(){
    var eventObject = {
    start: "{{$car->mot_time }}",
    end: "{{$car->mot_time }}",
    title: "mot_time"
  };
  $('#calendar').fullCalendar('renderEvent', eventObject, true)
})



</script>
@empty

@endforelse

</body>
</html>
