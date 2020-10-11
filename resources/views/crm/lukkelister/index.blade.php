@extends('layouts.eg')

@section('url', 'Lukkelister')
@section('title', 'Lukkelister - To Do')

@section('actions')

<button type="button" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2" data-toggle="modal" data-target="#nyTodoRecurring">Ny To Do</button>

@endsection

@section('content')

<!-- BEGIN LUKKELISTER -->
<div class="row">
    <div class="col-lg-12">
        
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header ribbon ribbon-right">
                <div class="ribbon-target bg-warning" style="top: 10px; right: -2px;">Beta - progress</div>
                <div class="card-title">
                <h3 class="card-label">Lukkelister for afdelinger</h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($todos->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">To Do</th>
                            <th scope="col">Afdeling</th>
                            <th scope="col">Ugedage</th>
                            <th scope="col">Starttid</th>
                            <th scope="col">Sluttid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $td)
                        <tr class="h-40px" onclick="window.location='{{route('manager.lukkeliste.rediger', ['id' => $td->id])}}'" style="cursor:pointer;">
                            <td class="align-middle">{{$td->todo}}</td>
                            <td class="align-middle">
                                @if($td->department_id == 1)
                                    <span class="label label-inline label-primary font-weight-bold">Support Center</span>
                                @elseif($td->department_id == 2)
                                    <span class="label label-inline label-danger font-weight-bold">Cashier</span>
                                @elseif($td->department_id == 3)
                                    <span class="label label-inline label-success font-weight-bold">Aftersales</span>
                                @elseif($td->department_id == 10)
                                    <span class="label label-inline label-warning font-weight-bold">Fælles Ops</span>
                                @endif
                            </td>
                            <td class="align-middle">{{$td->frequency_weekdays}}</td>
                            <td class="align-middle">{{$td->frequency_time}}</td>
                            <td class="align-middle">kl. 20:00</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-warning fade show" role="alert">
                    <div class="alert-icon"><i class="fas fa-clipboard-check"></i></div>
                    <div class="alert-text">Der findes ingen gentagende To Do lister. Du kan oprette nogle ved at klikke på <strong>Ny To Do</strong> oppe til højre.</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END LUKKELISTER -->

@endsection