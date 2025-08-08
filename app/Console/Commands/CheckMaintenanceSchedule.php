<?php

namespace App\Console\Commands;

use App\Models\Mobil;
use App\Models\User;
use App\Models\SentMaintenanceReminder;
use App\Notifications\MaintenanceReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CheckMaintenanceSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for upcoming car maintenance schedules and send notifications.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for upcoming maintenance schedules...');

        // Force the root URL for console commands to ensure correct URL generation
        URL::forceRootUrl(config('app.url'));

        $admins = User::all(); // Asumsi semua user adalah admin
        $reminderDays = [7, 3, 1]; // Kirim notifikasi 7, 3, dan 1 hari sebelum

        foreach ($reminderDays as $daysBefore) {
            $targetDate = Carbon::now()->addDays($daysBefore)->toDateString();

            $mobils = Mobil::whereDate('jadwal_perawatan_berikutnya', $targetDate)->get();

            if ($mobils->isEmpty()) {
                $this->info("No upcoming maintenance schedules found for the target date ({$targetDate}) for {$daysBefore} days before.");
                continue;
            }

            foreach ($mobils as $mobil) {
                // Check if a reminder has already been sent for this mobil and daysBefore
                $alreadySent = SentMaintenanceReminder::where('mobil_id', $mobil->id)
                                                    ->where('maintenance_date', $mobil->jadwal_perawatan_berikutnya)
                                                    ->where('reminder_days_before', $daysBefore)
                                                    ->exists();

                if (!$alreadySent) {
                    Notification::send($admins, new MaintenanceReminder($mobil, $daysBefore));
                    SentMaintenanceReminder::create([
                        'mobil_id' => $mobil->id,
                        'maintenance_date' => $mobil->jadwal_perawatan_berikutnya,
                        'reminder_days_before' => $daysBefore,
                        'sent_at' => Carbon::now(),
                    ]);
                    $this->info("Notification sent for: {$mobil->merk} {$mobil->tipe} ({$mobil->nopol}) - {$daysBefore} days before.");
                } else {
                    $this->info("Notification already sent for: {$mobil->merk} {$mobil->tipe} ({$mobil->nopol}) - {$daysBefore} days before. Skipping.");
                }
            }
        }

        $this->info('Finished checking maintenance schedules.');
    }
}