<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Register')]
class RegisterPage extends Component

{

    public $name;
    public $email;
    public $password;

    // regiter user
    public function register()
    {
        // dd($this->name, $this->email, $this->password);

        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        // save to database
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->created_by = 1;
        $user->updated_by = 1;
        $user->save();

        // login user
        Auth::login($user, true);
        // Auth::login($user);

        // redirect to homepage
        return redirect()->intended();
        // return redirect('/');
        // redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
