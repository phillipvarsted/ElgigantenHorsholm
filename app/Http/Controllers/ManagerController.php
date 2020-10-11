<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function todosIndex()
    {
        $todos = DB::table('recurring_todos')->orderBy('department_id', 'ASC')->orderBy('todo', 'ASC')->get();

        return view('crm.lukkelister.index', [
            'todos' => $todos,
        ]);
    }

    public function rapporterTodosIndex()
    {
        $todos = Todo::where('due_date', '<', Carbon::now()->format('Y-m-d H:i:s'))->get();

        return view('crm.rapporter.lukkeliste', [
            'todos' => $todos,
        ]);
    }

    public function todosPost(Request $request)
    {
        DB::table('recurring_todos')->insert([
            'todo' => $request->todo,
            'department_id' => $request->department,
            'frequency_time' => '8:00',
            'frequency_weekdays' => '0,1,2,3,4,5,6'
        ]);

        return redirect()->route('manager.todos.index')->with('toast_success', 'Ny To Do er blevet oprettet!');
    }

    public function todosRediger($id)
    {
        $todo = DB::table('recurring_todos')->find($id);

        return view('crm.lukkelister.lukkelisteRediger', [
            'todo' => $todo,
        ]);
    }

    public function todosUpdate(Request $request, $id)
    {
        if($request->delete == 1)
        {
            $todo = DB::table('recurring_todos')->where('id', $id)
            ->delete();

            return redirect('/lukkelister')->with('toast_success', 'To do er blevet slettet!');
        } else
        {
            $todo = DB::table('recurring_todos')->where('id', $id)
            ->update([
                'todo' => $request->todo,
                'department_id' => $request->department
            ]);

            return redirect('/lukkelister')->with('toast_success', 'To do er blevet opdateret!');
        }
    }
}
