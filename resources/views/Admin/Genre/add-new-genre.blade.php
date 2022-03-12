@extends('Admin/dashboard')
@section('content')

<div class="title">ADD NEW GENRE</div>
<form class="" action="{{url('admin/add-new-genre/submit')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-admin">
    <label for="">Genre name:</label>
    <input type="text" name="genreName" value="" placeholder="Enter genre name:">
    <label for="">Description:</label>
    <input type="text" name="genreDescription" value="" placeholder="Describe what kind of that:">
    <label for="">Choose a genre cover:</label>
    <input type="file" name="genreFile" value="" placeholder="Upload genre cover:">
    <button type="submit" name="button" class="btn btn-primary">Add</button>
    <a href="{{ url()->previous() }}">
      <button type="button" name="button" class="btn btn-outline-primary">Back</button>
    </a>
  </div>
</form>

@endsection
