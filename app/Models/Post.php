<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\MarkdownConverter;

class Post extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt',
        'content_markdown', 'content_html', 'featured_image',
        'featured_image_alt', 'seo', 'status', 'published_at',
        'view_count', 'like_count', 'allow_comments'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'seo' => 'array',
        'allow_comments' => 'boolean',
    ];

    // === RELATIONSHIPS ===
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved')->with('author');
    }

    // === SCOPES ===
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc');
    }

    public function scopeWithCategory($query, $slug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $slug));
    }

    public function scopeWithTag($query, $slug)
    {
        return $query->whereHas('tags', fn($q) => $q->where('slug', $slug));
    }

    // === MARKDOWN PARSING (Cached) ===
    protected function contentHtml(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $value ?? $this->parseMarkdown($attributes['content_markdown']),
        );
    }

    protected function parseMarkdown(string $markdown): string
    {
        // Configure CommonMark with extensions
        $environment = new Environment([
            'html_input' => 'strip', // Security: strip raw HTML
            'allow_unsafe_links' => false,
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new FrontMatterExtension()); // for YAML front-matter
        
        // Optional: Add syntax highlighting via extension
        // $environment->addExtension(new GithubFlavoredMarkdownExtension());
        
        $converter = new MarkdownConverter($environment);
        return $converter->convert($markdown)->getContent();
    }

    // === EXCERPT GENERATION (auto if empty) ===
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ?: $this->generateExcerpt(),
        );
    }

    protected function generateExcerpt(int $length = 160): string
    {
        $text = strip_tags($this->content_html);
        return strlen($text) <= $length 
            ? $text 
            : substr($text, 0, strrpos(substr($text, 0, $length), ' ')) . '...';
    }

    // === URL HELPERS ===
    public function getUrlAttribute(): string
    {
        return route('blog.show', ['category' => $this->category?->slug ?? 'uncategorized', 'slug' => $this->slug]);
    }

    public function getReadingTimeAttribute(): int
    {
        // ~200 words per minute average reading speed
        return max(1, (int) ceil(str_word_count(strip_tags($this->content_html)) / 200));
    }
}