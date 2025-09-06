<?php

namespace App\Filament\Admin\Pages;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Chat extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Chat';
    protected static string $view = 'filament.admin.pages.chat';

    public $messages = [];
    public $newMessage = '';
    public $selectedEmployee = null;
    public $employees = [];

    public function mount(): void
    {
        // Fetch all users except admins
        $this->employees = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'super_admin')->orWhere('name', 'admin');
        })->get()->toArray();
    }

    public function getListeners(): array
    {
        return [
            "echo-private:private-chat." . Auth::id() . ",MessageSent" => 'messageReceived',
        ];
    }
    




    public function messageReceived($payload)
    {
        logger('Message received payload:', $payload); // 👈 debug log
        $this->messages[] = $payload['message'];
    }


    public function loadMessages()
    {
        if (! $this->selectedEmployee) return;

        $this->messages = Message::where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->selectedEmployee);
            })->orWhere(function ($q) {
                $q->where('sender_id', $this->selectedEmployee)
                  ->where('receiver_id', Auth::id());
            })
            ->with('sender')
            ->latest()
            ->take(20)
            ->get()
            ->reverse()
            ->toArray();
    }

    public function sendMessage(): void
    {
        if (! $this->selectedEmployee) return;

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedEmployee,
            'content' => $this->newMessage,
        ]);

        broadcast(new MessageSent($message));

        $this->newMessage = '';
        $this->messages[] = $message->load('sender')->toArray();
    }
}
