@extends('play')
@section('playContent')

@foreach ($song as $key => $s)
<div class="row bg-song">
  <div class="col-4">
    <img src="{{asset('Uploads/Images/'.$s->AlbumCover)}}" alt="" width="200px;" style="position: absolute;">
    <!-- <img src="{{asset('Root-properties/play.svg')}}" id="btn" alt="" style="width: 50px; position: absolute; right: 25%; bottom: 3%;"> -->
  </div>
  <div class="col-8">
    <div class="row songs">
      {{ $s->SongName }}
    </div>
    <div class="row artist">
      {{ $s->SongArtist }}
    </div>
    <div id="sp" class="row" style="width: 100%; margin-top: 30px;">
      <div class="col-2" id="off">
        <h2 class="fa fa-volume-up songs" style="font-size:28px;"></h2>
      </div>
      <!-- <div class="col-2" id="back">
        <h2 class="fa fa-step-backward"></h2>
      </div> -->
      <div class="col-2" id="play">
        <h2 class="fa fa-play-circle"></h2>
      </div>
      <!-- <div class="col-2" id="next">
        <h2 class="fa fa-step-forward"></h2>
      </div> -->
      <div class="col-2" id="abc" style="margin: auto 0; text-align: center;">
        <input type="hidden" name="" value="{{ $s->SongId }}" id="content-like">
        <?php
          $UserId = Session::get('UserId');
          $SongId = $s->SongId;
          $result = DB::table('likes')->where('UserId', $UserId)->where('SongId', $SongId)->first();
          if ($result){
         ?>
          <div class="fa fa-heart" id="dsong" style="font-size: 28px; margin: auto; text-align: center;"></div>
          <?php
        }else{ ?>
          <div class="fa fa-heart-o" id="lsong" style="font-size: 28px; margin: auto; text-align: center;"></div>
        <?php } ?>
        {{ csrf_field() }}
      </div>
      <!-- <div class="col-2"  id="addplaylist" style="position: relative;">
          <h2 class="fa fa-plus-circle"></h2>
      </div> -->
    </div>
  </div>
</div>
<div class="row" style=" width: 96.5%;">
  <div class="col-12 media-audio" id="songsrc" style="overflow: auto;">
    <audio src="{{asset('Uploads/Musics/'.$s->SongSource)}}" type="audio/mpeg" type="audio/mp3" style="width: 100%; height: 40px; color: black;">
    </audio>

    <input type="range" id="progress" class="progress" step="0.5" min="0" max="100" value="0" style="width: 100%; height: 30px;">
    <p id="start" style="float: left; width: 50%;"></p><p id="end" style="float: right; text-align: right; width: 50%;"></p>
  </div>
</div>
<div class="row media-audio" style="width: 93%;">
  <div class="col-12 artist" style="margin-bottom: 10px; font-size: 28px;">
    Lyrics
  </div>
  <div class="col-12 lyrics seemore" id="seemore">
    <!-- lyrics here -->
    <div class="">
      <?php
      $str = $s->SongLyrics;
      					// $myVar = htmlentities($str, ENT_QUOTES);
      					echo '<prev>';
      					echo $str;
      					echo '</prev>';
       ?>
    </div>
    <!-- {{ $s->SongLyrics }} -->
  </div>
  <button onclick="seemore()" class="col-12 lyrics" id="clickseemore" style="border:none;border-top: solid grey 1px; border-radius: 0 0 5px 5px; margin-top: 0;">
    <span class="" id="title-more">
      See more
    </span> <i class="fa fa-arrow-down"></i>
  </button>
</div>
<div class="row media-audio" style="width: 93%;">
  <div class="col-12 artist" style="font-size: 28px; margin-bottom: 10px;">
    Comments
  </div>
  <div class="" style="width: 100%;">
    <!-- form submit a comment -->
    <form class="" action="{{url('/user/comment')}}" method="post">
      {{ csrf_field() }}
      <div class="" style="width: 100%;">
        <textarea id="userComment" rows="4" cols="80" placeholder="Your comment goes here..." style="width: 100%;
        border: none; border-radius: 5px; padding: 5px; resize: none;"></textarea>
      </div>
      <button type="button" name="button" id="submit-comment" class="btn btn-success">Submit</button>

      <p id="submitcmt" style="color: white;">

      </p>
    </form>
    <!-- end form submit comment -->
  </div>
</div>
<div class="" id="comment" style="margin-top:30px;">
  <!-- comments -->
  @foreach ($comment as $key => $c)
  <div class="row media-audio lyrics" style="width: 93%; margin-top: 20px;">
    <div class="col-3" style="text-align: center; margin: auto 0;">
      <img src="{{asset('Uploads/User/'.$c->UserAvt)}}" alt="" width="100px;" style="border-radius: 50px;">
    </div>
    <div class="col-9">
      <div class="row" style="border-bottom: solid 1px grey; font-size: 20px;">
        <div class="col-6">
          {{ $c->UserName }}
        </div>
        <div class="col-6" style="text-align: right; font-size: 15px;">
          {{ $c->CommentTime }}
        </div>
      </div>
      <div class="row" style="margin-top: 20px; text-align: justify; padding: 0 30px 0 15px;">
        {{ $c->CommentContent }}
      </div>
      <?php
        $UserId = Session::get('UserId');
        if ($UserId == $c->UserId){
      ?>
      <div class="row" style="text-align: right">
        <div class="col-9"></div>
        <div class="col-3" class="delcmt">
          <!-- <a href="{{ url('/user/comment/delete/'.$c->CommentId) }}" class="fa fa-trash"></a> -->
          <i class="fa fa-trash"></i>
          <input type="hidden" value="{{ $c->CommentId }}">
        </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
  @endforeach
</div>

<style>
  .seemore:hover {
    cursor: text;
  }
</style>

<script type="text/javascript">
  $('#addplaylist').on('click', function(){
    var query = "abc";
    console.log($(this));
    $.ajax({
      method: "POST",
      url: "{{ route('displayplaylists') }}",
      data: { data:query, _token: '{!! csrf_token() !!}' },
      success:function(data){
        $('#sp').append(data);
        // $('#playlistsongs').on('mouseleave', function(){
        //   $('#playlistsongs').remove();
        // })
      }
    })
  })


  //delete comment
  $(document).ready(function(){
    $('.delcmt').on('click', function(){
      console.log($(this))
    })
  })
  // $('body').on('click', '.seemore, .seeless', function(){
  //   $(this).toggleClass('seeless seemore');
  // });

  // See more and less lyrics
  function seemore(){
    var clickseemore = document.getElementById('clickseemore').querySelector('i');
    console.log(clickseemore);
    var seemore = document.getElementsByClassName('seemore');
    var seeless = document.getElementsByClassName('seeless');
    console.log(seeless);

    if (seemore[0]){
        var s = document.getElementById('seemore');
        clickseemore.classList.remove('fa-arrow-down');
        clickseemore.classList.add('fa-arrow-up');
        document.getElementById('title-more').innerHTML = "See less";
        s.classList.remove('seemore');
        s.classList.add('seeless');
    }else {
      var s = document.getElementById('seemore');
      clickseemore.classList.remove('fa-arrow-up');
      clickseemore.classList.add('fa-arrow-down');
      document.getElementById('title-more').innerHTML = "See more";
      s.classList.remove('seeless');
      s.classList.add('seemore');
    }
  }

  // Submit comment using AJAX
  $('#submit-comment').on('click', function(){
    var query = $('#userComment').val();
    var song = $('#content-like').val();
    console.log(song);
    $('#submitcmt').html('Submiting...');
    $.ajax({
      url: "{{ route('submitComment') }}",
      method: "POST",
      data:{query:query, song:song, _token: '{!! csrf_token() !!}'},
      success:function(data){
        $('#comment').append(data);
        $('#userComment').val('');
        $('#submitcmt').html('');
      }
    });
    query = null;
  })
// User - like and remove like
  $('#abc').on('click', '#lsong', function(){
    var query = $('#content-like').val();
    console.log($('#lsong'));
    console.log(query);
    $.ajax({
        url:"{{ route('userlike') }}",
        method:"POST",
        data:{query:query, _token: '{!! csrf_token() !!}'},
        success:function(data){
          $('#lsong').replaceWith(data);
        }
    });
  });

  $('#abc').on('click', '#dsong', function(){
    var query = $('#content-like').val();
    console.log(query);
    $.ajax({
        url:"{{ route('userdislike') }}",
        method:"POST",
        data:{query:query, _token: '{!! csrf_token() !!}'},
        success:function(data){
          $('#dsong').replaceWith(data);
        }
    });
  });



// ATLANTEANS SUPERIOR PLAY ENGINE
  var song = document.getElementById('songsrc').firstElementChild;
  var btn = document.getElementById('play');

  var progress = document.getElementById('progress');
  var start = document.getElementById('start');
  var end = document.getElementById('end');

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




  console.log(progress);
  btn.addEventListener('click', function(){
    if (song.paused){
      song.play();
      // btn.src = "{{asset('Root-properties/pause.svg')}}";
      document.getElementById('play').firstElementChild.className = "fa fa-pause-circle";
      btn.style.transition = "all 0.4s";
    }else {
      song.pause();
      // btn.src = "{{asset('Root-properties/play.svg')}}";
      document.getElementById('play').firstElementChild.className = "fa fa-play-circle";
      btn.style.transition = "all 0.4s";
    }

  })

  song.ontimeupdate = function () {
      if (song.duration) {
          const p = Math.floor(song.currentTime / song.duration * 100);
          progress.value = p;

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
      if(song.ended) {
        document.getElementById('play').firstElementChild.className = "fa fa-play-circle";
        song.currentTime = 0;
      }
  }
  progress.onchange = function () {
      const seekTime = progress.value * song.duration / 100;
      song.currentTime = seekTime;
      console.log(seekTime);
  }
</script>
@endforeach

@endsection
