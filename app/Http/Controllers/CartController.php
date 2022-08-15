<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Returns quantity of products in cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          int
     */
    public function getQuantity() : int
    {
        $products = session()->get('sbcart');
        return is_array($products) ? count($products) : 0;
    }

    /**
     * Get products inside the cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          ?Array
     */
    public function getProducts() : ?array
    {
        if($this->getQuantity()==0) return null;

        $prds = [];
        $products = session()->get('sbcart');
        foreach($products as $id => $quantity){
            $prds[] = [
                'product_id' => $id,
                'product' => Product::with('category')->find($id),
                'quantity' => $quantity
            ];
        }

        return $prds;
    }

    /**
     * Shows the cart interface with all added products and so on
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $products = $this->getProducts();
        return view('cart', ['Products' => $products]);
    }

    /**
     * Adding some products to the cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $product_id
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function add(int $product_id) : \Illuminate\Http\RedirectResponse
    {
        $prod = Product::find($product_id);

        $cart = session()->get('sbcart');
        if(isset($cart[$product_id])){
            $cart[$product_id]++;
            return redirect()->route('cart');
        }

        $cart[$product_id] = 1;

        session()->put('sbcart', $cart);
        return redirect()->route('cart');
    }

    /**
     * Change quantity of product in the cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $product_id
     * @param           int $quantity
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function change(int $product_id, int $quantity) : \Illuminate\Http\RedirectResponse
    {
        $cart = session()->get('sbcart');
        if(isset($cart[$product_id])){
            $cart[$product_id] = $quantity;
            session()->put('sbcart', $cart);
        }

        return redirect()->route('cart');
    }

    /**
     * Remove product from cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $product_id
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function remove(int $product_id) : \Illuminate\Http\RedirectResponse
    {
        $cart = session()->get('sbcart');
        if(isset($cart[$product_id])){
            unset($cart[$product_id]);
            session()->put('sbcart', $cart);
        }

        return redirect()->route('cart');
    }

    /**
     * Clear the cart
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function clearCart() : \Illuminate\Http\RedirectResponse
    {
        session()->forget('sbcart');
        return redirect()->route('cart');
    }
}
