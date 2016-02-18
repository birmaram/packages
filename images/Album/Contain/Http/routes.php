<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/sample', function () {
    return 'hello I am birmaram';
});


Route::get('init',['uses'=>'AdminController@init_admin']);

Route::post('/',['middleware'=>'guest','as'=>'ei.admin.authenticate','uses'=>'AdminController@authenticate']);
Route::get('/login_view',['middleware'=>'guest','as'=>'ei.admin.login','uses'=>'AdminController@login_view']);
//Route::post('/profile/imarge/update',['as'=>'ei.main.user_profile.image.submit','uses'=>'AdminController@user_profile_image']);
//Route::post('/profile/edit',['as'=>'ei.main.ngo_profile.edit.submit','uses'=>'AdminController@ngo_profile_edit']);
// Route::get('/', array('as' => 'index','uses' => 'AlbumsController@getList'));
// Route::get('/createalbum', array('as' => 'create_album_form','uses' => 'AdminController@getForm'));
// Route::post('/createalbum', array('as' => 'create_album','uses' => 'AdminController@postCreate'));
// Route::get('/deletealbum/{id}', array('as' => 'delete_album','uses' => 'AdminController@getDelete'));
// Route::get('/album/{id}', array('as' => 'show_album','uses' => 'AdminController@getAlbum'));
// Route::get('/addimage/{id}', array('as' => 'add_image','uses' => 'ImagesController@getForm'));
// Route::post('/addimage', array('as' => 'add_image_to_album','uses' => 'ImagesController@postAdd'));
// Route::get('/deleteimage/{id}', array('as' => 'delete_image','uses' => 'ImagesController@getDelete'));

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

//Route::get('/imageUploadForm', 'AdminController@upload' );
Route::post('/imageUploadForm', 'AdminController@store' );
//Route::get('/showLists', 'AdminController@show' );
Route::get('/showLists',['as'=>'image.show.list','uses'=>'AdminController@show']);
Route::get('/imageUploadForm',['as'=>'image.add.user','uses'=>'AdminController@upload']);

Route::get('/new', function(){ return redirect('/image'); });
Route::resource('/image', 'ImageController');
