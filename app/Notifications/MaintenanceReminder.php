<?php

namespace App\Notifications;

use App\Models\Mobil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Log;

class MaintenanceReminder extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    protected $mobil;
    protected $daysBefore;

    /**
     * Create a new notification instance.
     */
    public function __construct(Mobil $mobil, int $daysBefore)
    {
        $this->mobil = $mobil;
        $this->daysBefore = $daysBefore;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Mobil ' . $this->mobil->merk . ' ' . $this->mobil->tipe . ' (' . $this->mobil->nopol . ') memerlukan perawatan dalam ' . $this->daysBefore . ' hari.',
            'url' => route('admin.perawatans.create', ['mobil_id' => $this->mobil->id]),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => 'Mobil ' . $this->mobil->merk . ' ' . $this->mobil->tipe . ' (' . $this->mobil->nopol . ') memerlukan perawatan dalam ' . $this->daysBefore . ' hari.',
            'url' => route('admin.perawatans.create', ['mobil_id' => $this->mobil->id]),
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Broadcast ke channel privat untuk user yang sedang login
        // Asumsi user yang menerima notifikasi adalah user yang sedang login
        return [
            new \Illuminate\Broadcasting\Channel('maintenance-reminders'),
        ];
    }
}
