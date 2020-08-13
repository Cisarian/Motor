@extends ('base')

@section ('content')

<form action="{{ route('user_store', [$user->id]) }}" method='post' enctype="multipart/form-data"> 

@csrf

<label for="name">Name</label>
<input type="text" name='name' id='name' value="{{ $user->name }}">

<label for="email">Email</label>
<input type="text" name='email' id='email'value="{{ $user->email }}">

<label for="age">age</label>
<input type="number" name='age' id='age' value="{{ $user->age }}">

<label for="image">Image</label>
<input type="file" name='image' id='image'>

<input type="submit" value='Update'>

</form>

@forelse($user->image as $image)
<img style='height: 100px; width: 100px;' src='{{$image->url}}' alt="">
<form action="{{ route('user_image_delete', [$user->id]) }}" method='post'>
    @csrf
    @method('delete')
    <input type="submit" value='Delete Image'>
</form>

@empty
Nothing here 
@endforelse



@stop

