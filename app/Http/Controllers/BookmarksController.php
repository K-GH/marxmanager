<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
      $user_id=Auth::user()->id;
      $bookmarks=Bookmark::where('user_id',$user_id)->get();
      return view('home')->with('bookmarks',$bookmarks);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"=>'required',
            'url'=>'required',
            'description'=>'required'
        ]);

        $user_id=Auth::user()->id;
        //create bookmark
        $bookmark=new Bookmark();
        $bookmark->user_id=$user_id;
        $bookmark->name=$request->get('name');
        $bookmark->link=$request->get('url');
        $bookmark->description=$request->get('description');

        $bookmark->save();

        return redirect('/home')->with('success','Bookmark added');
    }

    public function destroy($id)
    {
      $bookmark=Bookmark::find($id);
      $bookmark->delete();
      //redirect to js on resourse custom file
      return;
    }
}
