<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Manager\SubscriptionManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

session_start();
class admin extends Controller
{
    // Verify if admin logged in or not.
    public function AuthLogin(){
      $AdminId = Session::get('AdminId');
      if ($AdminId){
          return redirect::to('/admin/list-albums');
      }else {
          return redirect::to('/admin/login')->send();
      }
    }

    public function login(){
      return view('Admin.admin-login');
    }

    public function authenticate(Request $request){
      $email = $request->email;
      $password = $request->password;

      $result = DB::table('administrator')->where('AdminEmail', $email)->where('AdminPassword', $password)->first();

      if ($result){
        Session::put('AdminName', $result->AdminName);
        Session::put('AdminId', $result->AdminId);
        $album = DB::table('album')->join('genre', 'album.GenreId', '=', 'genre.GenreId')->get();
        return view('Admin.Album.album-list')->with('album', $album);
      }else {
        echo '<script>alert("Wrong email or password!")</script>';
        return view('Admin.admin-login');
      }
    }

    //Display list of genres out to admin page
    public function listGenres(){
        $genre = DB::table('genre')->get();
        return view('Admin.Genre.genre-list')->with('genre', $genre);
    }

    public function addNewGenre(){
      return view('Admin.Genre.add-new-genre');
    }

    //Add new genre
    public function addNewGenreSubmit(Request $request){
      $data = array();

      $data['GenreName'] = $request->genreName;
      $data['GenreDescription'] = $request->genreDescription;

      $genreFile = $request->file('genreFile');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Images', $newImage);

        $data['GenreCover'] = $newImage;
      }

      DB::table('genre')->insert($data);
      Session::put('Messgae', 'Genre added successfully!');
      return redirect::to('/admin/list-genres');
    }

    public function listAlbums(){
      $album = DB::table('album')->join('genre', 'album.GenreId', '=', 'genre.GenreId')->paginate('5');
      return view('Admin.Album.album-list')->with('album', $album);
    }

    public function addNewAlbum(){
      $this->AuthLogin();
      $genre = DB::table('genre')->get();
      return view('Admin.Album.add-new-album')->with('genre', $genre);
    }
    public function addNnewAlbumSubmit(Request $request){
      $data = array();
      $data['AlbumName'] = $request->albumName;
      $data['AlbumDescription'] = $request->albumDescription;
      $data['AlbumArtist'] = $request->albumArtist;
      $data['GenreId'] = $request->genre;

      $genreFile = $request->file('genreFile');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Images', $newImage);

        $data['AlbumCover'] = $newImage;
        DB::table('album')->insert($data);
        Session::put('Messgae', 'Genre added successfully!');
        return view('Admin.dashboard');
      }
    }

    public function listSongs(){
      $songs = DB::table('song')->paginate('5');
      return view('Admin.Song.song-list-private')->with('songs', $songs);
    }

    public function listAlbumSongs($AlbumId){
      $Album = DB::table('album')->where('AlbumId', $AlbumId)->get();
      $songs = DB::table('album')->join('song', 'album.AlbumId', '=', 'song.AlbumId')->where('song.AlbumId', $AlbumId)->get();

      return view('Admin.Song.song-list')->with('Album', $Album)->with('songs',$songs);
    }
    public function addNewSong($AlbumId){
      $Album = DB::table('album')->where('AlbumId', $AlbumId)->get();
      return view('Admin.Song.add-new-song')->with('Album', $Album);
    }
    public function addSong(Request $request){
      $data = array();
      $data['AlbumId'] = $request->albumId;
      $data['SongName'] = $request->songName;
      $data['SongArtist'] = $request->albumArtist;
      $data['SongLyrics'] = $request->songLyrics;
      $data['SongCover'] = $request->songCover;
      $data['SongStream'] = 0;

      $genreFile = $request->file('songSource');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Musics', $newImage);

        $data['SongSource'] = $newImage;
        DB::table('song')->insert($data);
        Session::put('Messgae', 'Song added successfully!');
        return redirect::to('/admin/album/details/'.$request->albumId);
      }
    }

    public function listMembers(){
      $members = DB::table('user')->get();
      return view('Admin.Member.member-list')->with('members', $members);
    }
    public function editGenre($GenreId){
      $info = DB::table('genre')->where('GenreId', $GenreId)->get();
      return view('Admin.Genre.genre-edit')->with('genre', $info);
    }
    public function updateGenre(Request $request){
      $data = array();

      $data['GenreName'] = $request->genreName;
      $data['GenreDescription'] = $request->genreDescription;

      $genreFile = $request->file('genreFile');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Images', $newImage);

        $data['GenreCover'] = $newImage;
      }

      $GenreId = $request->GenreId;
      DB::table('genre')->where('GenreId', $GenreId)->update($data);
      Session::put('Messgae', 'Genre updated successfully!');
      return redirect::to('/admin/list-genres');
    }

    public function editSong($SongId){
      $info = DB::table('song')->join('album', 'song.AlbumId', '=', 'album.AlbumId')->where('song.SongId', $SongId)->get();
      return view('Admin.Song.song-edit')->with('Song', $info);
    }

    public function updateSong(Request $request){
      $data = array();
      // $data['AlbumId'] = $request->albumId;
      $data['SongName'] = $request->songName;
      $data['SongArtist'] = $request->albumArtist;
      $data['SongLyrics'] = $request->songLyrics;
      // $data['SongCover'] = $request->songCover;
      // $data['SongStream'] = 0;
      $SongId = $request->SongId;
      $AlbumId = $request->AlbumId;
      $genreFile = $request->file('songSource');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Musics', $newImage);

        $data['SongSource'] = $newImage;
        DB::table('song')->where('SongId', $SongId)->update($data);
        Session::put('Messgae', 'Song updated successfully!');
        return redirect::to('/admin/album/details/'.$SongId);
      }
      else {
        DB::table('song')->where('SongId', $SongId)->update($data);
        return redirect::to('/admin/album/details/'.$AlbumId);
      }
    }
    public function editAlbum($AlbumId){
      $Album = DB::table('album')->join('genre', 'album.GenreId', '=', 'genre.GenreId')->where('album.AlbumId', $AlbumId)->get();
      $genres = DB::table('genre')->get();
      return view('Admin.Album.album-edit')->with('Album', $Album)->with('genre', $genres);
    }
    public function updateAlbum(Request $request){
      $data = array();
      // $data['AlbumId'] = $request->albumId;
      $data['AlbumId'] = $request->AlbumId;
      $data['AlbumName'] = $request->albumName;
      $data['AlbumDescription'] = $request->albumDescription;
      $data['AlbumArtist'] = $request->albumArtist;
      $data['GenreId'] = $request->genre;
      // $data['SongCover'] = $request->songCover;
      // $data['SongStream'] = 0;

      $genreFile = $request->file('genreFile');
      if ($genreFile){
        $filename = $genreFile->getClientOriginalName();
        $trim = current(explode('.', $filename));
        $extension = $genreFile->getClientOriginalExtension();
        $newImage = $trim.rand(0, 99).'.'.$extension;
        $genreFile->move('Uploads/Images', $newImage);

        $data['AlbumCover'] = $newImage;
        DB::table('album')->where('AlbumId', $request->AlbumId)->update($data);
        $sdata = array();
        $sdata['SongCover'] = $newImage;
        DB::table('song')->where('AlbumId', $request->AlbumId)->update($sdata);
        Session::put('Messgae', 'Song updated successfully!');
        return redirect::to('/admin/list-albums');
      }
      else {
        DB::table('album')->where('AlbumId', $request->AlbumId)->update($data);
        return redirect::to('/admin/list-albums');
      }
    }
    public function deleteMember($UserId){
      DB::table('user')->where('UserId', $UserId)->delete();

      return redirect::to('/admin/list-members');
    }

    public function deleteGenre($GenreId){
      DB::table('genre')->where('GenreId', $GenreId)->delete();
      return redirect::to('admin/list-genres');
    }
    public function listComments(){
      $comment = DB::table('comment')
      ->join('user', 'comment.UserId', '=', 'user.UserId')->paginate('10');
      return view('Admin.Comment.comment-list')->with('comment', $comment);
    }
    public function deleteAlbum($AlbumId){
      DB::table('album')->where('AlbumId', $AlbumId)->delete();
    }
    public function deleteComment($CommentId){
      DB::table('comment')->where('CommentId', $CommentId)->delete();
      echo '<script>alert("Delete comment successfully!")</script>';
      $comment = DB::table('comment')
      ->join('user', 'comment.UserId', '=', 'user.UserId')->get();
      return view('Admin.Comment.comment-list')->with('comment', $comment);
    }
    public function logout(){
      Session::put('AdminName', null);
      Session::put('AdminId', null);
      return redirect::to('/admin/login');
    }
}
