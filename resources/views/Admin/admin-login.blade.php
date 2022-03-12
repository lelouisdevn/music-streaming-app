<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Login CSS -->
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">

    <!-- Title image  -->
    <link rel="shortcut icon" href="{{asset('Root-properties/favicon.png')}}" type="image/x-icon">
</head>
<body>
    <div class="full">
        <form action="{{url('/admin/login/authenticate')}}" method="post">
            {{csrf_field()}}
            <div class="container">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt=""></a>
                </div>
                <div class="loginform">
                    <div class="tm">Atlanteans</div>
                    <div class="title">Log in</div>
                    <br>
                    <div class="thirdparty-signin">
                        <div class="google"> <i class="fa fa-google"></i> Sign in with Google</div>
                        <div class="facebook"><i class="fa fa-facebook"></i> Sign in with Facebook</div>
                        <div class="phone"><i class="fa fa-phone"></i> Sign in with Phone number</div>
                    </div>
                    <div style="color: white; font-weight: bold; margin: 10px;">
                        OR
                    </div>
                    <div class="username-password">
                        <input type="email" placeholder="Email:" name="email">
                        <input type="password" placeholder="Password:" name="password">
                    </div>
                    <!-- <div style="color: lightgrey; text-align: left; font-size: 19px;">
                        Haven't registed one yet? Create <a style="color: lightgrey;" href="{{url('user/signup')}}">here!</a>
                    </div> -->
                </div>
                <button class="btn-login" type="submit">
                    Log in
                </button>
            </div>
        </form>
    </div>
</body>

</html>
