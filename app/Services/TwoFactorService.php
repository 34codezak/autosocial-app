<?php

namespace App\Services;

use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorService
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = app(Google2FA::class);
    }

    public function generateSecretKey(): string
    {
        return $this->google2fa->generateSecretKey();
    }

    public function getQRCodeSvg(string $email, string $secret): string
    {
        // 1. Initialize the SVG Backend
        $backend = new SvgImageBackEnd();

        // 2. Define the Renderer with Size (300x300)
        $renderer = new ImageRenderer(
            new RendererStyle(300), 
            $backend
        );

        // 3. Pass the Renderer to the Writer (NOT the backend directly)
        $writer = new Writer($renderer);

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $email,
            $secret
        );

        // 4. Generate SVG (Only 2 arguments allowed: content, encoding)
        return $writer->writeString($qrCodeUrl);
    }

    public function verifyCode(string $secret, string $code): bool
    {
        return $this->google2fa->verifyKey($secret, $code);
    }
}   