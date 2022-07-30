<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Models\SocialMediaUrl;
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
      public function saveSocialMedia(Request $r) : \Illuminate\Http\RedirectResponse
      {
        foreach($r->input('social_media') as $id => $sm)
        {
            $socialMediaUrl = SocialMediaUrl::where('social_media_id', '=', $id);
            if($socialMediaUrl->count() > 0 && (is_null($sm) || $sm=='')){
                $socialMediaUrl->delete();
                continue;
            }

            if(is_null($sm) || $sm=='')
                continue;

            $socialMediaUrl = $socialMediaUrl->count() > 0 ? $socialMediaUrl->first() : new SocialMediaUrl();
            $socialMediaUrl->fill([
                'url' => $sm,
                'social_media_id' => $id
            ]);
            $socialMediaUrl->save();
        }
        return redirect()->route('social-media')->with('saved', true);
      }
}
