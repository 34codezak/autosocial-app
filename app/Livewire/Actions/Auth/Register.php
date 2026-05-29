<?php
// app/Livewire/Actions/Auth/Register.php

use Livewire\Volt\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

new class extends Component {
    public $name, $email, $password, $password_confirmation, $terms = false;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'terms' => 'accepted',
    ];
    
    public function register()
    {
        $this->validate();
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        
        event(new Registered($user));
        Auth::login($user);
        
        return redirect()->route('app.dashboard');
    }
    
    public function render() {
        return view('livewire.actions.auth.register');
    }
};