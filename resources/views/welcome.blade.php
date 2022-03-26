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
    <script src="{{asset('JS/jquery-3.6.0.min.js')}}" charset="utf-8"></script>

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
                        <!-- <a href="{{url('/user/login')}}">
                          <li>Sign in</li></a> -->
                          <a style="cursor: pointer" data-toggle="modal" data-target="#myModal"><li>Sign in</li></a>
                    <?php
                        }
                    ?>
                    <?php
                        $user = Session::get('UserId');
                        if($user){
                    ?>
                    <!-- <a href="{{url('/user/signup')}}"><li>Sign up</li></a> -->
                        <?php }else{ ?>
                            <!-- <a href="{{url('/user/signup')}}"><li>Sign up</li></a> -->
                            <a style="cursor: pointer;" data-target="#modal-signup" data-toggle="modal"><li>Sign up</li></a>
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
                        <?php 
                            if (Session::get('UserId')){
                        ?>
                        <a href="{{url('/play')}}" style="text-decoration: none;">
                            <div class="btn-play">
                                PLAY
                            </div>
                        </a>
                        <?php
                            }else{
                        ?>
                        <a data-target="#myModal" data-toggle="modal">
                            <div class="btn-play">
                                PLAY
                            </div>
                        </a>
                        <?php } ?>
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
                    <!-- <a href="{{url('/user/login')}}">Sign in</a> -->
                    <a style="color: grey; cursor: pointer;" data-toggle="modal" data-target="#myModal">Sign in</a>
                <?php
                    }
                ?>
            </div>
            <div class="col-4" style="text-align: right;">2022 &copy; Atlanteans . Designed by Ngô Trần Vĩnh Thái.</div>
            <div class="col-2"></div>
        </div>
    </div>

    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header text-center d-block">
            <button type="button" name="button" class="close" data-dismiss="modal" style="position: absolute; right: 5%;">&times;</button>
                <div class="logo" style="text-align: center;">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" style="width: 75px; border-radius: 50%;" alt=""></a>
                </div>
                <div class="tm" style="color: black;">Atlanteans</div>
                <div class="title" style="color: black; font-family: freemono;">Log in</div>
          </div>

          <!-- Modal body -->
        <div class="modal-body">
            <form>
            <div class="form-group" id="loginpwd1">
                
            </div>
            <div class="form-group">
                <label for="">Email:</label>
                <input id="lgine" type="text" name="email" value="" class="form-control" placeholder="Enter email:...">
            </div>

            <div class="form-group">
                <label for="">Password:</label>
                <input id="lginpwd" type="password" name="password" value="" class="form-control" placeholder="Enter password:...">
            </div>
<!-- 
              <div class="form-group form-check">
                <input type="checkbox" name="" value="" class="form-check-input">
                <label class="form-check-label">Ghi nhớ tôi</label>
              </div> -->

              <div class="form-group">
                <a id="lgin" name="button" class="btn btn-success btn-block" style="background-color: #223d92;">Log in</a>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger mr-auto" data-dismiss="modal">
              <i class="fa fa-times"> Cancel</i>
            </button>
            <div class="text-right">
              <!-- <div>Bạn chưa phải là thành viên? <a href="#">Đăng ký</a></div> -->
                <div>
                    Haven't registed one yet? Create <a style="color: black;" href="{{url('user/signup')}}">here!</a>
                </div>
              <div>Forgot <a href="{{ url('user/forgotPassword') }}"">password?</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- #signup -->
    <div class="modal fade" id="modal-signup">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header text-center d-block">
            <button type="button" name="button" class="close" data-dismiss="modal" style="position: absolute; right: 5%;">&times;</button>
                <div class="logo" style="text-align: center;">
                    <a href="{{url('/')}}"><img src="{{asset('Root-properties/atlanteans-musique.png')}}" style="width: 75px; border-radius: 50%;" alt=""></a>
                </div>
                <div class="tm" style="color: black;">Atlanteans</div>
                <div class="title" style="color: black; font-family: freemono;">Sign up</div>
          </div>

          <!-- Modal body -->
        <div class="modal-body">
            <form class="" action="{{url('/user/register')}}" method="post">
                {{ csrf_field() }}
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" name="useremail" value="" class="form-control" placeholder="Enter email:..." id="signupemail">
            </div>
            <div class="form-group">
                <label for="">Username:</label>
                <input type="text" name="username" value="" class="form-control" placeholder="Enter username:..." id="signupname">
            </div>
            <div class="form-group">
                <label for="">Password:</label>
                <input type="password" name="userpassword" value="" class="form-control" placeholder="Enter password:..." id="signuppwd">
            </div>
<!-- 
              <div class="form-group form-check">
                <input type="checkbox" name="" value="" class="form-check-input">
                <label class="form-check-label">Ghi nhớ tôi</label>
              </div> -->
              <div class="form-group" id="signuppwd1">
                
              </div>
              <div class="container-signup form-group">
                        <div class="left">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Day</p>
                            <select name="day" id="day">
                                <script language="javascript" type="text/javascript">
                                    var month = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                                    for (var d = 1; d <= 31; d++) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="left" style="margin-left:2px;">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px;">Month</p>
                            <select class="light" name="month" id="month" required>
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
                            <select name="year" id="year" required>
                                <script>
                                    for (var d = 2022; d >= 1950; d--) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                </div>
              <div class="form-group">
                <button type="submit" id="signupbtn" name="button" class="btn btn-success btn-block" style="background-color: #223d92;">Sign up</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger mr-auto" data-dismiss="modal">
              <i class="fa fa-times"> Cancel</i>
            </button>
            <!-- <div class="text-right">
                <div>
                    Haven't registed one yet? Create <a style="color: black;" href="{{url('user/signup')}}">here!</a>
                </div>
              <div>Quên <a href="{{ url('user/forgotPassword') }}"">mật khẩu?</a></div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
</body>

<script>

    $("#signupbtn").on('click', function(){
        var email = $('#signupemail').val();
        var name = $('#signupname').val();
        var passwd = $('#signuppwd').val();
        var day = $('#day');
        var month = $('#month');
        var year = $('#year');

        console.log(day);
    });
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
                $('#signuppwd1').html('Undefined email format!').css('color', 'darkred');
                $('#signupemail').css('border', 'red solid 2px');
            }else {
                $('#signuppwd1').html('').css('color', 'blue');
                $('#signupemail').css('border', 'lightgrey solid 1px');
                er_email = 1;
            }    
    })
    $('#signuppwd').on('keyup', function(){
        var value = $(this).val().length;
        if (value < 8){
            $('#signuppwd1').html('Weak password!').css('color', 'darkred');
        }else{
            $('#signuppwd1').html('');
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

    $('#lgin').on('click', function(){
        var email = $("#lgine").val();
        var passwd = $("#lginpwd").val();
        console.log(email);
       
        $.ajax({
            method: "POST",
            url: "{{ route('prelogin') }}",
            data: {email:email, passwd:passwd, _token: "{!! csrf_token() !!}"},
            success:function(data){
                if (data.indexOf('user') >= 0 ){
                    $('#loginpwd1').html("We're signing you in....");
                    window.location.replace('/play');
                }else if (data.indexOf('admin') >= 0){
                    $('#loginpwd1').html("We're signing you in....");
                    window.location.replace('admin/list-albums');
                }else {
                    $('#loginpwd1').html(data);
                }
            }
        })
    });

</script>
</html>