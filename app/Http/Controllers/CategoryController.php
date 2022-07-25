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
     * Search category inside of admin including disabled categories
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function searchCategory(Request $r)
    {
        $finded = ($r->input('searchType') == '' || $r->input('searchType') == '1') 
            ? Category::withTrashed()->where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get() 
            : Category::where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Disable category or enable category depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function deleteCategory(Request $r)
    {
        $category = Category::withTrashed()->find($r->input('id'));
        if(!is_null($category->deleted_at))
            $category->restore();
        else
            $category->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Returns the view of category form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     {
        $category = is_null($id) ? NULL : Category::withTrashed()->find($id);
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

        $saved = $category->save();
        return redirect()->route('category')->with('saved', $saved);
    }
}
