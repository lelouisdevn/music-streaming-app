<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Mail;
use Session;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Manager\SubscriptionManager;
use Illuminate\Support\Facades\Redirect;

session_start();
class User extends Controller
{
    //Check login or not
    public function AuthLogin(){
        $UserId = Session::get('UserId');
        if ($UserId){
            return redirect::to('/');
        }else {
            return redirect::to('/user/login')->send();
        }
    }

    //Log in form
    public function login(){
        return view('Users.user-login');
    }
    public function authenticate(Request $request){
      sleep(2);
        $email = $request->email;
        $password = $request->password;

        $hasExistedAccount = DB::table('user')->where('UserEmail', $email)->first();
        $result = DB::table('user')->where('UserPassword', $password)->where('UserEmail', $email)->first();
        if ($hasExistedAccount){
          if($result){
            Session::put('UserName', $result->UserName);
            Session::put('UserId', $result->UserId);

            return redirect::to('/play');
          }else {
            echo "<script>alert('Wrong password or username!')</script>";
            return view('Users.user-login');
        }
        }else {
          echo "<script>alert('This account does not exist!')</script>";
          return view('Users.user-login');
        }

    }

    //Sign up form
    public function signup(){
        return view('Users.user-signup');
    }
    public function register(Request $request){
        $data = array();

        $email = DB::table('user')->where('UserEmail', $request->useremail)->first();
        if (!$email){
          $OTP = rand(10000,99999);
          $data['SUserName'] = $request->username;
          $data['SEmail'] = $request->useremail;
          $data['SPassword'] = $request->userpassword;
          $data['SDOB'] = $request->day.".".$request->month.".".$request->year;
          $data['SOTP'] = $OTP;
        // $data['UserJoinTime'] = Carbon::now()->format('d-m-Y');
        // $data['UserAvt'] = "user1.png";

          $UserId = DB::table('signup')->insertGetId($data);

        // Session::put('UserId', $UserId);
        // Session::put('UserName', $request->UserName);

        // send otp to verify email

          $email = $request->useremail;
          $username = $request->username;
          $datamail = array('OTP'=>$OTP);
          Mail::send('Users.signup.mailverification', $datamail, function($message) use($email, $username){
            $message->to($email, $username)->subject('Verification for new account!');
            $message->from('atlanteansvietnam@outlook.com', 'Atlanteans');
          });
          Session::put('SId', $UserId);
          return view('Users.signup.account-verification');
        }else{
          echo "<script>alert('This email has already existed, please try another one!')</script>";
          return view('Users.user-signup');
        }

    }
    public function registerComplete(Request $request){
      sleep(2);
      $otp = $request->signupotp;
      $SId = Session::get('SId');
      $data = DB::table('signup')->where('SId', $SId)->first();
      if ($otp == $data->SOTP){
        $database = array();
        $database['UserName'] = $data->SUserName;
        $database['UserEmail'] = $data->SEmail;
        $database['UserPassword'] = $data->SPassword;
        $database['UserDOB'] = $data->SDOB;
        $database['UserJoinTime'] = Carbon::now()->format('d-m-Y');
        $database['UserAvt'] = "user1.png";

        $UserId = DB::table('user')->insertGetId($database);

        $signup = array();
        $signup['SOTP'] = null;
        DB::table('signup')->where('SId', $SId)->update($signup);

        Session::put('SId', 'null');
        Session::put('UserId', $UserId);
        Session::put('UserName', $data->SUserName);

        return redirect::to('/noti/new-acc');
      }else{
        echo "<script>alert('Invalid OTP')</script>";
        return view('Users.signup.account-verification');
      }
    }
    public function notiNewAcc(){
      echo "<script>setTimeout(function(){ window.location.href = '/play'; }, 3000);</script>";
      return view('Users.signup.noti-new-acc');
    }

    public function play(){
        sleep(2);
        $this->AuthLogin();
        $genre = DB::table('genre')->get();
        $UserId = Session::get('UserId');

        //get an array of json objects
        //gia lap mang json
        //tao mang
        //tao doi tuong json
        // encode mang -> mang json
        $Song1 = DB::table('stream')->join('song', 'stream.SongId', '=', 'song.SongId')
        ->join('user', 'stream.UserId', '=', 'user.UserId')
        ->where('stream.UserId', $UserId)
        ->orderby('stream.StreamDate', 'asc')->get();

        //echo $Song1;
        $Song = array();
        $count = 0;
        foreach ($Song1 as $key => $s) {
          # code...
          $date = $s->StreamDate;
          $now = Carbon::now()->format('d/m/Y');


          $date_day = intval(substr($date, 0, 2));
          $now_day = intval(substr($now, 0, 2));

          $date_month = intval(substr($date, 3, 2));
          $now_month = intval(substr($now, 3, 2));

          //$songArr = array();

          if ($count < 12){
            $js1 = array();
            $js1['SongId'] = $s->SongId;
            $js1['UserId'] = $s->UserId;
            $js1['SongName'] = $s->SongName;
            $js1['SongCover'] = $s->SongCover;
            array_push($Song, $js1);

            $count ++;
          }



          if ($now_month - $date_month > 0){
            $month1 = ($now_month - $date_month ) * 30;

            if ($now_day > $date_day){
              $d1 = $month1 + ($now_day - $date_day);
              if ($d1 >= 0  && $d1 <=15){
                // $js1 = array();
                // $js1['SongId'] = $s->SongId;
                // $js1['UserId'] = $s->UserId;
                // $js1['SongName'] = $s->SongName;
                // $js1['SongCover'] = $s->SongCover;
                // array_push($Song, $js1);
              }

            }else if ($now_day < $date_day){
              if ((30 - $date_day + $now_day) >= 0 && (30 - $date_day + $now_day) <=15){
                // $js1 = array();
                // $js1['SongId'] = $s->SongId;
                // $js1['UserId'] = $s->UserId;
                // $js1['SongName'] = $s->SongName;
                // $js1['SongCover'] = $s->SongCover;
                // array_push($Song, $js1);
              }
            }
          }else if ($now_month - $date_month == 0 && $now_day - $date_day <= 15 && $now_day - $date_day >=0) {
            //echo $now_day - $date_day;
            // $js1 = array();
            // $js1['SongId'] = $s->SongId;
            // $js1['UserId'] = $s->UserId;
            // $js1['SongName'] = $s->SongName;
            // $js1['SongCover'] = $s->SongCover;
            // array_push($Song, $js1);
          }
        }

        $Song = json_encode($Song);
        //echo $Song;

        $user = DB::table('user')->where('UserId', $UserId)->select('Username')->get();

        //Album user streams to display in currently played.
        $album = DB::table('album_stream')
        ->join('album', 'album_stream.AlbumId', '=', 'album.AlbumId')
        ->where('album_stream.UserId', $UserId)
        ->orderby('album_stream.AStreamNumber','desc')
        ->limit('5')->get();

        return view('play-content')->with('genre', $genre)->with('Song', $Song)->with('user', $user)
        ->with('album', $album);
    }

    public function playSong($SongId){
      sleep(2);
      $UserId = Session::get('UserId');

      $result = DB::table('stream')->where('UserId', $UserId)->where('SongId', $SongId)->first();
      if ($result){
        $stream = $result->StreamNumber;
        $increaseStream = $stream + 1;

        $data = array();
        $data['StreamNumber'] = $increaseStream;
        $data['StreamDate'] = Carbon::now()->format('d/m/Y');
        DB::table('stream')->where('UserId', $UserId)->where('SongId', $SongId)->update($data);
      }else {
        $data1 = array();
        $data1['UserId'] = $UserId;
        $data1['SongId'] = $SongId;
        $data1['StreamNumber'] = 1;
        //$data1['StreamDate'] = Carbon::now()->format('d/m/Y');
        DB::table('stream')->insert($data1);
      }

      $SongStream = DB::table('song')->where('SongId', $SongId)->first();
      $dt = array();
      $dt['SongStream'] = $SongStream->SongStream + 1;
      DB::table('song')->where('SongId', $SongId)->update($dt);

      $comment = DB::table('comment')->join('user', 'user.UserId', '=', 'comment.UserId')
      ->where('comment.SongId', $SongId)->get();

      $song = DB::table('song')->join('album', 'song.AlbumId', '=', 'album.AlbumId')->where('SongId', $SongId)->get();

      return view('song-play')->with('song', $song)->with('comment', $comment);
    }
    public function search(Request $request){
      $value = $request->get('value');
      if ($value){
        $data = DB::table('song')
        ->select('SongId', 'SongName')
        ->where('SongName', 'LIKE', "%{$value}%")
        ->orderBy('SongStream', 'desc')
        ->get();

        //echo $data;


        $output = '<ul style="background-color: white;
         display: block; position: relative; z-index: 1; padding: 0">';
        foreach ($data as $key => $d) {
          // code...
          $output .='
              <style>
                li {
                  padding-left: 5px;
                }
                li:hover {
                  background-color: whitesmoke;
                }
              </style>
              <li style="color: black; list-style-type: none;
              height: 50px; line-height: 50px;
              overflow: hidden; cursor: pointer;
              ">'.$d->SongName.'</li>
          ';
        }
        $output .= '</ul>';
        echo $output;
      }
    }
    public function searchSong(Request $request){
      $keyword = $request->keyword;

      $Song = DB::table('song')
      ->join('album', 'song.AlbumId', '=', 'album.AlbumId')
      ->where('song.SongName', 'like', '%'.$keyword.'%')
      ->get();

      $album = DB::table('album')
      ->where('AlbumName', 'like', '%'.$keyword.'%')
      ->get();
      // Session::put('keyword', $value);
      return view('Users.search-result')->with('Song', $Song)->with('keyword', $keyword)->with('album', $album);
    }

    public function likeSong(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      $data = array();
      $data['UserId'] = $UserId;
      $data['SongId'] = $query;
      DB::table('likes')->insert($data);

      $output = '<button class="fa fa-heart" style="background: none; color: white; font-size: 28px; border: none;" id="dsong" type="button" name="button"></button>';
      echo $output;
    }

    public function removeLike(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      DB::table('likes')->where('SongId', $query)->where('UserId', $UserId)->delete();

      $output = '<button class="fa fa-heart-o" style="background: none; color: white; font-size: 28px; border: none;" id="lsong" type="button" name="button"></button>';
      echo $output;
    }
    public function likeAlbum(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      $data = array();
      $data['UserId'] = $UserId;
      $data['AlbumId'] = $query;
      DB::table('album_likes')->insert($data);

      $output = '<button class="fa fa-heart" style="background: none; color: white; font-size: 25px; border: none;" id="dsong" type="button" name="button"></button>';
      echo $output;
    }

    public function removeLikeAlbum(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      DB::table('album_likes')->where('AlbumId', $query)->where('UserId', $UserId)->delete();

      $output = '<button class="fa fa-heart-o" style="background: none; color: white; font-size: 25px; border: none;" id="lsong" type="button" name="button"></button>';
      echo $output;
    }

    public function likeSong1(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      $data = array();
      $data['UserId'] = $UserId;
      $data['SongId'] = $query;
      DB::table('likes')->insert($data);

      $output = '<button class="fa fa-heart" style="background: none; color: green; font-size: 20px; border: none;" id="dsong" type="button" name="button"></button>';
      echo $output;
    }

    public function removeLike1(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');

      DB::table('likes')->where('SongId', $query)->where('UserId', $UserId)->delete();

      $output = '<button class="fa fa-heart-o" style="background: none; color: green; font-size: 20px; border: none;" id="lsong" type="button" name="button"></button>';
      echo $output;
    }

    public function submitComment(Request $request){
      $UserId = Session::get('UserId');
      $query = $request->get('query');
      $song = $request->get('song');
      $data = array();
      $data['UserId'] = $UserId;
      $data['SongId'] = $song;
      $data['CommentContent'] = $query;
      $data['CommentTime'] = Carbon::now()->format('H:i d/m/Y');
      $id = DB::table('comment')->insertGetId($data);

      $result = DB::table('comment')
      ->join('user', 'comment.UserId', '=', 'user.UserId')
      ->where('comment.CommentId', $id)->get();

      sleep(2);

      $output = '';
      foreach ($result as $key => $r) {
      $output .= '<div class="row media-audio lyrics" style="width: 93%; margin-top: 20px;">
        <div class="col-3" style="text-align: center; margin: auto 0;">
          <img src="'.url('Uploads/User/'.$r->UserAvt).'" alt="" width="100px;" style="border-radius:50%;">
        </div>
        <div class="col-9">
          <div class="row" style="border-bottom: solid 1px grey; font-size: 20px;">
            <div class="col-6">
              '.$r->UserName.'
            </div>
            <div class="col-6" style="text-align: right; font-size: 15px;">
              '.$r->CommentTime.'
            </div>
          </div>
          <div class="row" style="margin-top: 20px; text-align: justify; padding: 0 30px 0 15px;">
            '.$r->CommentContent.'
          </div>
        </div>
      </div>';
    }
      echo $output;
    }
    public function account(){
      $UserId = Session::get('UserId');
      $user = DB::table('user')->where('UserId', $UserId)->get();
      return view('Users.account.password-reset')->with('user', $user);
    }

    public function checkEmail(Request $request){
      $data = array();
      $email = $request->email_otp;
      $UserId = Session::get('UserId');
      $user = DB::table('user')->where('UserId', $UserId)->get();

      $result = DB::table('user')->where('UserId', $UserId)->first();
      $UserName =$result->UserName;
      $UserEmail = $result->UserEmail;
      if ($result->UserEmail == $email){
        $OTP = rand(10000,99999);
        // $data['UserOTP'] = $OTP;
        // DB::table('user')->where('UserId', $UserId)->update($data);
        Session::put('OTP', $OTP);
        $dataMail = array('name'=>$UserName, 'OTP'=>$OTP);
        Mail::send('Users.account.mail-send-otp', $dataMail, function($message)
        use($email, $UserName){
          $message->to($email, $UserName)->subject('Account verification!');
          $message->from('atlanteansvietnam@outlook.com', 'Atlanteans');
        });
        return view('Users.account.checkotp')->with('user', $user);
      }else {
        echo "<script>alert('This email is invalid!')</script>";
        return view('Users.account.password-reset')->with('user', $user);
      }
    }
    public function checkOTP(Request $request){

      sleep(2);

      $OTP = $request->otp;
      $ui = Session::get('UserId');
      $user = DB::table('user')->where('UserId', $ui)->get();

      // $result = DB::table('user')->where('UserId', $ui)->first();
      $saved_otp = Session::get('OTP');
      // if($result->UserOTP == $OTP){
        if ($saved_otp == $OTP){
        // $data = array();
        // $data['UserOTP'] = null;
        Session::put('temp', 'okay');
        // DB::table('user')->where('UserId', $ui)->update($data);
        Session::put('OTP', null);
        return view('Users.account.account-management')->with('user', $user);
      }else {
        echo "<script>alert('Invalid OTP, please try again!')</script>";
        return view('Users.account.checkotp')->with('user', $user);
      }
    }
    public function changePassword(){
      $UserId = Session::get('UserId');
      if (Session::get('temp')){
        $user = DB::table('user')->where('UserId', $UserId)->get();
        return view('Users.account.new-password')->with('user', $user);
      }else {
        return redirect::to('/play');
      }
    }
    public function resetPassword(Request $request){
      $data = array();
      $data['UserPassword'] = $request->passwd;

      DB::table('user')->where('UserId', Session::get('UserId'))->update($data);
      $user = DB::table('user')->where('UserId', Session::get('UserId'))->get();
      Session::put('temp', null);
      echo '<script>alert("Password updated succesfully")</script>';
      return view('Users.profile')->with('user', $user);
    }

    public function forgotPassword(){
      return view('Users.account.password.forgotpassword');
    }

    public function resetWithEmailf(Request $request){
      sleep(2);
      $email = $request->get('email');

      if (str_contains($email, '@') == true){
        $userData = DB::table('user')
        ->where('UserEmail', $email)->first();

        Session::put('userid', $userData->UserId);
      }
      if (Session::get('userid') != NULL && str_contains($email, '@') == true){
        $OTP = rand(10000, 99999);

        $nData = array();
        $nData['UserOTP'] = $OTP;

        DB::table('user')->where('UserId', Session::get('userid'))
        ->update($nData);

        $UserName = $userData->UserName;
        $dataMail = array('OTP'=>$OTP);
        Mail::send('Users.account.password.otp', $dataMail, function($message)
        use($email, $UserName){
          $message->to($email, $UserName)->subject('Reset password request!');
          $message->from('atlanteansvietnam@outlook.com', 'Atlanteans');
        });

      }else if(Session::get('status') == NULL && Session::get('userid') != NULL && str_contains($email, '@') == false && strlen($email) > 0) {
        $UserId = Session::get('userid');
        $OTP = DB::table('user')
        ->where('UserId', $UserId)->first();

        if ($email == $OTP->UserOTP){
          $dt = array();
          $dt['UserOTP'] = NULL;
          DB::table('user')->where('UserId', $UserId)->update($dt);

          Session::put('status', 1);
        }else {
          echo "<p style='margin: 0'>Unmatched OTP!</p>";
        }
      }
      else if (Session::get('status') == 1){
        $dt = array();
        $dt['UserPassword'] = $email;
        DB::table('user')->where('UserId', Session::get('userid'))->update($dt);

        Session::put('UserId', Session::get('userid'));
        $username = DB::table('user')->where('UserId', Session::get('UserId'))->first();

        Session::put('UserName', $username->UserName);
        Session::put('userid', '');
        Session::put('status', NULL);

        echo "Reset password successfully!";
      }
    }

    //add new playlist
    public function addNewPlaylist(Request $request){
      sleep(1);
      $playlistname = $request->get('query');
      $check = DB::table('playlist')->where('PlayName', $playlistname)->first();
      if (!$check){
        $UserId = Session::get('UserId');
        $data = array();
        $data['PlayName'] = $playlistname;
        $data['UserId'] = $UserId;

        $plid = DB::table('playlist')->insertGetId($data);

        echo
        "<div style='display: block'>
          <span>
          <a href='/user/playlist/$plid'>".$playlistname."</a>
          </span>
          <span style='float: right;'>
            <i class='fa fa-trash'></i>
          </span>
        </div>";

      }else {
        echo "Existed playlist!";
      }
    }

    public function displayPlaylists(Request $request){
      $UserId = Session::get('UserId');

      $data = DB::table('playlist')->where('UserId', $UserId)->get();

      $output = '<div id="playlistsongs" style="position: absolute; background-color: white; border-radius: 5px; padding: 5px; z-index: 2; border: solid black 1px; text-align: left;">';
      foreach ($data as $key => $value) {
          $output .= '
            <a class="plists" 
            style="display: block; color: black; font-size: 20px;">
            '.$value->PlayName.'
            </a>
          ';
      }

      $output .= '</div>';
      echo $output;
    }

    public function showGenreSongs($GenreId){
      $songs = DB::table('album')
      ->join('song', 'album.AlbumId', '=', 'song.AlbumId')
      ->where('album.GenreId', $GenreId)->orderby('song.SongStream', 'desc')->get();

      $genre = DB::table('genre')->where('GenreId', $GenreId)->get();
      return view('genre-songs')->with('songs', $songs)->with('Genre', $genre);
    }
    public function playAlbum($AlbumId){
      $song = DB::table('song')->where('AlbumId', $AlbumId)->get();
      $album = DB::table('album')->where('AlbumId', $AlbumId)->get();

      $UserId = Session::get('UserId');
      $result = DB::table('album_stream')->where('UserId', $UserId)->where('AlbumId', $AlbumId)->first();
      if ($result){
        $stream = $result->AStreamNumber + 1;
        $data = array();
        $data['AStreamNumber'] = $stream;
        DB::table('album_stream')->where('UserId', $UserId)->where('AlbumId', $AlbumId)->update($data);
      }else {
        $data = array();
        $data['UserId'] = $UserId;
        $data['AlbumId'] = $AlbumId;
        $data['AStreamNumber'] = 1;
        DB::table('album_stream')->insert($data);
      }
      return view('album-play')->with('song', $song)->with('album', $album);
    }
    public function favourite(){
      $UserId = Session::get('UserId');
      $song = DB::table('likes')->join('song', 'likes.SongId', '=', 'song.songId')
      ->where('UserId', $UserId)->get();
      return view('Users.liked-songs')->with('songs', $song);
    }

    public function displayProfile(){
      $UserId = Session::get('UserId');
      $user = DB::table('user')->where('UserId', $UserId)->get();
      return view('Users.profile')->with('user', $user);
    }

    public function updateProfile(Request $r){
      $UserId = Session::get('UserId');
      $data = array();
      $data['UserName'] = $r->name;
      $data['UserDOB'] = $r->day."/".$r->month."/".$r->year;
      //$data['SDOB'] = $request->day.".".$request->month.".".$request->year;

      // $avt = $r->file('file-avt');
      // if ($avt){
      //   $filename = $avt->getClientOriginalName();
      //   $trim = current(explode('.', $filename));
      //   $extension = $avt->getClientOriginalExtension();
      //   $newAvt = $trim.rand(0, 99).'.'.$extension;
      //   $avt->move('Uploads/User', $newAvt);
      //   $data['UserAvt'] = $newAvt;
      // }

      $genreFile = $r->file('fileavt');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/User', $newImage);

        $data['UserAvt'] = $newImage;
      }
      DB::table('user')->where('UserId', $UserId)->update($data);
      echo "<script>alert('Information updated succesfully!')</script>";
      $user = DB::table('user')->where('UserId', $UserId)->get();
      return view('Users.profile')->with('user', $user);
    }

    // Like the song you just remove like from favourites
    public function removeLikedSong(Request $request){
      $UserId = Session::get('UserId');
      $SongId = $request->get('query');

      $check = DB::table('likes')->where('UserId', $UserId)->where('SongId', $SongId)->first();
      if ($check){
        DB::table('likes')->where('SongId', $SongId)->where('UserId', $UserId)->delete();
      }else {
        $data = array();
        $data['SongId'] = $SongId;
        $data['UserId'] = $UserId;
        DB::table('likes')->insert($data);
      }

    }
    // remove like from albums you liked
    public function removeLikeLibrary(Request $request){
      $query = $request->get('query');
      $UserId = Session::get('UserId');

      DB::table('album_likes')->where('UserId', $UserId)->where('AlbumId', $query)->delete();

    }
    public function likeLikedSong(Request $request){
      $UserId = Session::get('UserId');
      $SongId = $request->get('query');
      $data = array();
      $data['UserId'] = $UserId;
      $data['SongId'] = $SongId;
      DB::table('likes')->insert($data);

    }
    public function deleteAccount(){
      $UserId = Session::get('UserId');
      DB::table('user')->where('UserId', $UserId)->delete();
      Session::put('UserId', null);
      Session::put('UserName', null);
      return redirect::to('/');
    }
    public function favouriteAlbum(){
      $UserId = Session::get('UserId');
      $album = DB::table('album_likes')
      ->join('album', 'album.AlbumId', '=', 'album_likes.AlbumId')
      ->where('UserId', $UserId)->get();
      return view('Users.liked-albums')->with('album', $album);
    }
    //Log out
    public function logout(){
        Session::put('UserName', null);
        Session::put('UserId', null);

        return redirect::to('/');
    }
}
