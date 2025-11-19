<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\PublicationCalendar;
use App\Models\User;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $cm1 = User::where('email', 'cm1@empresa.com')->first();
        
        $calendars = PublicationCalendar::all();

        foreach ($calendars as $calendar) {
            Report::create([
                'calendar_id' => $calendar->id,
                'document_path' => 'reports/reporte_' . $calendar->id . '.pdf',
                'created_by' => $cm1->id,
            ]);
        }
    }
}