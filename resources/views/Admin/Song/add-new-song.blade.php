@extends('Admin/dashboard')
@section('content')

<div class="title">ADD NEW SONG</div>
<form class="" action="{{url('admin/add-new-song/submit')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-admin">
    @foreach ($Album as $key => $a)
    <label for="">Album:</label>
    <input name="albumId" value="{{ $a->AlbumId }}" type="hidden">
    <input type="text" name="albumName" value="{{ $a->AlbumName }}" disabled>
    <input type="hidden" name="songCover" value="{{ $a->AlbumCover }}">
    @endforeach
    <label for="">Song name:</label>
    <input type="text" name="songName" value="" placeholder="Enter song name:">
    <label for="">Lyrics:</label>
    <textarea rows="8" cols="97" id="ckeditor1" style="resize: none;" name="songLyrics"></textarea>

    @foreach ($Album as $key => $a)
    <label for="">Album artist</label>
    <input type="text" name="albumArtist" value="{{$a->AlbumArtist}}" placeholder="Artist:">
    @endforeach

    <label for="">Upload audio:</label>
    <input type="file" name="songSource" value="" placeholder="Upload album cover:">
    <button type="submit" name="button" class="btn btn-primary">Add</button>
    <a href="{{ url()->previous() }}">
      <button type="button" name="button" class="btn btn-outline-primary">Back</button>
    </a>
  </div>
</form>

@endsection
