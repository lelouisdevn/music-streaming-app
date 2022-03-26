<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Bootstrap plug-in -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    

    <!-- Css - HOMEPAGE -->
    <link rel="stylesheet" href="{{asset('CSS/homepage.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/admin.css')}}">

    <link rel="shortcut icon" href="{{asset('Root-properties/favicon.png')}}" type="image/x-icon">

    <!-- Jquery -->
    <script src="{{asset('JS/jquery-3.6.0.min.js')}}" charset="utf-8"></script>

</head>
<body>
    <div class="container-fluid" style="position: relative;">
        <div class="row" style="background-color: #232528; height: 5em; line-height: 5em;">
            <div class="col-2"></div>
            <div class="col-3" style="font-size: 25px; color: white; font-family: Freemono; font-weight: bold;">
                <img src="{{asset('Root-properties/atlanteans-musique.png')}}" alt="firefox.png" style="width: 50px;">
                Atlanteans
            </div>
            <div class="col-5" style="text-align: right;">
                <ul>
                    <a href="{{url('/admin/logout')}}"><li>Log out</li></a>
                </ul>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row" style="background-color: #004d90;">
            <div class="col-2"></div>
            <div class="col-2 avatar" style="text-align: center; background-color: #004d90;">
                <div class="left">
                    <div class="manager">
                        <a href="{{url('/admin/list-albums')}}"><div></div></a>
                        <a href="{{url('/admin/list-songs')}}"><div></div></a>
                        <a href="{{url('/admin/list-genres')}}"><div></div></a>
                        <a href="{{url('/admin/list-comments')}}"><div></div></a>
                        <a href="{{url('/admin/list-members')}}"><div></div></a>
                    </div>
                </div>
                <div class="right">
                    <div class="manager">
                        <a href="{{url('/admin/list-albums')}}"><div>Album management</div></a>
                        <a href="{{url('/admin/list-songs')}}"><div>Song management</div></a>
                        <a href="{{url('/admin/list-genres')}}"><div>Genre management</div></a>
                        <a href="{{url('/admin/list-comments')}}"><div>Comment management</div></a>
                        <a href="{{url('/admin/list-members')}}"><div>Member management</div></a>
                    </div>
                </div>
            </div>
            <div class="col-6 avatar content-admin" style="background-color: whitesmoke;">

                <!-- CONTENT OF ADMIN PAGE -->
                @yield('content')

            </div>
            <div class="col-2" style="background-color: whitesmoke;"></div>
        </div>
        <div class="row" style="text-align: center; background-color: #232528;">
            <div class="col-12" style="color: white; height: 50px; line-height: 50px;">2022&copy;Atlanteans. Designed by Ngo Tran Vinh Thai.</div>
        </div>
    </div>

</body>
<script type="text/javascript" src="{{asset('JS/ckeditor/ckeditor.js')}}"></script>
<script>
  CKEDITOR.replace('ckeditor');
  CKEDITOR.replace('ckeditor1');

  $('.albumQ:even').css('background-color', 'lightgrey');
</script>
</html>
