@extends('play')
@section('playContent')

<div class="row songs">
<?php
  echo 'Search results: '.ucfirst($keyword);
 ?>
</div>
<div class="artist" style="color: lightgrey;">
  Songs
</div>
<div class="row">
    @foreach ($Song as $key => $s)
    <!-- <div class="col-3" style="background-image: url('/Uploads/Images/{{ $s->AlbumCover }}');">
        <a href="{{ url('user/songs/play/'.$s->SongId) }}" style="color: black; text-decoration: none;">{{ $s->SongName }} - {{ $s->SongArtist }}</a>
    </div> -->
    <div class="col-3 currentplay">
      <a href="{{url('/user/songs/play/'.$s->SongId)}}">
        <div class="row">
          <div class="col-4">
            <img src="{{asset('Uploads/Images/'.$s->SongCover)}}" alt="" style="width: 75px;">
          </div>
          <div class="col-8 currentpname">
            {{ $s->SongName }}
          </div>
        </div>
      </a>
    </div>
    @endforeach
</div>

<!-- Album search results -->
<div class="artist" style="color: lightgrey;">
  Albums
</div>
<div class="row content-genre">
    @foreach ($album as $key => $a)

    <div class="col-3" style="margin: 20px w0px 10em 20px; background-color: lightcoral; height: auto;">
      <a href="{{url('user/album/play/'.$a->AlbumId)}}">
        <img src="{{asset('/Uploads/Images/'.$a->AlbumCover)}}" alt="" style="width: 100%;">
        <p style="height: 50px; color: white; font-size: 18px; overflow-y: hidden;">{{$a->AlbumName}}</p>
        <p style="color: white; font-size: 16px; margin-bottom: 0;">{{$a->AlbumArtist}}</p>
      </a>
    </div>
    @endforeach
</div>






@endsection
