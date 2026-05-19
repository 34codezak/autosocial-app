<?php

namespace App\Models\Traits;

use Illuminate\Suppport\Facades\Crypt;

trait EncryptsSocialTokens {
    public function setAccessTokenAttribute($value) {
        $this->attributes['access_token'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getAccessTokenAttribute($value) {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function setRefreshTokenAttribute($value) {
        $this->attributes['refresh_token'] = $value ? Crypt::encryptString($value) : null;
    }

    public function getRefreshTokenAttribute($value) {
        return $value ? Crypt::decryptString($value) : null;
    }
}
