<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Candidature;

class ApplicationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $candidature;

    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statusName = $this->candidature->state->name;
        $jobTitle = $this->candidature->offerPost->title;

        return (new MailMessage)
            ->subject('Mise à jour du statut de votre candidature')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Le statut de votre candidature pour le poste : ' . $jobTitle . ' a été mis à jour.')
            ->line('Nouveau statut : ' . $statusName)
            ->line('Vous pouvez suivre l’état de votre candidature via votre tableau de bord.')
            ->action('Voir les détails de la candidature', url('/dashboard/applications'))
            ->line('Merci d’utiliser notre plateforme de recrutement !');
    }
}
