<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('add:knowhowtodos')->dailyAt('08:00');
        // $schedule->command('remove:knowhowtodosoverdue')->dailyAt('21:00');

        $todos = DB::table('recurring_todos')->get();

        foreach($todos as $td)
        {
            $schedule->call(function()  use($td){
                
                $todo = new Todo;
                $todo->todo = $td->todo;
                $todo->due_date = Carbon::now()->format('Y-m-d') . ' 19:30:00';
                $todo->department_id = $td->department_id;
                $todo->completed = 0;
                
                $todo->save();
                
            })->days($td->frequency_weekdays)->at($td->frequency_time);
        }

        $schedule->command('remove:knowhowtodosoverdue')->dailyAt('19:30');
        $schedule->command('set:todosclosed')->dailyAt('19:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
