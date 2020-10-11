<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Console\Command;

class RemoveKnowhowTodosOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:knowhowtodosoverdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the overdue To Dos in Knowhow.';

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
        $todos = Todo::where('due_date', '<', Carbon::now()->format('Y-m-d H:i:s'))->where('completed', '=', 0)->get();

        if($todos->count() > 0)
        {
            foreach($todos as $td)
            {
                $todo = Todo::find($td->id);
                $todo->over_due = 1;
                
                $todo->save();
            }
        } else {
            return 0;
        }
    }
}
