<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\DeliverySettings;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        $total = 0;
        $products = session()->get('sbcart');
        foreach($products as $id => $quantity){
            $prdModel = Product::with('category')->find($id);
            $prds[] = [
                'product_id' => $id,
                'product' => $prdModel,
                'quantity' => $quantity
            ];

            $total += $prdModel->price * $quantity;
        }

        return ['Products' => $prds, 'subtotal' => $total];
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
        if($products==null) 
            return view('cart', ['Products' => NULL, 'subtotal' => 0]);

        if(session_status() != PHP_SESSION_ACTIVE)
            session_start();

        $customer = new CustomerAreaController();
        $address = $customer->isLogged() ? $customer->getCustomerAddress() : NULL;
        return view('cart', ['Products' => $products['Products'], 'subtotal' => $products['subtotal'], 'logged' => $customer->isLogged(), 'customerAddress' => $address]);
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

        if(is_null($prod))
            return redirect()->route('cart')->with('message', 'Produto não encontrado');

        if($prod->quantity == 0)
            return redirect()->route('cart')->with('message', 'Produto sem estoque disponível!');

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
    public function change(int $product_id, int $quantity, ?string $target=NULL) : \Illuminate\Http\RedirectResponse
    {
        $cart = session()->get('sbcart');
        if(isset($cart[$product_id])){
            $cart[$product_id] = $quantity;
            session()->put('sbcart', $cart);
        }

        return redirect()->route('cart', ['#'.$target]);
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
    public function empty() : \Illuminate\Http\RedirectResponse
    {
        session()->forget('sbcart');
        return redirect()->route('cart');
    }

    /**
     * Calculates shippiment value
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function calculateShipping(Request $request) : \Illuminate\Http\JsonResponse
    {
        $city = DeliverySettings::where('city_id', $request->input('ibge'))->first();
        if(is_null($city))
            return response()->json(['shipping' => false]);

        return response()->json($city->toArray());
    }

    /**
     * Shows order confirmation
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderConfirmation() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $customer = new CustomerAreaController();
        $customerAddress = $customer->getCustomerAddress();
        $shipping_price = DeliverySettings::where('city_id', '=', $customerAddress->city_id)->first()->price;
        
        $products = $this->getProducts();
        $all_payment_methods = PaymentMethod::where('installments', '>', 0)->orderBy('name')->get();

        return view('confirmation', [
            'shipping_price' => $shipping_price, 
            'products_price' => is_null($products) ? NULL : $products['subtotal'], 
            'Products' => is_null($products) ? NULL : $products['Products'], 
            'all_payment_methods' => $all_payment_methods, 
            'customerAddress' => $customerAddress
        ]);
    }

    /**
     * Create new order for customer
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function createOrder(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $customer = new CustomerAreaController();
        if(!$customer->isLogged())
            return redirect()->route('customer.login', ['redirect' => 'order-confirmation']);

        $request->validate([
            'payment-method' => 'required|exists:payment_methods,id',
            'installments'   => 'required|integer|min:1',
        ], [
            'payment-method.required' => 'Selecione um método de pagamento',
            'payment-method.exists' => 'Método de pagamento não encontrado',
            'installments.required' => 'Selecione o número de parcelas',
            'installments.integer' => 'O número de parcelas deve ser um número inteiro',
            'installments.min' => 'O número de parcelas deve ser maior que zero'
        ]);

        $customerAddress = $customer->getCustomerAddress();
        $shipping_price = DeliverySettings::where('city_id', '=', $customerAddress->city_id);
        if($shipping_price->count() == 0)
            return redirect()->route('order-confirmation')->withErrors(['message' => 'Infelizmente não entregamos em sua cidade!']);

        $ds = PaymentMethod::find($request->input('payment-method'));
        if($request->input('installments') > $ds->installments)
            return redirect()->route('order-confirmation')->withErrors(['message' => 'Número de parcelas acima do permitido. Parcelamos no máximo em '. $ds->installments .'x nesse método de pagamento.']);

        $products = $this->getProducts();
        if(is_null($products))
            return redirect()->route('order-confirmation')->withErrors(['message' => 'Seu carrinho está vazio!']);

        $oc = new OrderController();
        $shPrice = $shipping_price->first()->price;

        try{
            $customer_id = $_SESSION['sbcustomer-area']['id'];
            $order = NULL;
            DB::connection()->transaction(function() use(&$order, $oc, $request, $customer_id, $products, $shPrice, $customerAddress){
                $order = $oc->newOrder($customer_id, ($products['subtotal'] + $shPrice), $products['subtotal'], $shPrice);
                $oc->savePaymentMethod($order->id, $request->input('payment-method'), $request->input('installments'), (($products['subtotal'] + $shPrice) / $request->input('installments')));
                $oc->saveShippmentData(
                    $order->id, $customerAddress->phone, $customerAddress->address, 
                    $customerAddress->number, $customerAddress->complement, $customerAddress->neighborhood, 
                    $customerAddress->zip_code, $customerAddress->state_id, $customerAddress->city_id
                );

                foreach($products['Products'] as $product){
                    $oc->newOrderProduct($order->id, $product['product']->id, $product['quantity'], $product['product']->price, $product['product']->name, $product['product']->old_price);
                }
            });

            return redirect()->route('order-confirmation')->with('message', 'Pedido nº '. $order->id .' criado com sucesso! Em breve você receberá um e-mail com a confirmação do seu pedido!');
        } catch(\Exception $err){
            return redirect()->route('order-confirmation')->withErrors(['message' => 'Erro inesperado ao salvar seu pedido! Por favor tente novamente mais tarde!']);
        }
    }
}
