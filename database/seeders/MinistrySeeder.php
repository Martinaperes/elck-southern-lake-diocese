<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ministries = [
            [
                'name' => 'Youth Ministry',
                'slug' => Str::slug('Youth Ministry'),
                'description' => 'A ministry for the youth to engage in spiritual and social activities.',
                'leader_name' => 'John Doe',
                'contact_email' => 'elckyouth@church.com',
                'meeting_schedule' => 'Saturdays at 3 PM',
                'is_active' => true,
                'image_url' => 'Youth Ministry.jpg'
            ],
            [
                'name' => 'Worship and liturgy Ministry',
                'slug' => Str::slug('worship and liturgy Ministry'),
                'description' => 'Leads worship through music and choir performances.',
                'leader_name' => 'Jane Smith',
                'contact_email' => 'music@church.com',
                'meeting_schedule' => 'Wednesdays at 6 PM',
                'is_active' => true,
                'image_url' => 'worship and liturgy.jpg'
            ],
            [
                'name' => 'Children\'s Ministry',
                'slug' => Str::slug('Children\'s Ministry'),
                'description' => 'Focuses on teaching children biblical values and activities.',
                'leader_name' => 'Mary Johnson',
                'contact_email' => 'children@church.com',
                'meeting_schedule' => 'Sundays at 10 AM',
                'is_active' => true,
                'image_url' => 'Children Ministry.jpg'
            ],
            [
                'name' => 'Women\'s Ministry',
                'slug' => Str::slug('Women\'s Ministry'),
                'description' => 'Supports spiritual growth, fellowship, and empowerment for women.',
                'leader_name' => 'Grace Mwangi',
                'contact_email' => 'women@church.com',
                'meeting_schedule' => 'Fridays at 5 PM',
                'is_active' => true,
                'image_url' => 'Women Ministry.jpg'
            ],
            [
        'name' => 'Men\'s Ministry',
        'slug' => Str::slug('Men\'s Ministry'),
        'description' => 'Encourages men to grow spiritually and engage in service activities.',
        'leader_name' => 'Peter Otieno',
        'contact_email' => 'men@church.com',
        'meeting_schedule' => 'Saturdays at 5 PM',
        'is_active' => true,
        'image_url' => 'mens-ministry.jpg'
    ],
    [
        'name' => 'Evangelism and Tree planting Ministry',
        'slug' => Str::slug('Evangelism and Tree planting Ministry'),
        'description' => 'Combines outreach and environmental stewardship by spreading the gospel in the community while organizing tree planting and conservation activities to care for God\'s creation',
        'leader_name' => 'David Kariuki',
        'contact_email' => 'evangelism@church.com',
        'meeting_schedule' => 'Thursdays at 6 PM',
        'is_active' => true,
        'image_url' => 'evangelism and tree planting.jpg'
    ],
    [
        'name' => 'Clergy and Lay Leader Training',
        'slug' => Str::slug('Clergy and Lay Leader Training'),
        'description' => 'Provides training, mentorship, and development programs for clergy and lay leaders to equip them for effective ministry leadership, pastoral care, and church management.',
        'leader_name' => 'Pastor Isaiah Obare',
        'contact_email' => 'elckclergy@church.com',
        'meeting_schedule' => 'Daily at 6 AM',
        'is_active' => true,
        'image_url' => 'Clergy and Lay Leader Training.jpg'
    ],
    [
        'name' => 'ELCK Malaria Campaign',
        'slug' => Str::slug('ELCK Malaria Campaign'),
        'description' => 'Focuses on raising awareness, prevention, and treatment of malaria within the church community and surrounding areas through education, outreach programs, and health initiatives.',
        'leader_name' => 'Samuel Njoroge',
        'contact_email' => 'hospitality@church.com',
        'meeting_schedule' => 'Sundays at 8 AM',
        'is_active' => true,
        'image_url' => 'ELCK Malaria Campaign.jpg'
    ],
    [
        'name' => 'Adult Literacy Programs',
        'slug' => Str::slug('Adult Literacy Programs'),
        'description' => 'Provides educational support and literacy training for adults in the community, helping them improve reading, writing, and basic life skills to empower personal and spiritual growth.',
        'leader_name' => 'Alice Kimani',
        'contact_email' => 'elckliteracy@church.com',
        'meeting_schedule' => 'Fridays at 4 PM',
        'is_active' => true,
        'image_url' => 'Adult Literacy Programs.jpg'
    ],
    [
        'name' => 'HIV and AIDS Ministry',
        'slug' => Str::slug('HIV and AIDS Ministry'),
        'description' => 'Provides education, counseling, and support for individuals and families affected by HIV and AIDS, promoting awareness, prevention, and compassionate care within the church community.',
        'leader_name' => 'Michael Ochieng',
        'contact_email' => 'HIV and AIDS@church.com',
        'meeting_schedule' => 'Monthly on the 1st Sunday',
        'is_active' => true,
        'image_url' => 'HIV and AIDS Ministry.jpg'
    ],
    [
        'name' => 'Orphan and Vulnerable Children Programs',
        'slug' => Str::slug('Orphan and Vulnerable Children Programs'),
        'description' => 'Supports orphans and vulnerable children through education, mentorship, spiritual guidance, and provision of basic needs to ensure their holistic development and well-being.',
        'leader_name' => 'Michael Ochieng',
        'contact_email' => 'OrphanandVulnerableChildrenPrograms@church.com',
        'meeting_schedule' => 'Monthly on the 1st Sunday',
        'is_active' => true,
        'image_url' => 'Orphan and Vulnerable Children Programs.jpg'
    ],
    [
        'name' => 'Relief and Development Ministry',
        'slug' => Str::slug('Relief and Development Ministry'),
        'description' => 'Provides humanitarian aid, disaster relief, and community development programs to support those in need, promoting social welfare and sustainable growth within and beyond the church community',
        'leader_name' => 'Michael Ochieng',
        'contact_email' => 'Relief and Development Ministry@church.com',
        'meeting_schedule' => 'Monthly on the 1st Sunday',
        'is_active' => true,
        'image_url' => 'Relief and Development.jpg'
    ],
];
    

       foreach ($ministries as $ministry) {
            DB::table('ministries')->updateOrInsert(
                ['slug' => $ministry['slug']], // ensures uniqueness
                $ministry
);    
    }
}
}