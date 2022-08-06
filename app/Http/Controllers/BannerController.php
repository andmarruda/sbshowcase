<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Require validate's messages
     * @var array
     */
    private array $requestMessages = [
        'name.required' => 'O campo nome é obrigatório',
        'name.string'   => 'O campo nome deve ser uma string',
        'name.max'      => 'O campo nome deve ter no máximo 50 caracteres',
        'link.required' => 'O campo link é obrigatório',
        'link.string'   => 'O campo link deve ser uma string',
        'link.max'      => 'O campo link deve ter no máximo 150 caracteres',
        'alt.required'  => 'O campo alt é obrigatório',
        'alt.string'    => 'O campo alt deve ser uma string',
        'alt.max'       => 'O campo alt deve ter no máximo 150 caracteres'
     ];

    /**
     * Display the banner's view
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       ?int $id
     * @return      \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $banner = !is_null($id) ? Banner::find($id) : NULL;
        return view('admin.banner', ['Banner' => $banner]);
    }

    /**
     * Search banner inside of admin including disabled banner
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\Response
     */
    public function search(Request $r)
    {
        $finded = ($r->input('searchType') == '' || $r->input('searchType') == '1') 
            ? Banner::withTrashed()->where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get() 
            : Banner::where('name', 'ilike', '%' . $r->input('searchInput') . '%')->get();

        return response()->json($finded->toArray());
    }

    /**
     * Disable banner or enable banner depending on his actual status
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Http\JsonResponse
     */
    public function delete(Request $r) : \Illuminate\Http\JsonResponse
    {
        $banner = Banner::withTrashed()->find($r->input('id'));
        if(!is_null($banner->deleted_at))
            $banner->restore();
        else
            $banner->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Save a banner
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $r
     * @return         \Illuminate\Http\RedirectResponse
     */
    public function save(Request $r) : \Illuminate\Http\RedirectResponse
    {
        $filetypes = implode(',', ImageController::ALLOWED_EXTENSION);
        $this->requestMessages['image.mimes'] = "O campo imagem deve ser do tipo: $filetypes";
        $this->requestMessages['image.max'] = 'O campo imagem deve conter no máximo: '. ImageController::byteToMb(). 'mb';

        $r->validate([
            'name' => 'required|string|max:50',
            'image' => 'nullable|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE,
            'link' => 'required|string|max:150',
            'alt' => 'required|string|max:150'
        ], $this->requestMessages);

        $banner = !is_null($r->input('id')) ? Banner::find($r->input('id')) : new Banner();
        $image = $banner->image ?? '';
        if($r->hasFile('image') && $r->file('image')->isValid()){
            $i = new ImagesSizeController($r->file('image'), $image);
            $i->resize();
            $image = $i->name;
            if($image != ''){
                $i->deleteCascade();
            }
        }

        $banner->fill([
            'name' => $r->input('name'),
            'image' => $image,
            'link' => $r->input('link'),
            'alt' => $r->input('alt')
        ]);
        $saved = $banner->save();
        return redirect()->route('banner')->with('saved', $saved);
    }
}
