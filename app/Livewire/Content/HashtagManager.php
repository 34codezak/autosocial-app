<?php

namespace App\Livewire\Content;

use Livewire\Component;

class HashtagManager extends Component
{
    public array $savedTags = ['#marketing', '#saas', '#growth', '#laravel'];
    public string $newTag = '';
    public array $suggestedTags = [];
    public bool $showSuggestions = false;

    public function addTag()
    {
        $tag = trim($this->newTag);
        if (!empty($tag) && !in_array($tag, $this->savedTags)) {
            $this->savedTags[] = str_starts_with($tag, '#') ? $tag : '#' . $tag;
        }
        $this->newTag = '';
        $this->fetchSuggestions();
    }

    public function removeTag(string $tag)
    {
        $this->savedTags = array_values(array_diff($this->savedTags, [$tag]));
    }

    public function fetchSuggestions()
    {
        // Replace with AI/OpenAI service call
        $this->suggestedTags = ['#techstack', '#buildinpublic', '#developerlife', '#startup'];
        $this->showSuggestions = true;
    }

    public function useSuggestion(string $tag)
    {
        if (!in_array($tag, $this->savedTags)) $this->savedTags[] = $tag;
    }

    public function render()
    {
        return view('livewire.content.hashtag-manager');
    }
}
