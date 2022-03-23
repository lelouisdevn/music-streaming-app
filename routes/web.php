<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Homepage
Route::get('/', 'Homepage@welcome');
Route::get('/play', 'User@play');

//search
Route::get('/search', 'User@search')->name('search');
Route::get('/user/song/search', 'User@searchSong');


//Log in - USER
Route::get('/user/login', 'User@login');
Route::post('/user/login/authenticate', 'User@authenticate');
// Sign up - USER
Route::get('/user/signup', 'User@signup');
Route::post('/user/register', 'User@register');
Route::post('/user/register/complete', 'User@registerComplete');
Route::get('/noti/new-acc', 'User@notiNewAcc');
//Log out
Route::get('/user/logout', 'User@logout');

// ===============================================================================================
//Profile
Route::get('/user/profile', 'User@displayProfile');
Route::post('/user/profile/update', 'User@updateProfile');
Route::get('/user/account', 'User@account');
Route::post('/user/email/verify', 'User@checkEmail');
Route::post('/user/email/otp/verify', 'User@checkOTP');
Route::post('/user/password/reset', 'User@resetPassword');
Route::get('/user/account/delete', 'User@deleteAccount');
Route::get('/user/password/change', 'User@changePassword');

Route::get('/user/forgotPassword', 'User@forgotPassword');
Route::any('/user/pwd/resetwithemail', 'User@resetWithEmailf')->name('resetWithEmail');
// ==============================================================================================


//Admin -login & signup & log out
Route::get('/admin/login', 'admin@login');
Route::post('/admin/login/authenticate', 'admin@authenticate');
Route::get('/admin/logout', 'admin@logout');

//Genre
Route::get('admin/genre/add-new-genre', 'admin@addNewGenre');
Route::post('admin/add-new-genre/submit', 'admin@addNewGenreSubmit');
Route::get('genre-songs/show/{GenreId}', 'User@showGenreSongs');
Route::get('/admin/list-genres', 'admin@listGenres');
Route::get('/admin/genre/edit/{GenreId}', 'admin@editGenre');
Route::post('admin/genre/update', 'admin@updateGenre');

Route::get('/admin/genre/delete/{GenreId}', 'admin@deleteGenre');

// =============================================================================================================
//Album: list + add + details + add songs of album
// edit + update + delete
Route::get('admin/list-albums', 'admin@listAlbums');
Route::get('admin/album/add-new-album', 'admin@addNewAlbum');
Route::post('admin/add-new-album/submit', 'admin@addNnewAlbumSubmit');

Route::get('/admin/album/details/{AlbumId}', 'admin@listAlbumSongs');
Route::get('/admin/song/add-new-song/{AlbumId}', 'admin@addNewSong');
Route::post('admin/add-new-song/submit', 'admin@addSong');
Route::get('/admin/album/edit/{AlbumId}', 'admin@editAlbum');
Route::post('/admin/album/update', 'admin@updateAlbum');
Route::get('/admin/album/delete/{AlbumId}', 'admin@deleteAlbum');

// ===== USER ======
// play songs of the albums, like, remove like, remove Liked albums from Library with AJAX
Route::get('/user/album/play/{AlbumId}', 'User@playAlbum');
Route::any('/user/album/like', 'User@likeAlbum')->name('albumlike');
Route::any('/user/album/removeLike', 'User@removeLikeAlbum')->name('albumrmlike');
Route::any('/user/album/removeLikeLibrary', 'User@removeLikeLibrary')->name('dlike-album-library');

Route::any('/user/playlist/add', 'User@addNewPlaylist')->name('addPlayList');
Route::any('/user/playlist/display', 'User@displayPlaylists')->name('displayplaylists');
// =============================================================================================================


// =============================================================================================================
//Song: list + edit + update
Route::get('/admin/list-songs', 'admin@listSongs');
Route::get('/admin/song/edit/{SongId}', 'admin@editSong');
Route::post('/admin/song/update', 'admin@updateSong');
// Route::any('/user/song/removelike-list', 'User@removeLike1')->name('userdislike1');
// Route::any('/user/song/like-list', 'User@likeSong1')->name('userlike1');

// ==== USER ====
// comment + like + remove like
Route::get('/user/songs/play/{SongId}', 'User@playSong');
Route::any('/user/song/removelike', 'User@removeLike')->name('userdislike');
Route::any('/user/song/like', 'User@likeSong')->name('userlike');
Route::any('/user/song/comment', 'User@submitComment')->name('submitComment');
// =============================================================================================================

//members
Route::get('/admin/list-members', 'admin@listMembers');
Route::get('/admin/member/delete/{UserId}', 'admin@deleteMember');
Route::get('/user/favourite', 'User@favourite');
Route::get('/user/albums', 'User@favouriteAlbum');

//comments
Route::get('/admin/list-comments', 'admin@listComments');
Route::get('/admin/comment/delete/{CommentId}', 'admin@deleteComment');


//likeSong
Route::any('/user/likedSong/removeLike', 'User@removeLikedSong')->name('dlike-likelist');
Route::any('/user/likedSong/likeLikedSong', 'User@likeLikedSong')->name('like-likelist');
