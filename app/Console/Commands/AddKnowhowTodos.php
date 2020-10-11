<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddKnowhowTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:knowhowtodos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically adding To Dos for the Knowhow department.';

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
        // $recurring_daily = DB::table('recurring_todos')->where('recurring_daily', 1)->get();

        // if($recurring_daily->count() > 0)
        // {
        //     foreach($recurring_daily as $td)
        //     {
        //         $todo = new Todo;
        //         $todo->todo = $td->todo;
        //         $todo->department_id = $td->department_id;
        //         $todo->due_date = Carbon::now()->format('Y-m-d') . ' 19:30:00';
        //         $todo->save();
        //     }
        // } else {
        //     return 0;
        // }

        $todos = DB::table('recurring_todos')->get();

        
    }
}
