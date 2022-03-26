@extends('play')
@section('playContent')

<div class="row profile" style="height: 170px;">
          <div class="col-10 songs" style="font-size: 35px;">Account</div>
          <div class="col-2 songs" style="font-size: 35px;">
            <div class="fa fa-cog parent" style="margin: 0;">
              <div class="child">
                <p><a href="{{url('/user/password/change')}}">Change password</a></p>
                <p><a href="#">Delete account</a></p>
                <p><a href="{{url('/user/logout')}}">Log out</a></p>
              </div>
            </div>
          </div>
        </div>
        @foreach ($user as $key => $user)
        <div class="row profile" style="margin-bottom: 100px;">
          <div class="col-3"></div>
          <div class="col-6 formm" style="text-align: center;">
            <div style="text-align: center;">
              <img src="{{asset('Uploads/User/'.$user->UserAvt)}}" alt="" width="100px">
            </div>
            <div class="songs" style="text-align: center;">
              Change account password!
            </div>
            <form action="{{url('/user/password/reset')}}" method="POST" id="form_change_pwd">
                {{csrf_field()}}
                <div>
                    <div style="alert alert-primary">
                        <input type="password" placeholder="Enter new password" name="passwd" id="pwd">
                    </div>
                    <div style="alert alert-primary">
                        <input type="password" placeholder="Verify password" name="passwd1" id="pwd1">
                        <p id="rpwd"></p>
                    </div>
                    
                </div>
                
            </form>
            <button class="btn btn-primary" id="changepwd">Update</button>
              
          </div>
          <div class="col-3"></div>
        </div>
        @endforeach

<script>
  $('#pwd').on('keyup', function(){
    var check = $('#pwd').val().length;
    console.log(check);
    if (check < 8){
      $('#rpwd').html('Weak password').css('color', 'blue');
    }else{
      $('#rpwd').html('Strong password').css('color', 'green');
    }
  });

  $('#pwd1').on('keyup', function(){
    var pwd = $('#pwd').val();
    var rpwd = $(this).val();
    // if (pwd.length < 8){
    //   $('#rpwd').html('Weak password!').css("color", "yellow");
    // }
    console.log(rpwd);
    if (rpwd != pwd){
      $('#pwd1').css("border", "solid 2px red");
      $('#rpwd').html('Your retyped password is not matched! Re-try!').css("color", "red");
    }else {
      $('#pwd1').css("border", "none");
      $('#rpwd').html('Your password is valid!').css("color", "green");
      $('#changepwd').on('click', function(){
        $('#form_change_pwd').submit();
      })
    }
  })
</script>

@endsection
