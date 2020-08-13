@extends ('base')

@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@stop

@section ('content')

<h1> Welcome </h1>

@guest

Please <a href="{{ route('login') }}">login</a> to utilise website

@endguest

@auth

<table>

    <tr>
        <th>name</th>
        <th>email</th>
        <th>age</th>
        <th>image</th>
        <th>edit</th>
    </tr>

    <tr>
        <th>{{Auth::user()->name}}</th>
        <th>{{Auth::user()->email}}</th>
        <th>{{Auth::user()->age}}</th>
        <th>@forelse(Auth::user()->image as $image)<img  style='height: 100px; width: 100px;' src='{{$image->url}}' alt="">@empty Nothing here @endforelse</th>
        <th><a href="{{ route('user_edit', [Auth::user()->id]) }}">Edit</a></th>
    
    </tr>

</table>



<table style='width:100%' id='car'>
    <thead>
    <tr>
    
        <th>Make</th>
        <th>Model</th>
        <th>Registration</th>
        <th>Color</th>
        <th>Image</th>
        <th>edit</th>
        <th>Mot</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cars as $car)
    <tr>
        <td>{{$car->make}}</td>
        <td>{{$car->model}}</td>    
        <td>{{$car->registration}}</td>    
        <td>{{$car->color}} </td>
        <td> @foreach($car->image as $image)<img src="{{ $image->url }}" alt="Image" style=" width:100px; height: 100px;"> @endforeach</td>
        <td><a href="{{ route('cars_edit', [$car->id]) }}">Edit</a></td>    
        <td>@if ($car->MOT == 0) <a href="{{ route('create_mot', [$car->id]) }}">Set Mot</a> @endif</td>
        <td><form action="{{ route('cars_delete', [$car->id]) }}" method='post'>
        @csrf
        @method('delete')
        <input type="submit" value='Delete'>
        </form></td>
    </tr>
    </tbody>
    @endforeach


</table>


add a new <a href="{{ route('cars_create') }}"> car</a>

@endauth

<script>

$(document).ready( function () {
    $('#car').DataTable();
} );

</script>

@stop