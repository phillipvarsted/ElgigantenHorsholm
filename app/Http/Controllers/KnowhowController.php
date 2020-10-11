<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;
use App\Models\Label;
use App\Models\Service;
use App\Models\Kundeopgave;
use Illuminate\Http\Request;
use App\Models\ExternalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KnowhowController extends Controller
{
    public function kundeopgaver()
    {
        if(!Auth::user()->isAbleTo('read-kundeopgaver'))
        {
            return back()->with('toast_error', 'Du har ikke tilladelse til at se kundeopgaver!');
        }

        $kundeopgaver = Kundeopgave::orderBy('datetime', 'DESC')->get();

        return view('crm.kundeopgaver.index', [
            'kundeopgaver' => $kundeopgaver,
        ]);
    }

    public function kundeopgaver_edit(Request $request, $id)
    {
        if(!Auth::user()->isAbleTo('update-kundeopgaver'))
        {
            return back()->with('toast_error', 'Du har ikke tilladelse til at redigere kundeopgaver!');
        }

        $kundeopgave = Kundeopgave::find($id);
        $kundeopgave_tekst = Service::where('service', '=', $kundeopgave->service)->first();
        $labels = Label::whereBetween('status', [1, 20])->get();
        $services = Service::all();
        $notes = Note::where('kundeopgave_id', '=', $id)->orderBy('created_at', 'DESC')->get();
        
        return view('crm.kundeopgaver.edit', [
            'kundeopgave' => $kundeopgave,
            'kundeopgave_tekst' => $kundeopgave_tekst,
            'labels' => $labels,
            'services' => $services,
            'notes' => $notes,
        ]);
    }

    public function kundeopgaverPost(Request $request)
    {   
        if(!Auth::user()->isAbleTo('create-kundeopgaver'))
        {
            return back()->with('toast_error', 'Du har ikke tilladelse til at oprette kundeopgaver!');
        }

        $validator = Validator::make($request->all(), [
            'salgs_id' => 'required|numeric',
            'produkt' => 'required',
            'service' => 'required|not_in:0',
        ]);

        if($validator->fails())
        {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $kundeopgave = new Kundeopgave;

        $kundeopgave->salgs_id = $request->salgs_id;
        $kundeopgave->produkt = $request->produkt;
        $kundeopgave->service_id = $request->service;
        $kundeopgave->status = 1;
        $kundeopgave->ekstra = $request->ekstra;
        $kundeopgave->created_by = Auth::user()->name;
        $kundeopgave->datetime = Carbon::now()->add($kundeopgave->service->promised_hours, 'hours')->format('Y-m-d H:i:s');

        $kundeopgave->save();

        return redirect('/')->with('toast_success', 'Kundeopgaven er blevet oprettet!');
    }

    public function kundeopgaverNotePost(Request $request, $id)
    {
        if(!Auth::user()->isAbleTo('create-kundeopgaver'))
        {
            return back()->with('toast_error', 'Du har ikke tilladelse til at oprette kundeopgaver!');
        }

        $note = new Note;

        $note->kundeopgave_id = $id;
        $note->user_id = Auth::user()->id;
        $note->note = $request->note;

        $note->save();

        return back()->with('toast_success', 'Note tilføjet!');
    }

    public function kundeopgaverUpdate(Request $request, $id)
    {
        if(!Auth::user()->isAbleTo('update-kundeopgaver'))
        {
            return back()->with('toast_error', 'Du har ikke tilladelse til at redigere kundeopgaver!');
        }

        $kundeopgave = Kundeopgave::find($id);

        $kundeopgave->ekstra = $request->ekstra;
        $kundeopgave->status = $request->status;

        $kundeopgave->save();

        return back()->with('toast_success', 'Kundeopgave er opdateret!');
    }

    public function externalServicePost(Request $request)
    {
        $service = new ExternalService;

        $service->bluecare_ticket_nr = $request->bluecare_ticket_nr;
        $service->varekode = $request->varekode;
        $service->vare = $request->vare;
        $service->ejer = $request->ejer;

        dd($service);
    }
}
