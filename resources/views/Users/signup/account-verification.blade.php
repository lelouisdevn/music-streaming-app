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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<style>
    body {
        background-image: url('/Root-properties/abc.png');
    }
</style>
<body>
    <!-- <div class="full">
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
                    <div class="username-password">
                            We just sent you an email containing a verification code. Please put it here to complete registering your account!
                        </p>
                        <input type="password" placeholder="Enter received OTP here:" name="signupotp">
                    </div>
                </div>
                <button class="btn-login" type="submit">
                    Verify
                </button>
            </div>
        </form>
    </div> -->

    <div id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header text-center d-block">
            <!-- <button type="button" name="button" class="close" data-dismiss="modal" style="position: absolute; right: 5%;">&times;</button> -->
                <div class="logo" style="text-align: center;">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" style="width: 75px; border-radius: 50%;" alt=""></a>
                </div>
                <div class="tm" style="color: black;">Atlanteans</div>
                <div class="title" style="color: black; font-family: freemono;">OTP Verification</div>
          </div>

          <!-- Modal body -->
        <div class="modal-body">
            <form action="{{url('/user/register/complete')}}" method="POST">
                {{ csrf_field() }}
            <div class="form-group" id="field">
                <label for="" id="labeli">Passcode:</label>
                <input id="email-rspwd" type="text" name="signupotp" value="" class="form-control" placeholder="Enter passcode:...">
            </div>
              <div class="form-group">
                <button id="fgpwd" type="submit" name="button" class="btn btn-success btn-block" style="background-color: #223d92;">Verify</button>
              </div>
              <p id="sending" class="form-group"></p>
          </div>
          <div class="modal-footer">
            <a href="{{url('/')}}" class="btn btn-danger mr-auto" data-dismiss="modal">
              <i class="fa fa-times"> Cancel</i>
            </a>
            <div class="text-right">

            </div>
          </div>
            </form>
        </div>
      </div>
    </div>

    <div class="footer">
        2022 &copy; Atlanteans . Designed by Ngô Trần Vĩnh Thái.
    </div>
</body>

<style>
    .footer {
        position: absolute;
        bottom: 0;
        padding: 20px 0;
        text-align: center;
        background: black;
        color: white;
        width: 100%;
    }
</style>

<script>
    $('#signuppwd').on('keyup', function(){
        var value = $(this).val().length;
        if (value < 8){
            $('#signuppwd1').html('Weak password!').css('color', 'yellow');
        }else{
            $('#signuppwd1').html('');
        }
    })

</script>
</html>
