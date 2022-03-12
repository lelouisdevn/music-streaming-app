@extends('Admin/dashboard')
@section('content')

<div class="title">ADD NEW ALBUM</div>
<form class="" action="{{url('admin/add-new-album/submit')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-admin">
    <label for="">Album name:</label>
    <input type="text" name="albumName" value="" placeholder="Enter album name:">
    <label for="">Description:</label>
    <input type="text" name="albumDescription" value="" placeholder="Describe the album:">
    <label for="">Album artist</label>
    <input type="text" name="albumArtist" value="" placeholder="Artist:">
    <label for="">Genre:</label>
    <select class="" name="genre">
      @foreach ($genre as $key => $g)
      <option value="{{ $g->GenreId }}">{{ $g->GenreName }}</option>
      @endforeach
    </select>
    <label for="">Choose an album cover:</label>
    <input type="file" name="genreFile" value="" placeholder="Upload album cover:">
    <button type="submit" name="button" class="btn btn-primary">Add</button>
    <a href="{{ url()->previous() }}">
      <button type="button" name="button" class="btn btn-outline-primary">Back</button>
    </a>
  </div>
</form>

@endsection
