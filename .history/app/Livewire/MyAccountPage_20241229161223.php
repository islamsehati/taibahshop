<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class MyAccountPage extends Component
{

    public function mount() {}


    public function render()
    {

        // $users = User::all();
        $ordersamount = Order::where('user_id', auth()->user()->id)->sum('grand_total');
        $orders = Order::where('user_id', auth()->user()->id)->get();
        $orderscount = $orders->count();

        return view('livewire.my-account-page', [
            // 'users' => $users,
            'ordersamount' => $ordersamount,
            'orderscount' => $orderscount,
        ]);
    }
}
