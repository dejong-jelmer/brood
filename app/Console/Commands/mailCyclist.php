<?php

namespace Brood\Console\Commands;

use Mail;
use Brood\Models\User;
use Spatie\GoogleCalendar\Event;

use Illuminate\Console\Command;

class mailCyclist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:cyclist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail a reminder to cyclist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = Event::get();
        $event = $events->first();
        $event_name = $event->name;

        $user = User::select('name', 'email')->where('name', $event_name)->first();

        if($user) {

            $data = [
                'to' => $user->email,
                'name' => $user->name,
                'from' => 'mail@brood.iewan.nl',
                'subject' => 'Volgende fietsdienst',
            ];

            Mail::send('user.email.cyclist', $data, function($mail) use ($data) {
                $mail->to($data['to']);
                $mail->from($data['from']);
                $mail->subject($data['subject']);
            });
        } else {
            return null;
        }
    }
}
