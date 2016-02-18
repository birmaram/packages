<?php
namespace App\Http\Controllers;
namespace images\Album\Contain\http;
use Illuminate\Http\Request;

use App\Http\Requests;
use Config;
use App\User;
use Hash;
use Exception;
use Auth;
use Validator;
use App\Model\Images;
use Input;
use Carbon\Carbon;
//use Illuminate\Http\Request;

class AdminController extends Controller
{

  public function login_view()
  {
      return view('Album::login.contents.login');
  }

    public function authenticate(Request $request){
      $validator    = Validator::make($request->all(),[
        'email'=>'required',
        'password'=>'required'
        ]);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator->erorrs());
      } else {
        $email    = $request->get('email');
        $password   = $request->get('password');

        if(Auth::attempt(['email'=>$email,'password'=>$password,'is_admin'=>true,'is_active'=>true])){
          return redirect(route('image.show.list'));
        } else {
          return redirect()->back()->withErrors(['authfails'=>'Invalid User name password']);
        }
      }
    }


    public function init_admin(){
      $username     = Config::get('services.admin_init.email');
      $password     = Config::get('services.admin_init.password');

      // $user     = User::all();

      //  dd($user);
      // if($user != null){
      //   return 'User Already Exists';
      // }

      $user   =  new User();
      $user->email  = $username;
      $user->password = Hash::make($password);
      $user->is_admin = true;
      $user->is_active = true;

      try {
        $user->save();
        return 'User save succefully';
      } catch (Exception $e) {
        //throw $e;
        return 'User Failed to add';
      }
    }

    // public function user_profile_image(Request $request){
    //   $profile  = Session::get('user');
    //
    //   $validator  =  Validator::make($request->all(),[
    //       'org_image_path'  =>  'required',
    //     ]);
    //   if($validator->fails()){
    //     return json_encode(['status'=>404,'details'=>'Invalid Input']);
    //   } else{
    //
    //
    //     $profile->ngo_image_path  =   $request->input('org_image_path');
    //
    //     try {
    //       $profile->save();
    //     } catch (Exception $e) {
    //       return json_encode(['status'=>500,'details'=>'Something Went wrong']);
    //     }
    //     return json_encode(['status'=>200,'details'=>'Successful']);
    //   }
    // }

    // public function getList()
    //   {
    //     $albums = Album::with('Photos')->get();
    //     return View::make('index')
    //     ->with('albums',$albums);
    //   }
    //   public function getAlbum($id)
    //   {
    //     $album = Album::with('Photos')->find($id);
    //     return View::make('album')
    //     ->with('album',$album);
    //   }
    //   public function getForm()
    //   {
    //     return view('createalbum');
    //   }
    //   public function postCreate()
    //   {
    //     $rules = array(
    //
    //       'name' => 'required',
    //       'cover_image'=>'required|image'
    //
    //     );
    //
    //     $validator = Validator::make(Input::all(), $rules);
    //     if($validator->fails()){
    //
    //       return Redirect::route('create_album_form')
    //       ->withErrors($validator)
    //       ->withInput();
    //     }
    //
    //     $file = Input::file('cover_image');
    //     $random_name = str_random(8);
    //     $destinationPath = 'albums/';
    //     $extension = $file->getClientOriginalExtension();
    //     $filename=$random_name.'_cover.'.$extension;
    //     $uploadSuccess = Input::file('cover_image')
    //     ->move($destinationPath, $filename);
    //     $album = Album::create(array(
    //       'name' => Input::get('name'),
    //       'description' => Input::get('description'),
    //       'cover_image' => $filename,
    //     ));
    //
    //     return Redirect::route('show_album',array('id'=>$album->id));
    //   }
    //
    //   public function getDelete($id)
    //   {
    //     $album = Album::find($id);
    //
    //     $album->delete();
    //
    //     return Redirect::route('index');
    //   }

      public function upload()
      {
        return view('imageupload');
      }

      public function store(Request $request)
	     {
            $image = new Images();
            //$this->validate($request, [
            //'title' => 'required',
            //'image' => 'required'
            //]);

        $validator    = Validator::make($request->all(),[
          'title' => 'required',
          'image' => 'required'
        ]);


        $image->title = $request->title;
        $image->description = $request->description;
		      if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
           $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

            $name = $timestamp. '-' .$file->getClientOriginalName();

            $image->filePath = $name;

            $file->move(public_path().'/images/', $name);
        }
        $image->save();
        //return $this->create()->with('success', 'Image Uploaded Successfully');
        return 'Image Uploaded Successfully';
	     }

       public function show(Request $request)
        {
       $images = Images::all();
       return view('Album::showLists', compact('images'));
      }
}
