<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailReservationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:notify 
    { count : Number of Bookings to retrieve }
    { --dry-run= : To have this command do no actual work. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify reseservations holders';

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
        $answer = $this->choice('what service should we use' , ['email' , 'sms'] , 'email');
        var_dump($answer);
        $count = $this->argument('count');
        if(!is_numeric($count)){
            $this->alert('The count must be a Number');
            return 1;
        }
        $bookings = \App\Booking::with(['room.roomType' , 'users'])->limit($count)->get();
        $this->info(sprintf('the number of bookings is: %d', $bookings->count()));
        $bar = $this->output->createProgressBar($bookings->count());
        $bar->start();
        foreach($bookings as $booking){
            if($this->option('dry-run')){
                $this->info('   Would process booking');
            } else {
                $this->error('  Nothing happened');
            }
            $bar->advance();
        }
        $bar->finish();
        $this->comment('       Command Completed !          ');
    }
}
