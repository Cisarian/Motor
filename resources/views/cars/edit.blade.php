@extends ('base')

@section ('content')

<form action="{{ route('cars_update', [$car->id]) }}" method='post' enctype="multipart/form-data"> 

@csrf

<label for="make">Make</label>
<input type="text" name='make' value='{{ $car->make }}'>

<label for="model">Model</label>
<input type="text" name='model' value='{{ $car->model }}'>

<label for="registration">Registration</label>
<input type="text" name='registration' value='{{ $car->registration }}'>

<label for="color">color</label>
<input type="text" name='color' value='{{ $car->color }}'>

<label for="image">Image</label>
<input type="file" id='image' name='image'>
<h5> current image </h5> <img style='height: 100px; width: 100px;' src=@foreach($car->image as $image) "{{$image->url}}" @endforeach alt="">

<input type="submit" value='submit'>

</form>

@stop