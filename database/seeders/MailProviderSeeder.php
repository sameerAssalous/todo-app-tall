<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Module\Todo\Models\MailProvider;

class MailProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers =  [
            [
                'provider_slug' => 'sendgrid',
                'provider_name' => 'Sendgrid',
            ],
            [
                'provider_slug' => 'ses',
                'provider_name' => 'Amazon Simple Email Service (SES)',
            ]
        ];
        foreach ($providers as $provider) {
            MailProvider::updateOrCreate(
                ['provider_slug' => $provider['provider_slug']],
                $provider
            );

        }

    }
}
