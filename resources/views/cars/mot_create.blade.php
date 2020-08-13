@extends ('base')

@section('content')

<form action="{{ route('store_mot', [$id])}}" method='post'>

@csrf

<label for="mot">MOT Date</label>
<input type="date" id='mot' name='mot'>

<label for="time">Car Park</label>
<input type="time" id='time' name='time'>



<input type="submit">

</form>

@stop