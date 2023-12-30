<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{

    public function plantToCart(REQUEST $request){
        // dd($request->plant_id);
        $user = auth()->user();
        $plant_id = (int) $request->plant_id;
        $quantity = (int) $request->quantity;
        $amount = (float) $request->amount;
        $total_amount = $amount * $quantity; 

        $cartItem = Cart::where(['user_id' => $user->id, 'plant_id' => $plant_id])->first();

        if ($cartItem) {
            // If the cart item exists, update the quantity and total amount
            $cartItem->quantity += $quantity;
            $cartItem->total_amount += $total_amount;
            $cartItem->save();
        } 
        else {
            // If the cart item doesn't exist, create a new one
            Cart::create([
                'user_id' => $user->id,
                'plant_id' => $plant_id,
                'quantity' => $quantity,
                'total_amount' => $total_amount,
            ]);
        }
        return redirect()->route('plantDetails',$request->plant_id);
    }

    public function deleteCart($id){
        $delete_cart = Cart::Find($id);
        $delete_cart->delete();
        return redirect()->route('cart');
    }

    public function toolToCart(REQUEST $request){
        $user = auth()->user();
        $tool_id = (int) $request->tool_id;
        $quantity = (int) $request->quantity;
        $amount = (float) $request->amount;
        $total_amount = $amount * $quantity; 

        $cartItem = Cart::where(['user_id' => $user->id, 'tool_id' => $tool_id])->first();

        if ($cartItem) {
            // If the cart item exists, update the quantity and total amount
            $cartItem->quantity += $quantity;
            $cartItem->total_amount += $total_amount;
            $cartItem->save();
        } 
        else {
            // If the cart item doesn't exist, create a new one
            Cart::create([
                'user_id' => $user->id,
                'tool_id' => $tool_id,
                'quantity' => $quantity,
                'total_amount' => $total_amount,
            ]);
        }
        return redirect()->route('toolDetails',$request->tool_id);
    }
    
}
