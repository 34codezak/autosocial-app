<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       // === Teams (Agencies or Brands) ===
       Schema::create('teams', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->enum('type', ['agency', 'brand'])->default('brand');
            $table->json('settings')->nullable(); // {timezone, brand_colors, approval_required(for teams)}
            $table->string('plan')->default('free'); // free, pro, agency
            $table->timestamp('trial_ends_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
       });

       // === TEAM MEMBERSHIP ===
       Schema::create('team_user', function (Blueprint $table) {
            $table->uuid('team_id');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('role', ['owner', 'admin', 'creator', 'analyst', 'viewer'])->default('viewer');
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->unique(['team_id', 'user_id']);
            $table->timestamps();
        }); 

        // === SOCIAL ACCOUNTS (Connected Platforms) ===
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('platform', ['facebook', 'instagram', 'twitter', 'linkedin', 'tiktok']);
            $table->string('platform_account_id'); // Page ID, username, etc.
            $table->string('display_name'); // "My Brand Page"
            $table->string('avatar_url')->nullable();
            $table->text('access_token')->nullable(); // encrypted
            $table->text('refresh_token')->nullable(); // encrypted
            $table->timestamp('token_expires_at')->nullable();
            $table->json('permissions')->nullable(); // ['publish_posts', 'read_insights']
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_used_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['team_id', 'platform']);
        });

        // === POSTS ===
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignUuid('social_account_id')->constrained('social_accounts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users'); // creator
            $table->text('content')->nullable();
            $table->json('media_ids')->nullable(); // [uuid, uuid] referencing media_assets
            $table->timestamp('scheduled_for')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'publishing', 'published', 'failed', 'deleted'])->default('draft');
            $table->string('platform_post_id')->nullable(); // ID returned after publishing
            $table->string('platform_url')->nullable(); // Direct link to post
            $table->boolean('ai_generated')->default(false);
            $table->text('ai_prompt_used')->nullable();
            $table->json('ai_metadata')->nullable(); // { model, tokens_used, safety_flags }
            $table->json('analytics_snapshot')->nullable(); // cached: { likes: 42, shares: 5, ... }
            $table->timestamp('published_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->text('failure_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['team_id', 'scheduled_for']);
            $table->index(['status', 'scheduled_for']); // for queue worker
        });

        // === MEDIA ASSETS (Stored in Supabase Storage) ===
        Schema::create('media_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('filename');
            $table->string('storage_path'); // Supabase Storage path
            $table->string('mime_type');
            $table->unsignedBigInteger('size_bytes');
            $table->string('alt_text')->nullable();
            $table->json('captions')->nullable(); // platform-specific captions
            $table->json('tags')->nullable(); // AI-generated or manual tags
            $table->boolean('ai_generated')->default(false);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });

        // === ANALYTICS REPORTS ===
        Schema::create('analytics_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignUuid('social_account_id')->nullable()->constrained('social_accounts')->onDelete('cascade');
            $table->enum('period', ['daily', 'weekly', 'monthly']);
            $table->date('report_date');
            $table->json('metrics')->nullable(); // { reach, impressions, engagement_rate, ... }
            $table->json('ai_insights')->nullable(); // generated summary
            $table->string('ai_model_used')->nullable();
            $table->timestamps();
            $table->unique(['team_id', 'social_account_id', 'period', 'report_date']);
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('analytics_reports');
        Schema::dropIfExists('media_assets');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('social_accounts');
        Schema::dropIfExists('team_user');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('saas_core_tables');
    }
};

    

