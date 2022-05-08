<?php

namespace App\Listeners;


// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\Backup\Events\BackupZipWasCreated;


class MailSuccessfulDatabaseBackup
{
    

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BackupZipWasCreated  $event
     * @return void
     */
    public function handle(BackupZipWasCreated $event)
    {
        $this->mailBackupFile($event->pathToZip);
    }

    public function mailBackupFile($path)
    {
        try {
            Mail::raw('Nuevo respaldo.',   function ($message) use ($path) {
                $message->to(env('MAIL_FROM_ADDRESS'))
                    ->subject('DB Auto Hecho')
                    ->attach($path);
            });
        } catch (\Exception $exception) {
            throw $exception;
        }

    }
}
