<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyReport;
use App\Models\DailyActivityDetail;
use App\Models\MaintenanceLog;
use App\Models\MaintenanceLogAfter;
use App\Models\MaterialReplacement;
use App\Models\DailyActivity;
use App\Models\DailyProblem;
use App\Models\ManPower;
use App\Models\MaintenanceLogDetail;
use App\Models\MaintenanceLogAfterDetail;

class DailyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DailyReport::factory()->count(10)->create()->each(function ($report) {
            // Buat 3 aktivitas harian untuk setiap laporan
            DailyActivityDetail::factory()->count(3)->create([
                'report_id' => $report->id
            ])->each(function ($activityDetail) {
                // Buat 2 log maintenance untuk setiap aktivitas
                MaintenanceLog::factory()->count(2)->create([
                    'report_detail_id' => $activityDetail->id
                ])->each(function ($maintenanceLog) {
                    // Buat 1 log after maintenance
                    $afterLog = MaintenanceLogAfter::factory()->create([
                        'maintenance_log_id' => $maintenanceLog->id
                    ]);

                    // Buat 2 detail maintenance sebelum maintenance selesai
                    MaintenanceLogDetail::factory()->count(2)->create([
                        'maintenance_log_id' => $maintenanceLog->id
                    ]);

                    // Buat 2 detail maintenance setelah maintenance selesai
                    MaintenanceLogAfterDetail::factory()->count(2)->create([
                        'maintenance_log_after_id' => $afterLog->id
                    ]);

                    // Buat 1 penggantian material setelah maintenance
                    MaterialReplacement::factory()->create([
                        'maintenance_log_after_id' => $afterLog->id
                    ]);
                });
            });

            // Buat 2 kegiatan harian untuk setiap laporan
            DailyActivity::factory()->count(2)->create([
                'report_id' => $report->id
            ])->each(function ($dailyActivity) {
                // Buat 1 masalah yang terjadi dalam kegiatan
                DailyProblem::factory()->create([
                    'activity_id' => $dailyActivity->id
                ]);
            });

            // Buat 2 tenaga kerja untuk setiap laporan
            ManPower::factory()->count(2)->create([
                'report_id' => $report->id
            ]);
        });
    }
}
