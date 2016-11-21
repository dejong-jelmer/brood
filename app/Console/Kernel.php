<?php

namespace Brood\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'Brood\Console\Commands\mailReminder',
        'Brood\Console\Commands\mailCyclist',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // $schedule->command('mail:reminder')->everyMinute();
        
        // Scheduled mail to users to remind them it's the day orders are going to be send.
        $schedule->command('mail:reminder')->weekly()->sundays()->at('9:00');
        $schedule->command('mail:reminder')->weekly()->wednesdays()->at('9:00');

        // Scheduled mail to cyclist to remind him/her they are next on the schedule to go and pick up the orders.
        $schedule->command('mail:cyclist')->weekly()->mondays()->at('18:00');
        $schedule->command('mail:cyclist')->weekly()->thursdays()->at('18:00');

        $schedule->command('mail:cyclist')->everyMinute();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
