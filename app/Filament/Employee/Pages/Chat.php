<?php

namespace App\Filament\Employee\Pages;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Chat extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Chat';
    protected static string $view = 'filament.employee.pages.chat';

    public $messages = [];
    public $newMessage = '';

    public function mount(): void
    {
        $this->loadMessages();
    }

    public function getListeners(): array
    {
        return [
            "echo-private:private-chat." . Auth::id() . ",MessageSent" => 'messageReceived',
        ];
    }



    public function messageReceived($payload): void
    {
        logger('Message received payload:', $payload); 
        $this->messages[] = $payload['message'];
    }

    public function loadMessages(): void
    {
        $this->messages = Message::where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
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
    
        $admin = User::role(['super_admin', 'admin'])->first();

        if (! $admin) {
            return; 
        }

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $admin->id, 
            'content'     => $this->newMessage,
        ]);

        broadcast(new MessageSent($message));

        $this->messages[] = $message->load('sender')->toArray();

        $this->newMessage = '';
    }
}
