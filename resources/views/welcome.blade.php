<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlanteans</title>

    <!-- Bootstrap plug-in -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Css - HOMEPAGE -->
    <link rel="stylesheet" href="{{asset('/CSS/homepage.css')}}">
    <link rel="stylesheet" href="{{asset('/CSS/login.css')}}">

    <!-- Title image -->
    <link rel="shortcut icon" href="{{asset('Root-properties/favicon.png')}}" type="image/x-icon">
</head>
<body>
    <div class="container-fluid" style="position: relative;">
        <div class="row" style="background-color: #232528; height: 5em; line-height: 5em;">
            <div class="col-2"></div>
            <div class="col-3" style="font-size: 25px; color: white; font-family: Freemono; font-weight: bold;">
                <a href="{{url('/')}}" style="text-decoration: none; color: white;">
                    <img class="logo" src="{{asset('/Root-properties/atlanteans-musique.png')}}" alt="Atlanteans" style="width: 50px;">
                Atlanteans
                </a>
            </div>
            <div class="col-5" style="text-align: right;">
                <ul>
                    <?php
                        //phpinfo();
                        $UserId = Session::get('UserId');
                        if ($UserId){
                    ?>
                        <a href="{{url('/user/logout')}}"><li>Log out</li></a>
                    <?php
                        }else{
                    ?>
                        <a href="{{url('/user/login')}}">
                          <li>Sign in</li></a>
                    <?php
                        }
                    ?>
                    <?php
                        $user = Session::get('UserId');
                        if($user){
                    ?>
                    <!-- <a href="{{url('/user/signup')}}"><li>Sign up</li></a> -->
                        <?php }else{ ?>
                            <a href="{{url('/user/signup')}}"><li>Sign up</li></a>
                    <?php } ?>
                    <a href="{{url('/user/support')}}"><li>Support</li></a>
                </ul>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row" style="background-color:#223d92; height: 40em;">
            <div class="col-2"></div>
            <div class="col-8 head1">
                <div class="row" style="height: 100%;">
                    <div class="col"></div>
                    <div class="col-5">
                        <div
                            style="position: relative; top: 50%; transform: translateY(-50%); color: white; font-size: 40px; text-align: left;">
                            EXPLORE YOUR NEW <big>FAVOURITE MUSIC</big>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-3">
                        <a href="{{url('/play')}}" style="text-decoration: none;">
                            <div class="btn-play">
                                PLAY
                            </div>
                        </a>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <!-- <div class="col-5"></div> -->
            <div class="col-2"></div>
        </div>
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
                <i class="fa fa-twitter"></i>
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
                    }else {
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
</html>
