<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Breaking News : Flood',
                'disaster_type' => 'Flood',
                'status' => 'Ongoing',
                'content' => 'Heavy rainfall over the past several days has caused severe flooding...',
                'image' => 'https://images.unsplash.com/photo-1602748841148-7bba559cc6b5?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->toDateString()
            ],
            [
                'title' => 'Breaking News : Earthquake',
                'disaster_type' => 'Earthquake',
                'status' => 'Under Monitoring',
                'content' => 'A moderate earthquake struck earlier today...',
                'image' => 'https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(1)->toDateString()
            ],
            [
                'title' => 'Breaking News : Wildfire',
                'disaster_type' => 'Wildfire',
                'status' => 'Contained',
                'content' => 'Firefighters have contained the wildfire after hours...',
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(3)->toDateString()
            ],
        ];

        // supera jadi 12 item, kita clone
        for ($i=1; $i<=12; $i++) {
            $base = $items[$i % count($items)];
            News::create([
                'user_id' => 1, // admin user
                'title' => $base['title']." #".$i,
                'disaster_type' => $base['disaster_type'],
                'status' => strtolower($base['status']) === 'ongoing' || strtolower($base['status']) === 'under monitoring' ? 'published' : 'published',
                'content' => $base['content']." (News item #$i)",
                'image_path' => $base['image'],
            ]);
        }
    }
}

