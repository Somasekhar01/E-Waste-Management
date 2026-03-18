<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecyclingFacility;

class RecyclingFacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            [
                'name' => 'EcoRecycle Solutions',
                'address' => '123 Tech Park, Electronic City, Bangalore, Karnataka',
                'phone' => '+91 80 1234 5678',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'latitude' => 12.9716,
                'longitude' => 77.5946,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Batteries']
            ],
            [
                'name' => 'GreenTech Recycling',
                'address' => '456 Industrial Area, Andheri East, Mumbai, Maharashtra',
                'phone' => '+91 22 2345 6789',
                'hours' => 'Mon-Sat: 8:00 AM - 7:00 PM',
                'latitude' => 19.0760,
                'longitude' => 72.8777,
                'services' => ['Electronics', 'Appliances', 'Printers', 'Batteries']
            ],
            [
                'name' => 'E-Waste Management Center',
                'address' => '789 Business Park, Gurgaon, Haryana',
                'phone' => '+91 124 3456 7890',
                'hours' => 'Mon-Sat: 10:00 AM - 8:00 PM',
                'latitude' => 28.4595,
                'longitude' => 77.0266,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Printers']
            ],
            [
                'name' => 'TechRecycle Hub',
                'address' => '321 IT Park, Hinjewadi, Pune, Maharashtra',
                'phone' => '+91 20 4567 8901',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'latitude' => 18.5924,
                'longitude' => 73.7183,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Batteries']
            ],
            [
                'name' => 'Eco-Friendly Recycling',
                'address' => '654 Green Park, Hyderabad, Telangana',
                'phone' => '+91 40 5678 9012',
                'hours' => 'Mon-Sat: 8:00 AM - 7:00 PM',
                'latitude' => 17.3850,
                'longitude' => 78.4867,
                'services' => ['Electronics', 'Appliances', 'Printers', 'Batteries']
            ],
            [
                'name' => 'Green Earth Recycling',
                'address' => '987 Eco Zone, Chennai, Tamil Nadu',
                'phone' => '+91 44 6789 0123',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'latitude' => 13.0827,
                'longitude' => 80.2707,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Printers']
            ],
            [
                'name' => 'E-Waste Solutions',
                'address' => '147 Tech Valley, Noida, Uttar Pradesh',
                'phone' => '+91 120 7890 1234',
                'hours' => 'Mon-Sat: 10:00 AM - 8:00 PM',
                'latitude' => 28.5355,
                'longitude' => 77.3910,
                'services' => ['Electronics', 'Appliances', 'Batteries']
            ],
            [
                'name' => 'Recycle Tech Center',
                'address' => '258 Innovation Park, Ahmedabad, Gujarat',
                'phone' => '+91 79 8901 2345',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'latitude' => 23.0225,
                'longitude' => 72.5714,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Printers']
            ],
            [
                'name' => 'Eco Tech Recycling',
                'address' => '369 Green Valley, Kolkata, West Bengal',
                'phone' => '+91 33 9012 3456',
                'hours' => 'Mon-Sat: 8:00 AM - 7:00 PM',
                'latitude' => 22.5726,
                'longitude' => 88.3639,
                'services' => ['Electronics', 'Appliances', 'Batteries']
            ],
            [
                'name' => 'Green Recycling Hub',
                'address' => '741 Tech Park, Jaipur, Rajasthan',
                'phone' => '+91 141 0123 4567',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'latitude' => 26.9124,
                'longitude' => 75.7873,
                'services' => ['Electronics', 'Computers', 'Mobile Phones', 'Printers']
            ]
        ];

        foreach ($facilities as $facility) {
            RecyclingFacility::create($facility);
        }
    }
} 