<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Church Anniversary',
                'description' => 'Celebrating 25 years of our church community.',
                'image_url' => 'images/pictures/church_anniversary.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Youth Retreat',
                'description' => 'Spiritual retreat for the youth ministry.',
                'image_url' => 'images/pictures/youth_retreat.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Christmas Celebration',
                'description' => 'Annual Christmas program and celebrations.',
                'image_url' => 'images/pictures/christmas_celebration.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Community Outreach',
                'description' => 'Feeding the needy and community support programs.',
                'image_url' => 'images/pictures/community_outreach.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Bible Study Group',
                'description' => 'Weekly Bible study and discussion.',
                'image_url' => 'images/pictures/bible_study.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Easter Service',
                'description' => 'Special Easter Sunday service celebration.',
                'image_url' => 'images/pictures/easter_service.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Choir Performance',
                'description' => 'Our choir performing at the Sunday service.',
                'image_url' => 'images/pictures/choir_performance.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Mission Trip',
                'description' => 'Members on a mission trip to help the community.',
                'image_url' => 'images/pictures/mission_trip.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Fundraising Event',
                'description' => 'Annual fundraising dinner for church projects.',
                'image_url' => 'images/pictures/fundraising_event.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Women\'s Ministry Meeting',
                'description' => 'Monthly gathering of the women\'s ministry.',
                'image_url' => 'images/pictures/womens_meeting.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Men\'s Ministry Retreat',
                'description' => 'Spiritual retreat for men\'s ministry members.',
                'image_url' => 'images/pictures/mens_retreat.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Children\'s Sunday School',
                'description' => 'Fun and learning for children during Sunday school.',
                'image_url' => 'images/pictures/children_sunday_school.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Youth Choir',
                'description' => 'Youth choir performing at the church event.',
                'image_url' => 'images/pictures/youth_choir.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Food Drive',
                'description' => 'Collecting food for the needy in the community.',
                'image_url' => 'images/pictures/food_drive.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Elderly Ministry Visit',
                'description' => 'Church members visiting elderly in the community.',
                'image_url' => 'images/pictures/elderly_visit.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Prayer Meeting',
                'description' => 'Weekly prayer meeting for all church members.',
                'image_url' => 'images/pictures/prayer_meeting.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Harvest Festival',
                'description' => 'Annual celebration of blessings and harvest.',
                'image_url' => 'images/pictures/harvest_festival.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Community Clean-up',
                'description' => 'Church members cleaning and beautifying the neighborhood.',
                'image_url' => 'images/pictures/community_cleanup.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Baptism Ceremony',
                'description' => 'Special baptism ceremony for new members.',
                'image_url' => 'images/pictures/baptism_ceremony.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Thanksgiving Service',
                'description' => 'Annual thanksgiving service for the church community.',
                'image_url' => 'images/pictures/thanksgiving_service.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
