<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            BriefSeeder::class,
            AssignmentSeeder::class,
            PublicationCalendarSeeder::class,
            ArtworkSeeder::class,
            ArtworkCorrectionSeeder::class,
            LogoSeeder::class,
            ManualSeeder::class,
            ReportSeeder::class,
            PaymentSeeder::class,
            SalarySeeder::class,
            AuditSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}