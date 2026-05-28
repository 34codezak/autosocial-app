<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardMetricsService {
    /**
     * Get dashboard metrics for a user
     */
    public function getMetrics($user): array
    {
        $viewsTrend = $this->calculateTrend('views', $user);
        $likesTrend = $this->calculateTrend('likes', $user);
        $commentsTrend = $this->calculateTrend('comments', $user);
        $sharesTrend = $this->calculateTrend('shares', $user);
        
        return [
            'metrics' => [
            'views' => [
                'label' => 'Total Views',
                'value' => $this->getTotalViews($user),
                'icon' => 'eye',
                'trend' => $viewsTrend,      // Returns float
                'trendUp' => $viewsTrend >= 0, // Calculated from trend
                'trendData' => $this->getTrendData('views', $user),
            ],
            'likes' => [
                'label' => 'Total Likes',
                'value' => $this->getTotalLikes($user),
                'icon' => 'heart',
                'trend' => $likesTrend,
                'trendUp' => $likesTrend >= 0,
                'trendData' => $this->getTrendData('likes', $user),
            ],
            'comments' => [
                'label' => 'Comments',
                'value' => $this->getTotalComments($user),
                'icon' => 'chat',
                'trend' => $commentsTrend,
                'trendUp' => $commentsTrend >= 0,
                'trendData' => $this->getTrendData('comments', $user),
            ],
            'shares' => [
                'label' => 'Shares',
                'value' => $this->getTotalShares($user),
                'icon' => 'share',
                'trend' => $sharesTrend,
                'trendUp' => $sharesTrend >= 0,
                'trendData' => $this->getTrendData('shares', $user),
            ],
        ],

            'platformBreakdown' => $this->getPlatformBreakdown($user),
            'trendData' => $this->getTrendChartData($user),
            'platformBreakdown' => $this->getPlatformBreakdown($user),
            'recentPosts' => $this->getRecentPosts($user),
        ];
    }

    /**
 * Get engagement breakdown by platform
 */
    protected function getPlatformBreakdown($user): array
    {
        // TODO: Replace with real queries to your social connections table
        // Example: Get engagement from Twitter, Facebook, LinkedIn, etc.

        return [
            [
                'name' => 'Twitter/X',
                'engagement' => 6200,  // Example: total likes + shares + comments
                'color' => 'from-sky-400 to-blue-600',
                'icon' => 'twitter',   // Optional: for icon display
            ],
            [
                'name' => 'Facebook',
                'engagement' => 4800,
                'color' => 'from-blue-500 to-indigo-600',
                'icon' => 'facebook',
            ],
            [
                'name' => 'LinkedIn',
                'engagement' => 3100,
                'color' => 'from-blue-600 to-slate-700',
                'icon' => 'linkedin',
            ],
            [
                'name' => 'Instagram',
                'engagement' => 2400,
                'color' => 'from-pink-500 to-orange-400',
                'icon' => 'instagram',
            ],
        ];
    }

        /**
     * Get recent posts for the user
     */
    public function getRecentPosts($user, int $limit = 5): array
    {
        // TODO: Replace with real Post model query
        // Example: Post::where('user_id', $user->id)->latest()->limit($limit)->get()

        return [
            [
                'id' => 1,
                'title' => 'Summer Campaign Launch',
                'type' => 'image',  // image, video, text, document
                'platform' => 'Instagram',
                'time' => '2h ago',
                'status' => 'published',  // published, publishing, scheduled, failed
                'engagement' => 1247,
            ],
            [
                'id' => 2,
                'title' => 'Product Demo Video',
                'type' => 'video',
                'platform' => 'YouTube',
                'time' => '5h ago',
                'status' => 'publishing',
                'engagement' => 892,
            ],
            [
                'id' => 3,
                'title' => 'Weekly Newsletter',
                'type' => 'text',
                'platform' => 'LinkedIn',
                'time' => '1d ago',
                'status' => 'scheduled',
                'engagement' => 0,
            ],
            [
                'id' => 4,
                'title' => 'Q4 Strategy Deck',
                'type' => 'document',
                'platform' => 'Twitter/X',
                'time' => '2d ago',
                'status' => 'published',
                'engagement' => 456,
            ],
            [
                'id' => 5,
                'title' => 'Behind the Scenes',
                'type' => 'image',
                'platform' => 'Facebook',
                'time' => '3d ago',
                'status' => 'failed',
                'engagement' => 0,
            ],
        ];
    }

        /**
     * Get engagement trend data for chart (last 7 days)
     */
    public function getTrendChartData($user): array
    {
        // TODO: Replace with real query
        // Example: Get daily engagement sums from interactions table

        return [
            120,  // Monday
            145,  // Tuesday
            98,   // Wednesday
            167,  // Thursday
            189,  // Friday
            201,  // Saturday
            234,  // Sunday
        ];
    }



    /**
     * Get total views for user's posts
     */
    protected function getTotalViews($user): string
    {
        try {
            return number_format(
                Post::where('user_id', $user->id)->sum('views') ?: 0
            );
        } catch (ModelNotFoundException $e) {
            return '0';
        }
    }

    /**
     * Get total likes for user
     */
    protected function getTotalLikes($user): string
    {
        try {
            return number_format(
                Interaction::where('user_id', $user->id)  // Fixed: was 'when'
                    ->where('type', Interaction::TYPE_LIKE) // Fixed: was 'comment'
                    ->count()
            );
        } catch (ModelNotFoundException $e) {
            return '0';
        }
    }

    /**
     * Get total comments for user
     */
    protected function getTotalComments($user): string
    {
        try {
            return number_format(
                Interaction::where('user_id', $user->id)
                    ->where('type', Interaction::TYPE_COMMENT)
                    ->count()
            );
        } catch (ModelNotFoundException $e) {
            return '0';
        }
    }

    /**
     * Get total shares for user
     */
    protected function getTotalShares($user): string
    {
        try {
            return number_format(
                Interaction::where('user_id', $user->id)
                    ->where('type', Interaction::TYPE_SHARE)
                    ->count()
            );
        } catch (ModelNotFoundException $e) {
            return '0';
        }
    }

    /**
     * Calculate trend percentage for a metric
     * 
     * @return float  Numeric value like 12.5 or -2.1 (NO % sign)
     */
    protected function calculateTrend(string $metric, $user): float
    {
        // TODO: Replace with real trend calculation
        // Example: Compare this week vs last week
        
        return match($metric) {
            'views' => 12.5,      // Float, not string
            'likes' => 8.2,
            'comments' => -2.1,   // Negative for decrease
            'shares' => 24.3,
            default => 0.0,
        };
    }

    /**
     * Get trend data for metric rendering
     * 
     */

     private function getTrendData(string $type, $user): array {
        $days = 24;

        return collect(range(1, $days))
            ->map(function()use($type) {
                return match($type) {
                    'views' => rand(200, 1200),
                    'likes' => rand(50, 400),
                    'comments' => rand(10, 120),
                    'share' => rand(20, 200),
                    default => rand(10, 100),
                };
            })
            ->toArray();
     }
}