
<?php



use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Notification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;
    public $trajet;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $message, $trajet)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->trajet = $trajet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('user.' . $this->userId),
        ];
    }

    public function broadcastAs()
    {
        return 'trajet.updated'; // Nom personnalisé de l'événement
    }
}