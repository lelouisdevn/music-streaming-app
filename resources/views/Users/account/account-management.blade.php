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
          <div class="col-6 formm" style="text-align: center; background-color: white; border-radius: 10px; padding-bottom: 10px;">
            <div style="text-align: center;">
              <img src="{{asset('Uploads/User/'.$user->UserAvt)}}" alt="" width="100px">
            </div>
            <div class="songs" style="text-align: center;">
              Verification completed!
            </div>
            <div style="text-align: center;">
              <a href="{{url('/user/password/change')}}">
                <span class="alert alert-primary">Change Password</span>
              </a>
              <a href="{{url('/user/account/delete')}}" 
              onclick="return confirm('You are going to permanently delete your account! Are you sure you want to do that?')">
                <span class="alert alert-primary">Delete Account</span>
              </a>
            </div>
              
          </div>
          <div class="col-3"></div>
        </div>
        @endforeach

@endsection
