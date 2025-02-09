<?php

namespace App\Http\Controllers;

use App\Models\AddressModel;
use App\Models\CashAccountModel;
use App\Models\ClientModel;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\SubBranchModel;
use App\Models\User;
use App\Models\WasityAccountModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\HigherOrderCollectionProxy;


class OrderController extends Controller
{

  
    public function addOrder(Request $request)
    {
     

        $order = new OrderModel;
        $subTotal = 0;
        $order->date = $request->client_id;
        $order->userId = $request->userId;

        $items = json_decode($request->items, true);
        // $items = $request->items;
        if (!is_array($items)) {
            return response()->json(['error' => 'Invalid items format'], 400);
        }

        foreach ($items as $itemData) {
            $item = (object)$itemData;
            $product = Product::find($item->id);
            if ($product->quantity < $item->quantity) {
                return response()->json(['only' . $product->quantity . 'left'], 400);
            }
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $subTotal += $product->price * $item->quantity;

            $acc = CashAccountModel::where('userId', $request->userId)->first();
               
                if ($acc->balance >= $subTotal) {
                    $acc->balance -= $subTotal;
                    $acc->save();
                } else {
                    return response()->json(['error' => 'Insufficient balance'], 500);
                }
            
            $order->save();
            $order_product = new OrderProductModel;
            $order_product->order_id = $order->id;
            $order_product->product_id = $item->id;
            $order_product->count = $item->count;
            $order_product->save();
            $product->count -= $item->count;
            $product->save();
        }

        

        $order->total = $subTotal;


        return response()->json(['message' => 'Order placed successfully'], 200);
    }

    
   
    public function getClientOrders($id)
    {
        $message = [];
        $orders = OrderModel::where('client_id', $id)->get();
        if ($orders) {
            for ($i = 0; $i < count($orders); $i++) {
                $products = [];
                $order_product  = OrderProductModel::where('order_id', $orders[$i]->id)->get();
                for ($j = 0; $j < count($order_product); $j++) {
                    array_push($products, Product::find($order_product[$j]->product_id));
                }
                array_push($message, [
                    'order' => $orders[$i],
                    'products' => $products
                ]);
            }
            return response()->json($message, 200);
        }
        return response()->json([], 500);
    }
}



