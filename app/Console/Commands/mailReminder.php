<?php

namespace Brood\Console\Commands;

use Mail;
use Brood\Models\User;
use Illuminate\Console\Command;

class mailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail order reminder to all users';

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
        $users = User::select('email', 'name')->get();

        foreach ($users as $user) {
            
            $data = [
                'to' => $user->email,
                'name' => $user->name,
                'from' => 'mail@brood.iewan.nl',
                'subject' => 'broodbestel reminder',
            ];

            Mail::send('user.email.reminder', $data, function($mail) use ($data) {
                $mail->to($data['to']);
                $mail->from($data['from']);
                $mail->subject($data['subject']);

            });

        }
    }
}
