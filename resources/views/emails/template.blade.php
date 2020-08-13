@component('mail::message')

Your MOT Approval

You have been MOT has been {{$approval}}

@if($approval == 'decline')
Please rebook at another time

@endif

Thank you



@endcomponent