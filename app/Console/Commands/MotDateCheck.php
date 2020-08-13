<?php

namespace App\Console\Commands;

use App\cars;
use App\User;
use Carbon\Carbon;

use App\Notifications\CarsNotification;
use App\Notifications\UserDateNotification;



use Illuminate\Console\Command;

class MotDateCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mot:now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        error_log('hit 0');
        $cars = cars::all();
        $seven_days = Carbon::now()->add(7, 'days');
        foreach($cars as $car){
            sleep(2);
            if ($car -> request == 1 && $seven_days->diffInDays($car->mot)<8)
            {
                error_log('hit 1');
                if($car->notifications->first() == null){
                    $car->notify(new CarsNotification($car));
                    $user = User::where('id', $car->user_id)->first();
                    $user->notify(new UserDateNotification($car->mot_time));
                    
                };                


            } 
        } 

    }
}
