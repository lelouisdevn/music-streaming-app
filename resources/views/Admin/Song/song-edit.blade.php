@extends('Admin/dashboard')
@section('content')

<div class="title">UPDATE SONG INFORMATION</div>
<form class="" action="{{url('admin/song/update')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-admin">
    @foreach ($Song as $key => $s)
    <label for="">Album:</label>
    <input type="hidden" name="SongId" value="{{$s->SongId}}">
    <input type="text" name="albumName" value="{{ $s->AlbumName }}" disabled>
    <input type="hidden" name="AlbumId" value="{{ $s->AlbumId }}">

    <label for="">Song name:</label>
    <input type="text" name="songName" value="{{ $s->SongName }}" placeholder="Enter song name:">
    <label for="">Lyrics:</label>
    <textarea rows="8" cols="97" id="ckeditor1" style="resize: none;" name="songLyrics" value="">
      {{$s->SongLyrics}}
    </textarea>

    <label for="">Album artist</label>
    <input type="text" name="albumArtist" value="{{$s->AlbumArtist}}" placeholder="Artist:">

    <img src="{{asset('Uploads/Images/'.$s->SongCover)}}" alt="" style="width:250px">
    <label for="">Update audio:</label>
    <input type="file" name="songSource" value="{{ $s->SongSource }}" placeholder="Upload album cover:">
    <button type="submit" name="button" class="btn btn-primary">Update</button>
    <a href="{{ url()->previous() }}">
      <button type="button" name="button" class="btn btn-outline-primary">Back</button>
    </a>
    @endforeach
  </div>
</form>

@endsection
