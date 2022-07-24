<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Require validate's messages
     * @var array
     */
     private array $requestMessages = [
        'category.required' => 'O campo categoria é obrigatório',
        'category.min'      => 'O campo categoria deve ter no mínimo 3 caracteres',
        'category.max'      => 'O campo categoria deve ter no máximo 100 caracteres'
     ];

    /**
     * Returns the view of category form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     {
        $category = is_null($id) ? NULL : Category::find($id);
         return view('admin.category', ['Category' => $category]);
     }

     /**
      * Save a category
      * @version        1.0.0
      * @author         Anderson Arruda < andmarruda@gmail.com >
      * @param          Request $r
      * @return         \Illuminate\Http\RedirectResponse
      */
    public function saveCategory(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $r->validate([
            'category' => 'required|min:3|max:100'
        ], $this->requestMessages);
        $category = is_null($r->input('id')) ? new Category() : Category::find($r->input('id'));
        $category->fill([
            'name' => $r->input('category')
        ]);
        if($category->save())
            return redirect()->route('category')->with('saved', true);

        return redirect()->route('category')->with('saved', false);
    }
}
