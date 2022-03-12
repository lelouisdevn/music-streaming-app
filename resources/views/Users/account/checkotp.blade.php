@extends('play')
@section('playContent')

<div class="row profile" style="height: 170px;">
          <div class="col-10 songs" style="font-size: 35px;">Account</div>
          <div class="col-2 songs" style="font-size: 35px;">
            <div class="fa fa-cog parent" style="margin: 0;">
              <div class="child">
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
              <img src="{{asset('Uploads/User/'.$user->UserAvt)}}" alt="" width="150px">
            </div>
            <div class="songs">
              We need to make sure that you've been authorised to make changes to your account!
              Enter your recieved passcode:
            </div>
            <div>
              <form action="{{url('/user/email/otp/verify')}}" method="POST">
                {{ csrf_field() }}
              <label for="">One-Time Password:</label>
              <input type="password" name="otp" value="" placeholder="Enter received passcode:">
            </div>
            <button class="btn btn-primary">
                Verify
              </form>
            </button>
            <p id="verifying"></p>
          </div>
          <div class="col-3"></div>
          </form>
        </div>
        @endforeach

      <style>
        #verifying {
          text-align: left;
          margin: 10px;
          color: black;
        }
      </style>
      <script>
        $('button').on('click', function(){
          $('#verifying').html('Verifying...');
        })
      </script>
@endsection
