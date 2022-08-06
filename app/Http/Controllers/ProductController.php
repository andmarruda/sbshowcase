<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Number of products per page
     * @var integer
     */
    private int $productsPerPage = 21;

    /**
     * Error's messages
     * @var     array
     */
    private array $errors = [
        'name.required' => 'O campo nome é obrigatório',
        'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        'name.max' => 'O campo nome deve ter no máximo 150 caracteres',
        'descriptionText.required' => 'O campo descrição é obrigatório',
        'descriptionText.min' => 'O campo descrição deve ter no mínimo 30 caracteres',
        'descriptionText.max' => 'O campo descrição deve ter no máximo 500 caracteres',
        'old_price.required' => 'O campo preço antigo é obrigatório',
        'old_price.numeric' => 'O campo preço antigo deve ser um número',
        'percentage_discount.required' => 'O campo percentual de desconto é obrigatório',
        'percentage_discount.numeric' => 'O campo percentual de desconto deve ser um número',
        'installments_limit.required' => 'O campo limite de parcelas é obrigatório',
        'installments_limit.numeric' => 'O campo limite de parcelas deve ser um número',
        'image.required' => 'O campo imagem é obrigatório',
        'price.required' => 'O campo preço é obrigatório',
        'price.numeric' => 'O campo preço deve ser um número',
        'category_id' => 'O campo categoria é obrigatório',
        'measure_id' => 'O campo medida é obrigatório',
        'color_id' => 'O campo cor é obrigatório',
        'brand_id' => 'O campo marca é obrigatório',
        'type_id' => 'O campo tipo é obrigatório',
        'quantity.required' => 'O campo quantidade é obrigatório',
        'quantity.numeric' => 'O campo quantidade deve ser um número',
        'promotion_flag' => 'O campo promoção é obrigatório'
    ];

    /**
     * Admin form's informations
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          array
     */
    public function productFormInfo() : array
    {
        return [
            'Categories' => CategoryController::allEnabled(),
            'Measures' => MeasuresController::allEnabled(),
            'Colors' => ColorController::allEnabled(),
            'Brands' => BrandController::allEnabled(),
            'Types' => TypeController::allEnabled()
        ];
    }

    /**
     * Returns the view of product form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           ?int $id
     * @param           ?int $copy
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(?int $id=NULL, ?int $copy=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $prod = is_null($id) ? NULL : Product::withTrashed()->find($id);
        return view('admin.product', ['Product' => $prod, 'promoFlag' => [1 => 'Sim', 0 => 'Não'], 'Copy' => $copy]);
    }

    /**
     * Disable a product
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $id
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct(Request $request) : \Illuminate\Http\JsonResponse
    {
        $product = Product::withTrashed()->find($request->input('id'));
        if(!is_null($product->deleted_at))
            $product->restore();
        else
            $product->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Save product
     * @version        1.0.0
     * @author         Anderson Arruda < andmarruda@gmail.com >
     * @param          Request $request
     * @return         \Illuminate\Http\RedirectResponse
     */
    public function saveProduct(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $filetypes = implode(',', ImageController::ALLOWED_EXTENSION);
        $this->errors['image.mimes'] = "O campo imagem do produto deve ser do tipo: $filetypes";
        $this->errors['image.max'] = 'O campo imagem do produto deve conter no máximo: '. ImageController::byteToMb(). 'mb';

        $request->validate([
            'name' => 'required|min:3|max:150',
            'descriptionText' => 'required|min:30|max:500',
            'old_price' => 'required|numeric',
            'percentage_discount' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'measure_id' => 'required|exists:measures,id',
            'color_id' => 'required|exists:colors,id',
            'brand_id' => 'required|exists:brands,id',
            'type_id' => 'required|exists:types,id',
            'quantity' => 'required|numeric',
            'installments_limit' => 'required|numeric',
            'promotion_flag' => 'required',
            'image' => 'nullable|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE,
        ], $this->errors);

        $prod = is_null($request->input('id')) ? new Product() : Product::withTrashed()->find($request->input('id'));
        $image = $prod->image ?? '';

        if($request->hasFile('image')){
            $gc = new GeneralController();
            $image = $gc->convertToWebp($request->file('image'), public_path($prod->getImage()));
        }

        $prod->fill([
            'name' => $request->input('name'),
            'description' => $request->input('descriptionText'),
            'old_price' => $request->input('old_price'),
            'percentage_discount' => $request->input('percentage_discount'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'measure_id' => $request->input('measure_id'),
            'color_id' => $request->input('color_id'),
            'brand_id' => $request->input('brand_id'),
            'type_id' => $request->input('type_id'),
            'installments_limit' => $request->input('installments_limit'),
            'quantity' => $request->input('quantity'),
            'promotion_flag' => $request->input('promotion_flag'),
            'image' => $image
        ]);

        $saved = $prod->save();
        return redirect()->route('product')->with('saved', $saved);
    }

    /**
     * Shows a list of the last products registered and a possibility to filter products
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           string $search
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchProduct(?string $search=NULL) : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $products = is_null($search) ? Product::withTrashed()->orderBy('id', 'desc') : Product::withTrashed()->where('name', 'ilike', '%'.$search.'%');
        return view('admin.product-list', ['Products' => $products->paginate($this->productsPerPage), 'search' => $search]);
    }
}
