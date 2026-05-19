<?php 

use App\Models\Traits\EncryptsSocialTokens;

class SocialAccount extends Model {
    // Applying the EncryptsSocialTokens to automatically encrypt tokens
    use EncryptsSocialTokens;
    // ... rest of the model
}