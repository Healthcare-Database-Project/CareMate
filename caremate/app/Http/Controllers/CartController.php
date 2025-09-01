<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineCatalogue;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $medicine = MedicineCatalogue::findOrFail($request->medicine_id);

        $pillsPerDay = $request->input('pills_per_day');
        $noOfDays = $request->input('days');

        if (isset($cart[$medicine->medicine_id])) {
            return back()->with('info', 'Product already in your cart');
        }
        else {
            $cart[$medicine->medicine_id] = [
                'id' => $medicine->medicine_id,
                'common_name' => $medicine->common_name, 
                'dosage' => $medicine->dosage,
                'qty' => $pillsPerDay * $noOfDays,
                'price' => $medicine->price,
            ];
    
            session()->put('cart', $cart);
    
            $this->calculateCartItemsTotal($cart);
            return redirect()->back()->with('success', 'Medicine added to your cart');
        }
    }

    private function calculateCartItemsTotal($cart)
    {
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        session()->put('cartItemsTotal', $total);
    }


    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($request->action === 'increment') {
                $cart[$id]['qty'] += 1;
            } elseif ($request->action === 'decrement' && $cart[$id]['qty'] > 1) {
                $cart[$id]['qty'] -= 1;
            }
            session()->put('cart', $cart);
        }
        $this->calculateCartItemsTotal($cart);
        return back();
    }

    public function delete($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $this->calculateCartItemsTotal($cart);
        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }
}

