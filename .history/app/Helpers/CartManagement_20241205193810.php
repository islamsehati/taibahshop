<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class CartManagement
{

    // add item to cart
    static public function addItemToCart($product_id)
    {
        $cart_items = self::getCartItemsFromCart();

        $existing_item = null;

        foreach ($cart_items => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $item['product_id'] ;
                break;
            }
        }
        dd($existing_item);

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'variant', 'slug', 'price', 'images', 'branch_id']);
            // $productimgempty = url('storage/box.png');
            if ($product->images != null) {
                $productimg = $product->images[0];
            } else {
                $productimg = '';
            }

            if ($product) {
                $cart_items = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'variant' => $product->variant,
                    'slug' => $product->slug,
                    'image' => $productimg,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                    'mutation_type' => 'Sales',
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'branch_id' => $product->branch_id
                ];
            }
        }

        self::addCartItemsToCart($cart_items);
        return count($cart_items);
    }

    // add item to cart with qty
    static public function addItemToCartWithQty($product_id, $qty)
    {
        $cart_items = self::getCartItemsFromCart();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'variant', 'slug', 'price', 'images', 'branch_id']);
            // $productimgempty = url('storage/box.png');
            if ($product->images != null) {
                $productimg = $product->images[0];
            } else {
                $productimg = '';
            }

            if ($product) {
                $cart_items = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'variant' => $product->variant,
                    'slug' => $product->slug,
                    'image' => $productimg,
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $qty,
                    'mutation_type' => 'Sales',
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'branch_id' => $product->branch_id
                ];
            }
        }

        self::addCartItemsToCart($cart_items);
        return count($cart_items);
    }

    // remove item from cart
    static public function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCart();
        Cart::where('created_by', auth()->user()->id)->where('product_id', $product_id)->delete();
        return $cart_items;
    }

    // add cart items to coockie
    static public function addCartItemsToCart($cart_items)
    {
        Cart::create($cart_items);
    }

    // clear cart items from cart
    static public function clearCartItems()
    {
        Cart::where('created_by', auth()->user()->id)->delete();
    }

    // get all cart items from cart
    static public function getCartItemsFromCart()
    {
        if (Auth::check()) {
            $cart_items = Cart::all()->where('created_by', auth()->user()->id);
        } else {
            $cart_items = Cart::all()->where('created_by', 0);
        }
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }

    // increment item quantity
    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCart();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCart($cart_items);
        return $cart_items;
    }

    // decrement item quantity
    static public function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCart();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }
        self::addCartItemsToCart($cart_items);
        return $cart_items;
    }

    // typing item quantity
    // static public function typingQuantityToCartItem($product_id, $quantity)
    // {
    //     $cart_items = self::getCartItemsFromCart();

    //     foreach ($cart_items as $key => $item) {
    //         if ($item['product_id'] == $product_id) {
    //             $qty = $cart_items[$key]['quantity'];
    //             $qtyubah = $quantity;
    //             dd($qtyubah);
    //             $cart_items[$key]['quantity']++;
    //             $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
    //         }
    //     }

    //     self::addCartItemsToCart($cart_items);
    //     return $cart_items;
    // }

    // calculate grand total
    static public function calculateGrandTotal($items)
    {
        if (Auth::check()) {
            $items = Cart::query()->where('created_by', auth()->user()->id)->sum('total_amount');
        } else {
            $items = Cart::query()->where('created_by', 0)->sum('total_amount');
        }
        return ($items);
    }
}
