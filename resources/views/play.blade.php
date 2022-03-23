<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Play</title>

    <!-- Bootstrap plug-in -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Css - HOMEPAGE -->
     <link rel="stylesheet" href="{{asset('/CSS/homepage.css')}}">
     <link rel="stylesheet" href="{{asset('CSS/login.css')}}">


     <!-- CSS play -->
     <link rel="stylesheet" href="{{asset('/CSS/play.css')}}">

    <!-- Title image -->
    <link rel="shortcut icon" href="{{asset('Root-properties/favicon.png')}}" type="image/x-icon">

    <!-- JQuery plugin -->
    <script src="{{asset('JS/jquery-3.6.0.min.js')}}" charset="utf-8"></script>


</head>

<body>
    <div class="container-fluid">
        <!-- TITLE BAR -->
        <div class="row" style="background-color: #232528; height: 5em; line-height: 5em; position: sticky; top: 0; z-index: 2;">
            <div class="col-2"></div>
            <div class="col-2" style="font-size: 25px; color: white; font-family: Freemono; font-weight: bold;">
                <a href="{{url('/')}}" style="color: white; text-decoration: none;">
                    <img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt="firefox.png" style="width: 50px;">
                Atlanteans
                </a>
            </div>
            <div class="col-4 search">
              <form id="formsearch" class="" action="{{ url('/user/song/search') }}" method="GET">
                <div style="display: inline;">
                  <input type="search" id="search"  placeholder="Search..." name="keyword"
                  autocomplete="off">
                  <div id="livesearch" style="margin-top: -22px;">

                  </div>
                </div>

              </form>
              
            </div>
            <div class="col-2 items" style="text-align: right;">
                <ul>
                    <?php
                        $UserId = Session::get('UserId');
                        if ($UserId){
                    ?>
                        <a href="{{url('/user/logout')}}"><li>Log out</li></a>
                    <?php
                        }else{
                    ?>
                        <a href="{{url('/user/login')}}"><li>Sign in</li></a>
                    <?php
                        }
                    ?>
                    <!-- <a href="{{url('/user/signup')}}">
                        <li>Sign up</li>
                    </a> -->
                    <a href="{{url('/user/support')}}"><li>Support</li></a>
                </ul>
            </div>
            <div class="col-2"></div>
        </div>
        <!-- END TITLE BAR -->

        <!-- MAIN - MUSICS -->
        <div class="row" style="background-color: #444464;">
            <div class="col-2"></div>
            <div class="col-2 sidebar-play">
              <?php
                $username = Session::get('UserName');
              ?>
              <div class="" style="margin-bottom: 50px; position: sticky; top: 110px; ">
                <?php echo "Hello ".$username.'!' ?>
              </div>
                <a href="{{url('/play')}}" style="position: sticky; top: 190px; ">
                  <div>
                    <i class="fa fa-play">
                      <span style="font-family: sans-serif; "> Play</span>
                    </i>
                  </div>
                </a>
                <a href="{{url('/user/profile')}}" style="position: sticky; top: 220px; "><div> <i class="fa fa-user" style="font-size: 19px;">
                  <span style="font-family: sans-serif; "> Profile</span>
                </i> </div></a>

                <a href="{{url('/user/account')}}" style="position: sticky; top: 255px; ">
                    <div>
                        <i class="fa fa-cog" style="font-size: 19px;">
                            <span style="font-family: sans-serif; "> Account</span>
                        </i>
                    </div>
                </a>

                <a href="{{url('/user/favourite')}}" style="position: sticky; top: 286px; "><div><i class="fa fa-heart">
                  <span style="font-family: sans-serif; "> Liked songs</span>
                </i></div></a>
                <a href="{{ url('/user/albums') }}" style="position: sticky; top: 320px; ">
                    <div>
                        <i class="fa fa-book">
                            <span style="font-family: sans-serif; "> Liked albums</span>
                        </i>
                    </div>
                </a>
                <div style="border-bottom: solid whitesmoke 1px; position: sticky; top: 360px; "></div>
                <!-- <a id="addpl">
                    <div>
                        <i class="fa fa-plus-circle">
                            <span style="font-family: sans-serif;"> Create playlist</span>
                        </i>
                    </div>
                </a>
                <a id="inputf">

                </a> -->
                
                <a href="{{ url('/user/logout') }}" style="position: sticky; top: 370px; "><div><i class="fa fa-sign-out">
                  <span style="font-family: sans-serif; "> Log out</span>
                </i></div></a>
            </div>
            <div class="col-6 content">

            <!-- YIELD -->
                @yield('playContent')
            <!-- END YIELD -->

            <a href="#" id="toTop" class="btn btn-primary"><i class="fa fa-arrow-up"></i></a>

            </div>
            <div class="col-2"></div>
        </div>
        <!-- END MAIN MUSICS -->

        <!-- FOOTER -->
        <div class="row" style="background-color:#232528; height: 20em; color: white;">
            <div class="col-2"></div>
            <div class="col-2"
                style="font-family: freemono; color: white; font-weight: bold; margin-top: 30px; font-size: 30px;">
                Atlanteans<small>&trade;</small></div>
            <div class="col-2 foot1">
                <p>ABOUT US</p>
                <ul>
                    <li>Who we are</li>
                    <li>Headquarters</li>
                    <li>Services</li>
                </ul>
            </div>
            <div class="col-2 foot1">
                <p>INFORMATION</p>
                <ul>
                    <li>Cookies policy</li>
                    <li>Privacy policy</li>
                    <li>Users' terms</li>
                    <li>Copyright certificates</li>
                </ul>
            </div>
            <div class="col-2 foot1 last">
                <p>CONTACTS</p>
                <i class="fa fa-youtube-play"></i>
                <i class="fa fa-instagram"></i>
                <a href="https://www.twitter.com/pyssurt" style="color: white;"><i class="fa fa-twitter"></i></a>
            </div>
            <!-- <div class="col-5"></div> -->
            <div class="col-2"></div>
        </div>
        <div class="row" style="background: #232528; color: white; height: 80px;">
            <div class="col-2"></div>
            <div class="col-4 foot-a">
                <a href="{{url('/play')}}">Homepage</a>
                <a href="{{url('/user/profile')}}">Profile</a>
                <a href="{{url('/user/feedback')}}">Feedback</a>
                <a href="{{url('/user/favourite')}}">Favourites</a>
                <?php
                        $UserId = Session::get('UserId');
                        if ($UserId){
                    ?>
                        <a href="{{url('/user/logout')}}">Log out</a>
                    <?php
                        }else{
                    ?>
                        <a href="{{url('/user/login')}}">Sign in</a>
                    <?php
                        }
                    ?>
            </div>
            <div class="col-4" style="text-align: right;">2022&copy;Atlanteans . Designed by Ngô Trần Vĩnh Thái.</div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
<style>
    
</style>
<script type="text/javascript">
    
    $('#search').on('keypress', (e)=>{
        if (e.which == 13){
            var query = $('#search').val();
        console.log(query);
        window.location.href = "http://localhost:8000/user/song/search=" + encodeURIComponent(query);
        }
    })

    $('#search').on('mouseover', function(){
        $('input').css('border-radius', '0px');
        $('input').css('transition', '400ms');
    })

    $('#search').on('mouseleave', function(){
        $('input').css('border-radius', '5px');
    })
    $(":not(#livesearch)").on('click', function(){
        $('#livesearch').fadeIn();
        $('#livesearch').html('');
    })
    $('#livesearch').on('mouseover', function(){
        $('input').css('border-radius', '0px');
    })
    $('#toTop').on('click', function(){
        $('html,body').animate({scrolltop: 0}, 'fast');
    })
    // khi nguoi dung go ky tu gi do vao o tim kiem
    // o tim kiem co id la search
  $('#search').on('keyup', function(){
    var value = $(this).val();
    //console.log(value)
    var _token = $('input[name="_token"]').val();

        $.ajax({
        method: "get",
        url: "{{ route('search') }}",
        data:{value:value, _token:_token},
        success:function(data){
            $('#livesearch').fadeIn();
            $('#livesearch').html(data);
        }
        })
  })
  $(document).on('click', 'li', function(){
    $('#search').val($(this).text());
    var val = $(this).text();
    console.log(val)
    var fs = document.getElementById('search');
    fs.value = val;
    console.log(fs.value)
    $('#formsearch').submit();
  })

  $('#addpl').on('click', function(){
      var inputf = $('<input autofocus type="text" placeholder="Enter playlist name:..." style="background: none; border: none; color: white; outline: none;";">');
      $('#inputf').html(inputf);
      $('#inputf').focus();
  })
  $('#inputf').on('mouseleave', function(){
      $('#inputf').html('');
  })
  $('#inputf').keydown(function(e){
      if (e.which == 13){
          var playlistName = $('#inputf').find('input').val();
          console.log(playlistName);

          $.ajax({
              method: "POST",
              url: "{{ route('addPlayList') }}",
              data: { query: playlistName, _token: "{!! csrf_token() !!}" },
              success:function(data){
                  $('#inputf').html('');
                  $('#lists').append(data);
              }
          })
      }
  })
</script>
</html>
 