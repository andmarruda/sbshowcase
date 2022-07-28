<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\ShowcaseController;

class PublicTemplateComposer{
    public function compose(View $view)
    {
        $sb = new ShowcaseController();
        $view->with('template', $sb->templateInfo());
    }
}