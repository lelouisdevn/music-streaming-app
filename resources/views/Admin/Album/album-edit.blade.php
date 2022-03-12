@extends('Admin/dashboard')
@section('content')

@foreach ($Album as $key => $a)
<div class="title">UPDATE ALBUM INFORMATION</div>
<form class="" action="{{url('admin/album/update')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-admin">
    <input type="hidden" name="AlbumId" value="{{$a->AlbumId}}">
    <label for="">Album name:</label>
    <input type="text" name="albumName" value="{{$a->AlbumName}}" placeholder="Enter album name:">
    <label for="">Description:</label>
    <input type="text" name="albumDescription" value="{{$a->AlbumDescription}}" placeholder="Describe the album:">
    <label for="">Album artist</label>
    <input type="text" name="albumArtist" value="{{$a->AlbumArtist}}" placeholder="Artist:">
    <label for="">Genre:</label>
    <select class="" name="genre">
      <?php $genreId = $a->GenreId;
            $GenreName = DB::table('genre')->where('GenreId', $genreId)->select('GenreName')->get();
       ?>
      <option value="{{$a->GenreId}}">{{ $a->GenreName }}</option>
      @foreach ($genre as $key => $g)
      <option value="{{ $g->GenreId }}">{{ $g->GenreName }}</option>
      @endforeach
    </select>
    <img src="{{asset('Uploads/Images/'.$a->AlbumCover)}}" alt="" style="width: 250px;">
    <label for="">Update album cover:</label>
    <input type="file" name="genreFile" value="{{$a->AlbumCover}}" placeholder="Upload album cover:">
    <button type="submit" name="button" class="btn btn-primary">Update</button>
    <a href="{{ url()->previous() }}"><button class="btn btn-outline-primary">Back</button></a>
  </div>
</form>

@endforeach

@endsection
