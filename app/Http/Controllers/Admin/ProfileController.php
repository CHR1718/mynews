<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    // public function create(Request $request)
    // {
    //     $this->validate($request, Profile::$rules);
        
    //     $profile = new Profile;
    //     $form = $request->all();
        
    //     // フォームから送信されてきた_tokenを削除する
    //     unset($form['_token']);
        
    //     $profile->fill($form);
    //     $profile->save();
        
    //     return redirect('admin/profile/create');
    // }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
    
 
    public function create(Request $request)
  {

      // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

    //   // formに画像があれば、保存する
    //   if ($form['image']) {
    //     $path = $request->file('image')->store('public/image');
    //     $profile->image_path = basename($path);
    //   } else {
    //       $profile->image_path = null;
    //   }

      unset($form['_token']);
      unset($form['image']);
    
    $profile->fill($form);
    $profile->save();

      return redirect('admin/profile/create');
  }

  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

 public function delete(Request $request)
  {
      // 該当するProfile Modelを取得
      $news = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  

}
