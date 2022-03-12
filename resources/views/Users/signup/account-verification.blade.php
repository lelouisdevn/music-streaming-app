<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

    <!-- File CSS Login.css -->
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Title image -->
    <link rel="shortcut icon" href="{{asset('Root-properties/favicon.png')}}" type="image/x-icon">

    <!-- JQuery -->
    <script src="{{asset('JS/jquery-3.6.0.min.js')}}" charset="utf-8"></script>
</head>
<body>
    <div class="full">
        <form action="{{url('/user/register/complete')}}" method="post">
            {{ csrf_field() }}
            <div class="container" style="margin-top: 120px;">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt=""></a>
                </div>
                <div class="loginform">
                    <div class="tm">Atlanteans</div>
                    <div class="title">Sign up</div>
                    <br>
                    <!-- <div class="thirdparty-signin">
                        <div class="google"> <i class="fa fa-google"></i> Sign up with Google</div>
                        <div class="facebook"><i class="fa fa-facebook"></i> Sign up with Facebook</div>
                        <div class="phone"><i class="fa fa-phone"></i> Sign up with Phone number</div>
                    </div>
                    <div style="color: white; font-weight: bold; margin: 10px;">
                        OR
                    </div> -->
                    <div class="username-password">
                        <!-- <input type="email" placeholder="Email:" name="useremail">
                        <input type="text" placeholder="Username:" name="username">
                        <input type="password" placeholder="Password" name="userpassword" id="signuppwd">
                        <p id="signuppwd1" style="position: absolute; top: 71%"></p> -->
                        <p style="font-size:25px; color: white;">
                            We just sent you an email containing a verification code. Please put it here to complete registering your account!
                        </p>
                        <input type="password" placeholder="Enter received OTP here:" name="signupotp">
                    </div>
                    <!-- <div class="container-signup">
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Day</p>
                            <select name="day" id="">
                                <script language="javascript" type="text/javascript">
                                    for (var d = 1; d <= 31; d++) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Month</p>
                            <select class="light" name="month" required>
                                <option value="1">Tháng 1</option>
                                <option value="2">Tháng 2</option>
                                <option value="3">Tháng 3</option>
                                <option value="4">Tháng 4</option>
                                <option value="5">Tháng 5</option>
                                <option value="6">Tháng 6</option>
                                <option value="7">Tháng 7</option>
                                <option value="8">Tháng 8</option>
                                <option value="9">Tháng 9</option>
                                <option value="10">Tháng 10</option>
                                <option value="11">Tháng 11</option>
                                <option value="12">Tháng 12</option>
                            </select>
                        </div> -->
                        <!-- <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Year</p>
                            <select name="year" required>
                                <script>
                                    for (var d = 2022; d >= 1950; d--) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                    </div> -->
                </div>
                <button class="btn-login" type="submit">
                    Verify
                </button>
            </div>
        </form>
    </div>
</body>
<script>
    $('#signuppwd').on('keyup', function(){
        var value = $(this).val().length;
        if (value < 8){
            $('#signuppwd1').html('Weak password!').css('color', 'yellow');
        }else{
            $('#signuppwd1').html('Strong password!').css('color', 'blue');
        }
    })

</script>
</html>
