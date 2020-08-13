@extends ('base')

@section ('content')

<form action="{{ route('cars_store') }}" method='post' enctype="multipart/form-data">

@csrf

<label for="make"> Make </label>
<input type="text" name='make' id='title'>
@if($errors)
{{ $errors->first('title') }}
@endif

<label for="model"> Model </label>
<input type="text" name='model' id='model'>
@if($errors)
{{ $errors->first('model') }}
@endif

<label for="registration"> Registration </label>
<input type="text" name='registration' id='registration'>
@if($errors)
{{ $errors->first('name') }}
@endif

<label for="color"> Color </label>
<input type="text" name='color' id='color'>
@if($errors)
{{ $errors->first('color') }}
@endif

<label for="image">Image</label>
<input type='file' id='image' name='image'>
@if($errors)
{{ $errors->first('image') }}
@endif



<input type="submit" value='submit'>

</form>

@stop