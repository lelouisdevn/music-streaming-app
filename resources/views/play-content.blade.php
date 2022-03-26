@extends('play')
@section('playContent')

<?php
  $Song = json_decode($Song);
  foreach ((array) $Song as $key => $value) {
    # code...
    if ($value->SongName){
      echo '
      <div class="row">
      <div class="col-12" style="font-size: 25px; color: white; font-weight: bold; margin: 10px;">
        Currently played
      </div>
      </div>
      ';

      break;
    }
  }
?>
<div class="row">
  <?php 
    foreach ((array) $Song as $s) {
  ?>
    
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
  <?php
    }
  ?>
</div>

        <?php 
          foreach ($album as $key => $value) {
            # code...
            if ($value->AlbumName){
              echo '
              <div class="row">
              <div class="col-12" style="font-size: 25px; color: white;
              font-weight: bold; margin: 10px;">Albums
              </div>
              </div>
              ';
              break;
            }
          }
        ?>
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
<div class="row">
    <div class="col-12" style="font-size: 25px; color: white;
    font-weight: bold; margin: 10px;">
        Genres you may love
    </div>
</div>
<div class="row content-genre">
    @foreach ($genre as $key => $g)
    <div class="col-3" style="background-image: url('Uploads/Images/{{ $g->GenreCover }}');">
        <a href="{{url('genre-songs/show/'.$g->GenreId)}}" style="color: white; text-decoration: none;">{{ $g->GenreName }}</a>
    </div>
    @endforeach

    <!-- <div class="col-3">indie</div> -->
</div>

@endsection
