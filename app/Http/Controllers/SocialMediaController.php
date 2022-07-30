<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Returns the view of category form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $socialMedia = SocialMedia::all();
        return view('admin.social-media-url', ['SocialMedia' => $socialMedia]);
    }

    /**
     * Save Social Media's urls
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $r
     * @return         \Illuminate\Http\RedirectResponse
     */
      public function saveCategory(Request $r) : \Illuminate\Http\RedirectResponse
      {
          /*$r->validate([
              'category' => 'required|min:3|max:100'
          ], $this->requestMessages);
          $category = is_null($r->input('id')) ? new Category() : Category::find($r->input('id'));
          $category->fill([
              'name' => $r->input('category')
          ]);
  
          $saved = $category->save();*/
          return redirect()->route('category')->with('saved', $saved ?? false);
      }
}
