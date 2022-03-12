@extends('Admin/dashboard')
@section('content')

<div class="title">UPDATE GENRE INFORMATION</div>
<form class="" action="{{url('admin/genre/update')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  @foreach ($genre as $key => $g)
  <div class="form-admin">
    <input type="hidden" name="GenreId" value="{{ $g->GenreId }}">
    <label for="">Genre name:</label>
    <input type="text" name="genreName" value="{{$g->GenreName}}" placeholder="Enter genre name:">
    <label for="">Description:</label>
    <input type="text" name="genreDescription" value="{{$g->GenreDescription}}" placeholder="Describe what kind of that:">
    <label for="">Choose a genre cover:</label>
    <img src="{{asset('Uploads/Images/'.$g->GenreCover)}}" alt="" style="width: 250px;">
    <input type="file" name="genreFile" value="{{$g->GenreCover}}" placeholder="Upload genre cover:">
    <button type="submit" name="button" class="btn btn-primary">Update</button>
    <a href="{{ url()->previous() }}">
      <button type="button" name="button" class="btn btn-outline-primary">Back</button>
    </a>
  </div>
  @endforeach
</form>

@endsection
