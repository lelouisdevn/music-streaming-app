<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>

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
    <!-- <div class="full" id="rst-pwd-pg">
            <div class="container" style="margin-top: 120px;">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt=""></a>
                </div>
                <div class="loginform">
                    <div class="tm">Atlanteans</div>
                    <div class="title">Reset password</div>
                    <br>
                    
                    <div class="username-password" id="field">
                        <p id="noti" style="font-size:25px; color: white; text-align: left;">
                            To reset your password, we need the email that was bound to your account, please enter in the section below:
                        </p>
                        <input type="email" placeholder="Enter account email:..." id="email-rspwd">
                    </div>
                </div>
                <p id="sending"></p>
                <button class="btn-login" id="fgpwd">
                    Get OTP
                </button>
            </div>
        
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
                <div class="title" style="color: black; font-family: freemono;">Reset password</div>
          </div>

          <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group" id="field">
                <label for="" id="labeli">Email:</label>
                <input id="email-rspwd" type="text" name="email" value="" class="form-control" placeholder="Enter email:...">
            </div>
              <div class="form-group">
                <button id="fgpwd" type="submit" name="button" class="btn btn-success btn-block" style="background-color: #223d92;">Get OTP</button>
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
    $('#fgpwd').on('click', function(){
        var email = $('#email-rspwd').val();
        var rpwd = $('#rpwd').val();
        console.log(rpwd);
        console.log(email);
        if (email.indexOf('@') >= 0){
            $('#sending').html('Sending passcode...').css({'color':'black', 'margin': 0});
        }else if($('#email-rspwd').attr('placeholder').indexOf('OTP') >= 0){
            $('#sending').html('Verifying...').css({'color':'black', 'margin': 0});
        }else {
            $('#sending').html('Creating new password...').css({'color':'black', 'margin':0});
        }
        $.ajax({
            method: "POST",
            url: "{{ route('resetWithEmail') }}",
            data: { email: email, _token: '{!! csrf_token() !!}' },
            success:function(data){
                if (email.indexOf('@') >= 0){
                    $('#fgpwd').html('Verify');
                    $('#sending').html('');
                    $('#noti').html('Next step, put the OTP we\'ve just sent you. Notice that the email might be filtered as spam mail.');
                    $('#email-rspwd').val('');
                    $('#labeli').html('Passcode:')
                    $('#email-rspwd').attr('placeholder', 'Enter OTP:...');
                }else if (data.indexOf('Unmatched') >= 0){
                    $('#sending').html(data).css({'color':'black', 'margin':0});
                }else if (data.indexOf('Reset') >= 0){
                    window.setTimeout(function(){
                        $('#sending').html(data).css({'color':'white', 'margin':0})
                    }, 2000);
                    location.href = '/play';
                }else{
                    $('#labeli').html('New password:')
                    $('#sending').html(data).val('');
                    $('#email-rspwd').val('');
                    $('#noti').html('Create your new password, a password should contain at least 8 characters with a special character such as @, #, &, !, ^, ?');
                    $('#email-rspwd').attr('placeholder', 'Create new password:...');
                    $('#email-rspwd').attr('type', 'password');
                    $('#field').append('<input id="rpwd" class="form-control" style="margin-top: 5px;" placeholder="Retype password:..." type="password">');
                    $('#fgpwd').html('Create new password');
                }
            }
        })
    })


</script>
</html>
