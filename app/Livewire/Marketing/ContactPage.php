<?php

namespace App\Livewire\Marketing;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Cache;

class ContactPage extends Component
{

    public $name = '';
    public $email = '';
    public $company = '';
    public $subject = '';
    public $message = '';

    public $success = false;
    public $errors = [];

    protected $rules = [
        'name' => 'required|string|min:2|max:100',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|min:5|max:200',
        'message' => 'required|string|min:20|max:2000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name',
        'email.required' => 'Please enter your email',
        'email.email' => 'Please enter a valid email address',
        'subject.required' => 'Please enter a subject',
        'message.required' => 'Please enter your message',
        'message.min' => 'Message must be at least 20 characters',
    ];

    public function submit() {
        // Rate limiting via cache
        $cacheKey = 'contact_form:' . request()->ip();
        if(Cache::get($cacheKey, 0) >= 3) {
            $this->addError('message', 'Too many attempts. Please try again later.');
            return;
        }

        $this->validate();

        // Store in database
        $contact = \App\Models\ContactMessaeg::create([
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'subject' => $this->subject,
            'message' => $this->message,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Send notification to support team
        Mail::to('support@autosocial.app')->queue(new ContactFormSubmitted($contact));

        // Increment rate limit counter
        Cache::increment($cacheKey);
        Cache::put($cacheKey, Cache::get($cacheKey), now()->addHour());

        // Reset form and show success
        $this->reset(['name', 'email', 'company', 'subject', 'message']);
        $this->success = true;

        // Scroll to top for success message
        $this->dispatch('scrol-to-top');
    }

    public function render()
    {
        return view('livewire.marketing.contact-page');
    }
}
