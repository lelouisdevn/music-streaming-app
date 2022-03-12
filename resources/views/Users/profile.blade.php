@extends('play')
@section('playContent')

<div class="row profile" style="height: 170px;">
          <div class="col-10 songs" style="font-size: 35px;">Profile</div>
          <div class="col-2 songs" style="font-size: 35px;">
            <div class="fa fa-cog parent" style="margin: 0;">
              <div class="child">
                <p><a href="{{url('/user/account/')}}">Change password</a></p>
                <p><a href="{{url('/user/account/')}}">Delete account</a></p>
                <p><a href="{{url('/user/logout')}}">Log out</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row profile" style="margin-bottom: 100px;">
          <div class="col-3"></div>
          <div class="col-6 formm" style="text-align: center; background-color: whitesmoke; border-radius: 10px; padding-bottom: 10px;">
            <div style="text-align: center;">
              <form action="{{url('/user/profile/update')}}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
              @foreach ($user as $key => $u)

              <img id="fdialog" src="{{asset('Uploads/User/'.$u->UserAvt)}}" 
              alt="" width="150px" height="150px">

            </div>

            <div class="">
              <!-- <label for="">Update your profile picture:</label> -->
              <input id="file" type="file" name="fileavt" value="" style="display: none">
            </div>
            <div>
              <label for="" style="color: black">Email:</label>
              <input type="email" value="{{$u->UserEmail}}" disabled>
            </div>
            <div>
              <label for="" style="color: black">Name:</label>
              <input type="text" name="name" value="{{$u->UserName}}">
            </div>
            <!-- <div>
              <label for="">Date of birth:</label>
              <input type="text" name="dob" value="{{$u->UserDOB}}">
            </div> -->
            <div class="container-signup-profile">
                        <div class="left-profile">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px; color: black; font-weight: bold;">Day</p>
                            <select name="day" id="">
                                <script language="javascript" type="text/javascript">
                                    for (var d = 1; d <= 31; d++) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                        <div class="left-profile">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px; color: black; font-weight: bold;">Month</p>
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
                        <div class="left-profile">
                            <p style="text-align: left; font-size: 18px; margin-bottom: 5px; color: black; font-weight: bold;">Year</p>
                            <select name="year" required>
                                <script>
                                    for (var d = 2022; d >= 1950; d--) {
                                        document.write("<option>" + d + "</option>");
                                    }
                                </script>
                            </select>
                        </div>
                    </div>
            @endforeach
              <button class="btn btn-primary">Update</button>

            </form>
          </div>
          <div class="col-3"></div>
        </div>

        <style>
          #fdialog:hover {
            /* background-image: url('Root-properties/camera.png'); */
            width: 300px;
            border-radius: 0;
            height: 300px;
            transition: 400ms;
          }

          #fdialog{
            width: 150px;
            height: 150px;
            transition: 400ms;
          }
        </style>
        <script>
          $('#fdialog').on('click', ()=>{
            $('#file').trigger('click');
          })

          $('#file').change(()=>{
            $('button').trigger('click');
          })
        </script>
@endsection
