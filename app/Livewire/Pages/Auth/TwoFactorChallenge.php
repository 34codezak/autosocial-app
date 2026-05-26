<?php

new #[Layout('components.layouts.guest')]
class extends Component
{
    #[Validate('required|string|size:6')]
    public string $code = '';

    public function authenticate(): void
    {
        $user = session()->get('login.id');
        
        if (! app(\App\Services\Auth\TwoFactorService::class)->verifyCode(
            $user->two_factor_secret, 
            $this->code
        )) {
            throw ValidationException::withMessages([
                'code' => __('The provided two factor authentication code was invalid.'),
            ]);
        }
        
        auth()->login($user);
        session()->forget('login.id');
        $this->redirectIntended('/dashboard', navigate: true);
    }
}

?>