@extends('play')
@section('playContent')

<div class="row bg-song">
    <div class="col-4">
      <img src="{{asset('Root-properties/like-img.png')}}" alt="" width="200px;" style="position: absolute; ">
      <!-- <img src="{{asset('Root-properties/play.svg')}}" id="playBtn" alt="" style="width: 50px; position: absolute; right: 25%; bottom: 3%;"> -->
    </div>
    <div class="col-8">
        <div class="row songs">
            <div class="col-12">
              Liked songs
            </div>
        </div>
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

              <a class="fa fa-heart" id="dsong" style="font-size: 25px; margin: auto; text-align: center;"></a>
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
      <div class="col-5 audio-play">
        <audio src="{{asset('Uploads/Musics/'.$s->SongSource)}}"></audio>
        <!-- <p class="names">{{ $s->SongName }}</p> -->
        <a class="names" style="color: black;" href="{{url('user/songs/play/'.$s->SongId)}}">{{ $s->SongName }}</a>
      </div>
      <div class="col-3">
        {{ $s->SongArtist }}
      </div>
      <div class="col abc fa fa-heart" style="font-size: 20px; color: green; margin: 15px 0; text-align: center;">
        <input type="hidden" name="" value="{{$s->SongId}}" class="songid">
      </div>
      <div class="col-2" style="text-align: center;">
        {{$s->SongStream}}
      </div>
     
        <div class="col audiosrc fa fa-play-circle play-genre-song">
          <audio class="src" src="{{asset('Uploads/Musics/'.$s->SongSource)}}">
          </audio>
          <input type="hidden" name="" value="{{ $s->SongName }}">
        </div>
    </div>
    @endforeach

<script>

var val = document.getElementsByClassName('abc');

let currents;
let currents_name;
var audios = $('.audiosrc')

currents = document.getElementsByClassName('audiosrc')[0].querySelector('audio');
song = currents;

for (var i = 0; i<audios.length; i++){
  var audio = audios[i];
  // console.log(audio)
  audio.onclick = function(e){
    song = e.target.firstElementChild;
    console.log(song.parentElement);
    currents_name = song.parentElement.querySelector('input').value;
    console.log(currents_name);
    
    for (let i = 0; i<audios.length; i++){
      var audiotemp = audios[i].firstElementChild;
      var songtemp = audios[i];
      
      if (song != audiotemp){
        audiotemp.pause();
        audiotemp.currentTime = 0;
        if (songtemp.classList.contains('fa-pause-circle')){
          songtemp.classList.remove('fa-pause-circle');
          songtemp.classList.add('fa-play-circle');
        }
      }
    }
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
    
    song.addEventListener('ended', function(){
      var p = e.target.parentElement;
      var p1 = p.nextElementSibling;  
      var p2 = p1.querySelector('.audiosrc');
      audio = p2;
      currents = p2.firstElementChild;
      currents_name = p2.querySelector('input').value;
      $(audio).trigger('click');
    })
  }
}
//like bai hat trong danh sach album
const songplaylist = $('.abc')
//console.log(songplaylist)



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

//Like va bo like album
$('.fa-heart-o').on('click', function(){
  var query = $(this).find('input').val();
  console.log(query);
  // $(this).removeClass('fa-heart');
  // console.log($(this));
  // $(this).addClass('fa-heart-o');
  // console.log($(this));
  $.ajax({
    context: this,
    url: "{{ route('like-likelist') }}",
    method:"post",
    data:{query:query, _token: "{!! csrf_token() !!}"},
    success:function(data){
      $(this).removeClass('fa-heart-o').addClass('fa-heart');
      // $(this).replaceWith(data);
    }
  });
});

//Mute & unmute songs
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

  //var song = new Audio();
  var currentSong = 0;
  var progress = document.getElementById('progress');
  var playBtn = document.getElementById('play');

  // time display in progress bar, along with song name
  var start = document.getElementById('start');
  var end = document.getElementById('end');
  var SongName = document.getElementById('SongName');
  currents_name = names[0];
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
      currents.pause();
      var pp = currents.parentElement;
      
      console.log(pp.parentElement.nextElementSibling);
      currents = pp.parentElement.nextElementSibling.querySelector('audio');
      
      var pp1 = pp.parentElement.nextElementSibling.querySelector('.audiosrc');
      var pp2 = pp1.querySelector('input').value;
      console.log(pp2);
      
      song = currents;
      song.play();
      currents_name = pp2;
      playBtn.src = "{{asset('Root-properties/pause.svg')}}";
      controlBar();
      SongName.innerHTML = currents_name;

      song.addEventListener('ended', function(){
        var pp = song.parentElement;
        
        var pp1 = pp.parentElement.nextElementSibling;
        var pp2 = pp1.querySelector('.audiosrc');
        
        $(pp2).trigger('click');
        currents_name = pp2.querySelector('input').value;

        controlBar();
      })
    })
    
    
    playBtn.addEventListener('click', function(){
      if (song.paused){
        song.play();
        // song.parentElement.classList.remove('fa-play-circle');
        // song.parentElement.classList.add('fa-pause-circle');
        var play1 = song.parentElement;
        play1.classList.remove('fa-play-circle');
        play1.classList.add('fa-pause-circle');
        // playBtn.src = "{{asset('Root-properties/pause.svg')}}";
        document.getElementById('play').firstElementChild.className = "fa fa-pause-circle";
        playBtn.style.transition = "all 0.4s";
      }else {
        var play1 = song.parentElement;
        play1.classList.remove('fa-pause-circle');
        play1.classList.add('fa-play-circle');
        
        song.pause();
        // playBtn.src = "{{asset('Root-properties/play.svg')}}";
        document.getElementById('play').firstElementChild.className = "fa fa-play-circle";
        playBtn.style.transition = "all 0.4s";
      }
      controlBar();
      //SongName.innerHTML = names[currentSong];
      SongName.innerHTML = currents_name;
      console.log(currents_name);
    })
    // const songlist = $('.audiosrc');
    //   for (var i = songlist.length-1; i>=0; i--){
    //     var s = songlist[i];
    //     playBtn.onclick = function(){
    //       var song = s.firstElementChild;
    //       console.log(song)
    //       var playb = document.getElementById('play').firstElementChild;
    //       if (song.paused){
    //         song.play();
    //         SongName.innerHTML = s.querySelector('input').value;
    //         controlBar();
    //         displayTime();
    //         playb.className = "fa fa-pause-circle";
    //         console.log(playb);
    //     }else {
    //         song.pause();
    //         playb.className = "fa fa-play-circle";
    //     }
    //   }
    //   }

    song.addEventListener("ended", function playNext() {
      var s1 = song.parentElement;
      var s2 = s1.parentElement.nextElementSibling;
      var s3 = s2.querySelector('.audiosrc');
      console.log(s3);
      var s4 = s3.querySelector('audio');
      
      currents = s4;
      song = currents;
      song.play();
      console.log(s2);
      // console.log(progress);
      controlBar();
      currents_name = s4.nextElementSibling.value;
      console.log(currents_name);
      SongName.innerHTML = currents_name;
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
