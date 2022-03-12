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
        <form action="{{url('/user/register')}}" method="post" id="formsignup">
            {{ csrf_field() }}
            <div class="container" style="margin-top: 120px;">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt=""></a>
                </div>
                <div class="loginform">
                    <div class="tm">Atlanteans</div>
                    <div class="title">Sign up</div>
                    <br>
                    <div class="thirdparty-signin">
                        <div class="google"> <i class="fa fa-google"></i> Sign up with Google</div>
                        <div class="facebook"><i class="fa fa-facebook"></i> Sign up with Facebook</div>
                        <div class="phone"><i class="fa fa-phone"></i> Sign up with Phone number</div>
                    </div>
                    <div style="color: white; font-weight: bold; margin: 10px;">
                        OR
                    </div>
                    <div class="username-password">
                        <input type="email" placeholder="Email:" name="useremail" id="signupemail">
                        <input type="text" placeholder="Username:" name="username" id="signupname">
                        <input type="password" placeholder="Password" name="userpassword" id="signuppwd">
                        <p id="signuppwd1" style="position: absolute; top: 71%"></p>
                    </div>
                    <div class="container-signup">
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Day</p>
                            <select name="day" id="">
                                <script language="javascript" type="text/javascript">
                                    var month = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                                    for (var d = 1; d <= 31; d++) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Month</p>
                            <select class="light" name="month" required>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Year</p>
                            <select name="year" required>
                                <script>
                                    for (var d = 2022; d >= 1950; d--) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                    </div>
                </div>
                </form>

                <div class="btn-login" id="sub">
                    Sign up
                                </div>
            </div>
    </div>
</body>
<script>
    var er_email;
    var count;
    $('#signupemail').on('keyup', function(){
        var email = $(this).val();
        var a = email.indexOf('@');
        // console.log(a);
        var b = email.indexOf('@', a+1);
        // console.log(b);
        var special = ['!', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '='];
        for (var i = 0; i < special.length; i++){
            if (email.includes(special[i]) || email.indexOf('@')==0 || !email.includes('@') || b != -1){
                er_email = 0;
                break;
            }else {
                er_email = 1;
            }
        }
            if (er_email==0){
                $('#signuppwd1').html('Undefined email format!').css('color', 'yellow');
                $('#signupemail').css('border', 'red solid 2px');
            }else {
                $('#signuppwd1').html('').css('color', 'blue');
                $('#signupemail').css('border', 'none');
                er_email = 1;
            }    
    })
    $('#signuppwd').on('keyup', function(){
        var value = $(this).val().length;
        if (value < 8){
            $('#signuppwd1').html('Weak password!').css('color', 'yellow');
        }else{
            $('#signuppwd1').html('Strong password!').css('color', 'blue');
        }
    })
    $('#signuppwd').on("blur", function(){
        $('#signuppwd1').html('');
    })
    $('#sub').on('click', function(){
        var name = $('#signupname').val()
        var email = $('#signupemail').val();
        var pwd = $('#signuppwd').val();
        if (name != null && email != null && pwd != null && er_email == 1){
            $('#formsignup').submit();
        }else alert('Fields cannot be null');
        console.log(name)
    })
    
</script>
</html>
