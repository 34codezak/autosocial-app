<?php

namespace App\Livewire\Features\Marketing;

use Livewire\Component;

class FAQAccordion extends Component
{
    public $faqs = [
        ['q' => 'How do I connect my social accounts?', 'a' => 'Go to Workspace > Connect Account and follow the OAuth flow for each platform.'],
        ['q' => 'Can I schedule posts in advance?', 'a' => 'Yes! Use the Post Editor to create content and set a future publish date.'],
        ['q' => 'Do you support TikTok and LinkedIn?', 'a' => 'Yes, we support Instagram, Facebook, TikTok, X (Twitter), and LinkedIn.'],
    ];
    
    public $openIndex;
    
    public function toggle($index)
    {
        $this->openIndex = $this->openIndex === $index ? null : $index;
    }
    
    public function render()
    {
        return view('livewire.features.marketing.faq-accordion');
    }
}