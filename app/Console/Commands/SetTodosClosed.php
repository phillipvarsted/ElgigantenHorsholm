<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetTodosClosed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:todosclosed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set all todos that expires to closed.';

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
        $todos = Todo::where('due_date', '<', Carbon::now()->format('Y-m-d H:i:s'))->get();

        if($todos->count() > 0)
        {
            foreach($todos as $td)
            {
                $todo = Todo::find($td->id);
                $todo->closed = 1;
                
                $todo->save();
            }
        } else {
            return 0;
        }
    }
}
