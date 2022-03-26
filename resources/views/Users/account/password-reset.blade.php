@extends('play')
@section('playContent')

<div class="row profile" style="height: 130px;">
          <div class="col-10 songs" style="font-size: 35px;">Account</div>
          <div class="col-2 songs" style="font-size: 35px;">
            <div class="fa fa-cog parent" style="margin: 0; z-index: 1;">
              <div class="child" style="border: black solid 1px;">
                <p><a href="#">Change password</a></p>
                <p><a href="#">Delete account</a></p>
                <p><a href="{{url('/user/logout')}}">Log out</a></p>
              </div>
            </div>
          </div>
        </div>
        @foreach ($user as $key => $user)
        <div class="row profile" style="margin-bottom: 100px;">
          <div class="col-3"></div>
          <div class="col-6 formm" style="text-align: center; background-color: white; border-radius: 10px;">
            <div style="text-align: center;">
              <img src="{{asset('Uploads/User/'.$user->UserAvt)}}" alt="" width="100px" style="border-radius: 50%;">
            </div>
            <div class="songs" style="font-size: 30px;">
              We need to make sure that you've been authorised to make changes to your account!
              Please verify with your email below:
            </div>
            <div>
              <form action="{{url('/user/email/verify')}}" method="POST">
                {{ csrf_field() }}
              <label for="">Email:</label>
              <input type="email" name="email_otp" value="" placeholder="Enter email for verification:">
            </div>
            <button class="btn btn-primary">
                Get OTP
              </form>
            </button>
            <p id="loading"></p>
          </div>
          <div class="col-3"></div>
          </form>
        </div>
        @endforeach

        <style>
          #loading {
            color: black;
            text-align: left;
            margin: 10px;
          }
        </style>
        <script>
          $('button').on('click', function(){
            $('#loading').html('Sending passcode...');
          })
        </script>
@endsection
