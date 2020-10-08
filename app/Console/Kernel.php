<?php

namespace App\Console;

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
        \App\Console\Commands\EmailReservationsCommand::class,
    ];
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
        $schedule->command('env')
            ->everyMinute()
            ->environments(['local'])
            ->runInBackground()
            ->appendOutputTo('/home/vagrant/code/storage/logs/env.log')
            ->after(function() { return true; });
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
