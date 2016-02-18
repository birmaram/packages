<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Config;
use App\User;
use Hash;
use Exception;
use Auth;
use Validator;
use App\Model\Album;
use Input;
use Carbon\Carbon;


class ImageController extends Controller {

  /* 1. This method relates to the "images list" view */
        public function index()
        {
           $images = Album::paginate(10);
           return view('Album.images-list')->with('images', $images);
        }

  /* 2. This method relates to the "add new image" view */
        public function create()
        {
           return view('Album.add-new-image');
        }

  /* 3. This method relates to the "image detail" view */
        public function show($id)
        {
           $image = Album::find($id);
           return view('Album.image-detail')->with('image', $image);
        }

  /* 4. This method relates to the "edit image" view */
        public function edit($id)
        {
           $image = Album::find($id);
           return view('Album.edit-image')->with('image', $image);
        }

    public function store(Request $request)
   {
      // Validation //
      $validation = Validator::make($request->all(), [
         'caption'     => 'required|regex:/^[A-Za-z ]+$/',
         'description' => 'required',
         'userfile'     => 'required|image|mimes:jpeg,png|min:1|max:250'
      ]);

      // Check if it fails //
      if( $validation->fails() ){
         return redirect()->back()->withInput()
                          ->with('errors', $validation->errors() );
      }

      $image = new Album;

      // upload the image //
      $file = $request->file('userfile');
      $destination_path = 'uploads/';
      $filename = str_random(6).'_'.$file->getClientOriginalName();
      $file->move($destination_path, $filename);

      // save image data into database //
      $image->file = $destination_path . $filename;
      $image->caption = $request->input('caption');
      $image->description = $request->input('description');
      $image->save();

      return redirect('/')->with('message','You just uploaded an image!');
   }

   public function update(Request $request, $id)
   {
      // Validation //
      $validation = Validator::make($request->all(), [
            'caption'     => 'required|regex:/^[A-Za-z ]+$/',
            'description' => 'required',
            'userfile'    => 'sometimes|image|mimes:jpeg,png|min:1|max:250'
      ]);

      // Check if it fails //
      if( $validation->fails() ){
            return redirect()->back()->withInput()
                             ->with('errors', $validation->errors() );
      }

      // Process valid data & go to success page //
      $image = Album::find($id);

      // if user choose a file, replace the old one //
      if( $request->hasFile('userfile') ){
           $file = $request->file('userfile');
           $destination_path = 'uploads/';
           $filename = str_random(6).'_'.$file->getClientOriginalName();
           $file->move($destination_path, $filename);
           $image->file = $destination_path . $filename;
      }

      // replace old data with new data from the submitted form //
      $image->caption = $request->input('caption');
      $image->description = $request->input('description');
      $image->save();

      return redirect('/')->with('message','You just updated an image!');
   }

   public function destroy($id)
   {
      $image = Album::find($id);
      $image->delete();
      return redirect('/')->with('message','You just uploaded an image!');
   }

}
