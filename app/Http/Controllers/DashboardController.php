<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Todo;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\Kundeopgave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kundeopgaver = Kundeopgave::where('status', '!=', '3')->orderBy('datetime', 'ASC')->get();
        $servicesager = Ticket::where('status', '!=', '3')->orderBy('created_at', 'DESC')->get();
        $todos = Todo::where('closed', '=', 0)->orderBy('todo', 'ASC')->get();

        return view('home', [
            'kundeopgaver' => $kundeopgaver,
            'servicesager' => $servicesager,
            'todos' => $todos,
        ]);
    }

    public function todoComplete($id)
    {
        $todo = Todo::find($id);
        $todo->completed = 1;
        $todo->user_id = Auth::user()->id;
        $todo->save();
        
        return redirect()->route('home')->with('toast_success', 'Fantastisk! To Do blevet markeret som færdig.');
    }

    public function logud()
    {
        auth()->logout();
        return redirect('/login')->with('toast_success', 'Du er nu logget ud.');
    }
}
