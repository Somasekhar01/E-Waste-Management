<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationalResource;
use Carbon\Carbon;

class EducationalResourceSeeder extends Seeder
{
    public function run()
    {
        $resources = [
            [
                'title' => 'Understanding E-Waste: A Comprehensive Guide',
                'content' => 'Electronic waste, or e-waste, refers to discarded electronic devices and equipment. This comprehensive guide explains what e-waste is, its environmental impact, and how we can manage it responsibly.',
                'type' => 'article',
                'tags' => ['e-waste', 'recycling', 'environment'],
                'is_published' => true,
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'The Lifecycle of Electronic Devices',
                'content' => 'Learn about the complete lifecycle of electronic devices, from manufacturing to disposal, and understand the environmental impact at each stage.',
                'type' => 'video',
                'media_url' => 'https://www.youtube.com/embed/example1',
                'tags' => ['lifecycle', 'manufacturing', 'disposal'],
                'is_published' => true,
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'E-Waste Recycling Process Infographic',
                'content' => 'A visual guide to the e-waste recycling process, showing how different types of electronic waste are processed and recycled.',
                'type' => 'infographic',
                'media_url' => 'images/infographics/recycling-process.png',
                'tags' => ['recycling', 'process', 'infographic'],
                'is_published' => true,
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'Toxic Materials in Electronics',
                'content' => 'Discover the harmful materials found in electronic devices and why proper disposal is crucial for environmental and human health.',
                'type' => 'article',
                'tags' => ['toxic materials', 'health', 'environment'],
                'is_published' => true,
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'How to Safely Dispose of Old Electronics',
                'content' => 'Step-by-step guide on how to safely prepare and dispose of your old electronic devices, including data wiping and finding recycling centers.',
                'type' => 'video',
                'media_url' => 'https://www.youtube.com/embed/example2',
                'tags' => ['disposal', 'safety', 'data security'],
                'is_published' => true,
                'published_at' => Carbon::now(),
            ],
        ];

        foreach ($resources as $resource) {
            EducationalResource::create($resource);
        }
    }
} 