<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerAreaController;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use App\Models\OrderPaymentMethod;
use App\Models\OrderDelivery;
use App\Models\OrderProduct;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Returns the view of orders
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $order_status = OrderStatus::all();
        /**if(session('customer_name')){
            var_dump('1');
            die;
        }**/
        $order = Order::where('order_status_id', '=', 1)->get();
        return view('admin.order', ['OrderStatus' => $order_status, 'Orders' => $order]);
    }

    /**
     * Search orders
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $request
     * @return          \Illuminate\Http\RedirectResponse
     */
    public function orderSearch(Request $request) : \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('order')
            ->with('customer_name', $request->input('customer_name'))
            ->with('customer_document', $request->input('customer_document'))
            ->with('initial_order_date', $request->input('initial_order_date'))
            ->with('final_order_date', $request->input('final_order_date'))
            ->with('initial_order_date_delete', $request->input('initial_order_date_delete'))
            ->with('final_order_date_delete', $request->input('final_order_date_delete'))
            ->with('order_status_id', $request->input('order_status_id'));
    }

    /**
     * Save payment method of order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @param           int $payment_method_id
     * @param           int $installments
     * @param           float $installment_price
     * @return          \App\Models\OrderPaymentMethod 
     */
    public function savePaymentMethod(int $order_id, int $payment_method_id, int $installments, float $installment_price) : OrderPaymentMethod
    {
        $orderPaymentMethod = OrderPaymentMethod::create([
            'order_id'          => $order_id,
            'payment_method_id' => $payment_method_id,
            'installments'      => $installments,
            'installment_price' => $installment_price
        ]);

        return $orderPaymentMethod;
    }

    /**
     * Save shippment data of order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @param           string $phone
     * @param           string $address
     * @param           string $number
     * @param           ?string $complement
     * @param           string $neighborhood
     * @param           string $zip_code
     * @param           int $state_id
     * @param           int $city_id
     * @return          \App\Modes\OrderDelivery
     */
    public function saveShippmentData(int $order_id, string $phone, string $address, string $number, ?string $complement, string $neighborhood, string $zip_code, int $state_id, int $city_id) : OrderDelivery
    {
        $orderDelivery = OrderDelivery::create([
            'order_id'      => $order_id,
            'phone'         => $phone,
            'address'       => $address,
            'number'        => $number,
            'complement'    => $complement,
            'neighborhood'  => $neighborhood,
            'zip_code'      => $zip_code,
            'state_id'      => $state_id,
            'city_id'       => $city_id
        ]);
        
        return $orderDelivery;
    }

    /**
     * Save product into order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @param           int $product_id
     * @param           int $quantity
     * @param           float $price
     * @param           string $product_name
     * @param           float $old_price
     * @return          \App\Models\OrderProduct
     */
    public function newOrderProduct(int $order_id, int $product_id, int $quantity, float $price, string $product_name, float $old_price) : OrderProduct
    {
        $op = OrderProduct::create([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'product_name' => $product_name,
            'old_price' => $old_price
        ]);

        return $op;
    }

    /**
     * Save a new order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $customer_id
     * @param           float $total
     * @param           float $subtotal
     * @return          \App\Models\Order
     */
    public function newOrder(int $customer_id, float $total, float $subtotal, float $shippment_price) : Order
    {
        $o = Order::create([
            'customer_id'       => $customer_id, 
            'total'             => $total, 
            'status'            => true, 
            'order_status_id'   => 1, 
            'subtotal'          => $subtotal,
            'shippment_price'   => $shippment_price
        ]);

        return $o;
    }

    /**
     * Get all detailed order informations
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @return          array['Order' => \App\Models\Order, 'OrderAddress' => \App\Models\OrderDelivery, 'Products' => \App\Models\OrderProduct, 'PaymentMethod' => \App\Models\OrderPaymentMethod]
     */
    public function getOrderDetails(int $order_id) : array
    {
        $order = Order::withTrashed()->find($order_id);
        return [
            'Order' => $order, 
            'OrderAddress' => $order->address()->first(), 
            'Products' => $order->products()->get(), 
            'PaymentMethod' => $order->payment_method()->first()
        ];
    }
}
