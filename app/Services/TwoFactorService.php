<?php

namespace App\Services\Auth;

use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class TwoFactorService
{
    public function generateSecretKey(): string
    {
        return app(Google2FA::class)->generateSecretKey();
    }

    public function getQRCodeSvg(string $email, string $secret): string
    {
        $writer = new Writer(new SvgImageBackEnd());
        return $writer->writeString(
            app(Google2FA::class)->getQRCodeUrl(
                config('app.name'),
                $email,
                $secret
            ),
            300,
            300
        );
    }

    public function verifyCode(string $secret, string $code): bool
    {
        return app(Google2FA::class)->verifyKey($secret, $code);
    }
}