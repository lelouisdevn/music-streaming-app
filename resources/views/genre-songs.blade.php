@extends('play')
@section('playContent')

<div class="row bg-song">
    <div class="col-4">
      @foreach ($Genre as $key => $g)
      <img src="{{asset('Uploads/Images/'.$g->GenreCover)}}" alt="" width="200px;" style="position: absolute; ">
      <!-- <img src="{{asset('Root-properties/play.svg')}}" id="playBtn" alt="" style="width: 50px; position: absolute; right: 25%; bottom: 3%;"> -->
    </div>
    <div class="col-8">
        <div class="row songs">
            <div class="col-12">
<?php $GenreId = $g->GenreId; ?>
                {{ $g->GenreName}}
            </div>
        </div>
      @endforeach

        <div class="row artist">
            <div class="col-12">

            </div>
        </div>
        <div class="row" style="width: 100%; margin-top: 30px;">
          <div class="col-2" id="off">
            <h2 class="fa fa-volume-up songs" style="font-size:25px;"></h2>
          </div>
          <div class="col-2" id="back">
            <h2 class="fa fa-step-backward"></h2>
          </div>
          <div class="col-2" id="play">
            <h2 class="fa fa-play-circle"></h2>
          </div>
          <div class="col-2" id="next">
            <h2 class="fa fa-step-forward"></h2>
          </div>
          <div class="col-2" id="abc" >

              <div class="fa fa-heart" id="dsong" style="font-size: 25px; margin: auto; text-align: center;"></div>

          </div>
          <div class="4">

          </div>
        </div>
    </div>
</div>

<div class="row" style="overflow: auto; width: 96.5%;">
  <div class="col-12 artist" style="padding-left:30px;" id="SongName">
  </div>
</div>
<div class="row" style="overflow: auto; width: 96.5%;">
  <div class="col-12">
    <input type="range" id="progress" class="progress" step="0.5" min="0" max="100" value="0" style="width: 96.5%; margin: 20px 0 20px 15px;">
    <div class="" style="width: 98%; overflow: auto; margin: 0 0 0 10px;">
      <p id="start" style="float: left; width: 50%;"></p>
      <p id="end" style="float: right; text-align: right; width: 50%;"></p>
    </div>
  </div>
</div>

@foreach ($songs as $key => $s)
<div class="row song-genre">
  <div class="col-6 audio-play">
    <audio class="src" src="{{asset('Uploads/Musics/'.$s->SongSource)}}"></audio>
    <p class="names">{{ $s->SongName }}</p>
  </div>
  <div class="col-3">
    {{ $s->SongArtist }}
  </div>
  <!-- <div class="col abc fa fa-heart" style="font-size: 20px; color: green; margin: 15px 0; text-align: center;">
    <input type="hidden" name="" value="{{$s->SongId}}" class="songid">
  </div> -->

    <?php
      $UserId = Session::get('UserId');
      $SongId = $s->SongId;

       $AlbumId = DB::table('song')->join('album', 'song.AlbumId', '=', 'album.AlbumId')
       ->where('song.SongId', $SongId)->first();

       $check = DB::table('likes')->join('song', 'likes.SongId', '=', 'song.SongId')
       ->where('song.AlbumId', $AlbumId->AlbumId)->where('likes.SongId', $SongId)->where('likes.UserId', $UserId)
       ->first();

      if ($check){
     ?>
        <div class="col abc fa fa-heart" style="font-size: 20px; color: green; margin: 15px 0; text-align: center;">
          <input type="hidden" name="" value="{{$s->SongId}}" class="songid">
        </div>
    <?php }else{ ?>
        <div class="col abc fa fa-heart-o" style="font-size: 20px; color: green; margin: 15px 0; text-align: center;">
          <input type="hidden" name="" value="{{$s->SongId}}" class="songid">
        </div>
    <?php } ?>

  <div class="col">
    {{$s->SongStream}}
  </div>
  <div class="col audiosrc fa fa-play-circle play-genre-song">
    <audio class="src" src="{{asset('Uploads/Musics/'.$s->SongSource)}}">
    </audio>
    <input type="hidden" name="" value="{{ $s->SongName }}">
  </div>
</div>
@endforeach


<br>
<script type="text/javascript">

var audios = $('.audiosrc')
for (var i = 0; i<audios.length; i++){
  var audio = audios[i];
  console.log(audio)
  audio.onclick = function(e){
    song = e.target.firstElementChild;
    if (song.paused){
      song.play()
      $(e.target).removeClass('fa-play.circle').addClass('fa-pause-circle');
      document.getElementById('play').firstElementChild.className = "fa fa-pause-circle";

      SongName.innerHTML = e.target.querySelector('input').value;
      // console.log(SongName);
      // SongName.innerHTML = SongName;

      controlBar();
      song.ontimeupdate = function () {
          if (song.duration) {
              const p = Math.floor(song.currentTime / song.duration * 100);
              progress.value = p;
          }
          displayTime();
      }
    }else{
      song.pause()
      $(e.target).removeClass('fa-pause-circle').addClass('fa-play-circle')
      document.getElementById('play').firstElementChild.className = "fa fa-play-circle";
      SongName.innerHTML = e.target.querySelector('input').value;
      // controlBar();
    }
  }
}


const songplaylist = $('.abc');
for (var i = 0; i < songplaylist.length; i++){
  let song = songplaylist[i]

  song.onclick = function(e){
    var query = e.target.querySelector('input').value;
    var rm =  e.target.parentElement;

    $.ajax({
      context: e.target,
      url: "{{ route('dlike-likelist') }}",
      method:"post",
      data:{query:query, _token: "{!! csrf_token() !!}"},
      success:function(data){
        if(!e.target.className.includes('fa-heart-o')){
          $(e.target).removeClass('fa-heart').addClass('fa-heart-o');
        }
        else {
          $(e.target).removeClass('fa-heart-o').addClass('fa-heart');
        }
      }
    });
  };
}

var mute = document.getElementById('off');
console.log(mute);
mute.addEventListener('click', function(){
  if (song.volume != 0){
    song.volume = 0;
    mute.firstElementChild.className = "fa fa-volume-off songs";
  }else {
    song.volume = 1;
    mute.firstElementChild.className = "fa fa-volume-up songs";
  }
})

var list = document.getElementsByClassName('audio-play');
var songs = [];
var listName = document.getElementsByClassName('names');
console.log(listName);
var names = [];

for (var i = 0; i<list.length; i++){
  songs.push(list[i].firstElementChild.src);
  names.push(listName[i].textContent);
}

var song = new Audio();
var currentSong = 0;
var progress = document.getElementById('progress');
var playBtn = document.getElementById('play');

// time display in progress bar, along with song name
var start = document.getElementById('start');
var end = document.getElementById('end');
var SongName = document.getElementById('SongName');
// var img = document.querySelector('img#playBtn');

// Back and next button in album playlist
var next = document.getElementById('next');

  back.addEventListener('click', function(){
    song.pause();
    currentSong--;
    song.src = songs[currentSong];
    song.play();
    playBtn.src = "{{asset('Root-properties/pause.svg')}}";
    controlBar();
    SongName.innerHTML = names[currentSong];
  })
  next.addEventListener('click', function(){
    song.pause();
    playBtn.src = "{{asset('Root-properties/play.svg')}}";
    currentSong++;
    song.src = songs[currentSong];
    song.play();
    playBtn.src = "{{asset('Root-properties/pause.svg')}}";
    controlBar();
    SongName.innerHTML = names[currentSong];
  })

  song.src = songs[0];
  playBtn.addEventListener('click', function(){
    if (song.paused){
      song.play();
      // playBtn.src = "{{asset('Root-properties/pause.svg')}}";
      document.getElementById('play').firstElementChild.className = "fa fa-pause-circle";
      playBtn.style.transition = "all 0.4s";

    }else {
      song.pause();
      // playBtn.src = "{{asset('Root-properties/play.svg')}}";
      document.getElementById('play').firstElementChild.className = "fa fa-play-circle";
      playBtn.style.transition = "all 0.4s";
    }
    controlBar();
    SongName.innerHTML = names[currentSong];
  })
// playBtn.addEventListener('click', function playNextS(){
//       playSong(currentSong);
//
//       // console.log(progress)
//
//
//   });
  song.addEventListener("ended", function playNext() {
      currentSong++;
      if (currentSong == length) {
          currentSong = 0;
          song.src = songs[currentSong];
          SongName.innerHTML = names[0];
          playBtn.src = "{{asset('Root-properties/play.svg')}}";
          song.pause();
      } else{
          song.src = songs[currentSong];
          song.play();
          SongName.innerHTML = names[currentSong];
      }
      // console.log(progress);
      controlBar();
  })

  controlBar();

  //Display time appearing on progress bar
  function displayTime(){
    var minute, second;
    var current = song.currentTime;
    var duration = song.duration;
    var minuteSong = Math.floor(duration / 60);
    var secondSong = Math.floor(duration - (minuteSong * 60));

    if (secondSong < 10){
        end.innerHTML = "0" + minuteSong + ":0" + secondSong;
    }else {
        end.innerHTML = "0" + minuteSong + ":" + secondSong;
    }
    if (current > 60){
        minute = Math.floor(current / 60);
        second = Math.floor(current - (minute*60));

        if (second < 10){
            start.innerHTML = "0" + minute + ":0" + second;
        }else {
            start.innerHTML = "0" + minute + ":" + second;
        }
    }else {
        second = Math.floor(current);
        if (second < 10){
          start.innerHTML = "00" + ":0" + second;
        }
        else{
          start.innerHTML = "00" + ":" + second;
        }
    }
  }

  //Display progress bar
  function controlBar(){
    progress.onchange = function () {
        const seekTime = progress.value * song.duration / 100;
        song.currentTime = seekTime;
        // console.log(seekTime);
    }
    song.ontimeupdate = function () {
        if (song.duration) {
            const p = Math.floor(song.currentTime / song.duration * 100);
            progress.value = p;
        }
        displayTime();
    }
  }
</script>
@endsection
