<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Produk extends Component
{

    public $cartItems = [];

    public function render()
    {

        $initialCart = [];

        $categories = Category::select('id', 'name')->whereHas('products')->where('is_active', true)->get();
        $brands = Brand::select('id', 'name')->whereHas('products')->where('is_active', true)->get();
        return view('livewire.produk', compact('initialCart', 'categories', 'brands'));
    }

        public function triggerLoadCart()
    {
        $this->dispatch('loadCart'); // trigger ke JS
    }

    public function saveCart($data)
    {
        // $this->cartItems = $data;
        // $this->cartItems = [];

        // 1. Ubah array menjadi Collection
        $collection = collect($data);
        $total_subtotal = $collection->sum('subtotal');

        // 2. Map: Ubah setiap item array menjadi string yang rapi.
        $item_strings = $collection->map(function ($item) {
            return "Produk : {$item['name']}"
                . "\nVarian : {$item['variant']}"
                . "\nQTY : {$item['quantity']}"
                . "\nHarga : Rp" . number_format($item['price'], 0, ',', '.')
                . "\nSubtotal : Rp" . number_format($item['subtotal'], 0, ',', '.');
        });

        // 3. Implode: Gabungkan semua item dengan newline biasa
        $data_rapi = $item_strings->implode("\n\n");

        // 4. Tambahkan pesan awal dan akhir (gunakan newline juga)
        $pesan_awal = "Assalaamu'alaikum wa rahmatullahi wa barakaatuh, ini daftar pesanan saya :\n\n";
        $pesan_akhir = "\n\n*Grand Total = Rp" . number_format($total_subtotal, 0, ',', '.') ."*". "\n\nPesan atas nama : \nMakan di tempat / Ambil sendiri / Pesan antar : \n\nJika pesan antar, kirim ke alamat : ";

        // 5. URL-encode seluruh pesan (baru di sini!)
        $full_message = $pesan_awal . $data_rapi . $pesan_akhir;
        $encoded_message = urlencode($full_message);

        // 6. Redirect ke WhatsApp
        return redirect()->to("https://wa.me/6281370100057?text=" . $encoded_message);
        

        // $this->redirect("/checkout?branch_id=" . Auth::user()->branch_id . "&shipping_method=self_pickup&sales_type=self_pickup&payment_method=cash&rekening=KAS+KASIR&date_order=" . date('Y') . "-" . date('m') . "-" . date('d') . "T" . date('H') . "%3A" . date('i'), navigate: true);
    }

}
