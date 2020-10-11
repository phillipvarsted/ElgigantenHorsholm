@extends('layouts.eg')

@section('url', 'Overblik')
@section('title', 'Overblik')

@section('actions')

@permission('create-kundeopgaver')
<button type="button" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2" data-toggle="modal" data-target="#nyKundeopgave">Ny kundeopgave</button>
@endpermission

@permission('create-service')
<button type="button" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2" data-toggle="modal" data-target="#nyService">Ny servicesag</button>
@endpermission

@endsection

@section('content')

@permission('read-kundeopgaver')
<!-- BEGIN KUNDEOPGAVER -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Åbne kundeopgaver <span class="label label-sm label-warning label-pill label-inline ml-3 font-weight-bold">Tidsfrister</span></h3>
                </div>
            </div>
            <div class="card-body">
                @if($kundeopgaver->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Salgs ID</th>
                            <th scope="col">Produkt</th>
                            <th scope="col">Service</th>
                            <th scope="col" class="w-150px">Status</th>
                            <th scope="col" class="w-250px">Tidsfrist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kundeopgaver as $ko)
                        <tr class="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ko->datetime) <= Carbon\Carbon::now() ? 'text-danger font-weight-bolder ' : ''}}h-50px" onclick="window.location='{{route('kundeopgaver.edit', ['id' => $ko->id])}}'" style="cursor:pointer;">
                            <th class="align-middle" scope="row">{{$ko->salgs_id}}</th>
                            <td class="align-middle">{{$ko->produkt}}</td>
                            <td class="align-middle">{{$ko->service->service}}</td>
                            <td class="align-middle"><span class="label label-inline label-{{$ko->label->label}} font-weight-bold">{{$ko->label->text}}</span></td>
                            <td class="align-middle">                                
                                {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ko->datetime)->diffForHumans(['parts' => 2])}}                         
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">Godt gået! Der er ingen åbne <strong>kundeopgaver</strong> tilbage!<br>Bliv ved med det fantastiske arbejde.</div>
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
<!-- END KUNDEOPGAVER -->
@endpermission

@permission('read-service')
<!-- BEGIN SERVICESAGER -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                <h3 class="card-label">Åbne servicesager <span class="label label-sm label-warning label-pill label-inline ml-3 font-weight-bold">Tidsfrister</span></h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($servicesager->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Varekode</th>
                            <th scope="col">Varenavn</th>
                            <th scope="col">Leverandør</th>
                            <th scope="col" class="w-150px">Status</th>
                            <th scope="col" class="w-250px">Tidsfrist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servicesager as $ss)
                        <tr class="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ss->created_at)->add(24, 'hour') <= Carbon\Carbon::now() ? 'text-danger font-weight-bolder ' : ''}}h-50px" onclick="window.location='{{route('kundeopgaver.edit', ['id' => $ss->id])}}'" style="cursor:pointer;">
                            <th class="align-middle" scope="row">{{$ss->ticket_nr}}</th>
                            <td class="align-middle">{{$ss->varekode}}</td>
                            <td class="align-middle">{{$ss->varenavn}}</td>
                            <td class="align-middle">{{$ss->leverandor}}</td>
                            <td class="align-middle"><span class="label label-inline label-{{$ss->label->label}} font-weight-bold">{{$ss->label->text}}</span></td>
                            <td class="align-middle">
                                @if($ss->kan_sendes === 1 && Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ss->updated_at)->add(24, 'hour') > Carbon\Carbon::now()->add(4, 'hours'))                                
                                    {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ss->updated_at)->add(24, 'hour')->diffForHumans(['parts' => 2])}}
                                @elseif($ss->kan_sendes === 1 && Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ss->updated_at)->add(24, 'hour') <= Carbon\Carbon::now()->add(6, 'hours'))                               
                                    <span class="text-danger">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ss->updated_at)->add(24, 'hour')->diffForHumans(['parts' => 2])}}</span>
                                @elseif($ss->kan_sendes === 0)
                                    <span class="text-muted">Afventer</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">Godt gået! Der er ingen åbne <strong>servicesager</strong> tilbage!<br>Bliv ved med det fantastiske arbejde.</div>
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
<!-- END SERVICESAGER -->
@endpermission

@role('cashier|manager')
<!-- BEGIN CASHIER TODOS -->
<div class="row">
    <div class="col-lg-12">
        
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header ribbon ribbon-right">
                <div class="ribbon-target bg-danger" style="top: 10px; right: -2px;">CASHIER</div>
                <div class="card-title">
                <h3 class="card-label">Kasse lukkeliste<span class="label label-sm label-danger label-pill label-inline ml-3 font-weight-bold">Skal klares hver dag</span></h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($todos->where('department_id', 2)->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">To Do</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="w-100px text-center">Færdig?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos->where('department_id', 2) as $td)
                        <tr class="h-50px{{$td->completed == 0 ? '' : ' bg-success-o-40'}}">
                            <td class="align-middle">{{$td->todo}}</td>
                            <td class="align-middle text-center">
                                @if($td->completed == 0)
                                    <span class="label label-inline label-light-dark font-weight-bold">Ikke klaret</span>
                                @else
                                    <span class="label label-inline label-success font-weight-bold">Klaret</span>
                                @endif
                            </td>
                            <td nowrap="nowrap" class="text-center">
                                @if($td->completed == 0)
                                <a href="{{route('home.todo.complete', $td->id)}}" class="btn btn-xs btn-light-success btn-icon todo-confirm" title="Færdiggør: {{$td->todo}}"><i class="la la-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">
                        <strong>Lukkelisten er tom!</strong><br>
                        Listen åbner hver morgen kl. <strong>08:00</strong> og lukker igen kl. <strong>19.30</strong>.
                    </div>
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
<!-- END CASHIER TODOS -->
@endrole

@role('aftersales|manager')
<!-- BEGIN AFTERSALES TODOS -->
<div class="row">
    <div class="col-lg-12">
        
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header ribbon ribbon-right">
                <div class="ribbon-target bg-success" style="top: 10px; right: -2px;">AFTERSALES</div>
                <div class="card-title">
                <h3 class="card-label">Lager lukkeliste<span class="label label-sm label-danger label-pill label-inline ml-3 font-weight-bold">Skal klares hver dag</span></h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($todos->where('department_id', 3)->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">To Do</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="w-100px text-center">Færdig?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos->where('department_id', 3) as $td)
                        <tr class="h-50px{{$td->completed == 0 ? '' : ' bg-success-o-40'}}">
                            <td class="align-middle">{{$td->todo}}</td>
                            <td class="align-middle text-center">
                                @if($td->completed == 0)
                                    <span class="label label-inline label-light-dark font-weight-bold">Ikke klaret</span>
                                @else
                                    <span class="label label-inline label-success font-weight-bold">Klaret</span>
                                @endif
                            </td>
                            <td nowrap="nowrap" class="text-center">
                                @if($td->completed == 0)
                                <a href="{{route('home.todo.complete', $td->id)}}" class="btn btn-xs btn-light-success btn-icon todo-confirm" title="Færdiggør: {{$td->todo}}"><i class="la la-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">
                        <strong>Lukkelisten er tom!</strong><br>
                        Listen åbner hver morgen kl. <strong>08:00</strong> og lukker igen kl. <strong>19.30</strong>.
                    </div>
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
<!-- END AFTERSALES TODOS -->
@endrole

@role('operations|manager')
<!-- BEGIN SUPPORT CENTER TODOS -->
<div class="row">
    <div class="col-lg-12">
        
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header ribbon ribbon-right">
                <div class="ribbon-target bg-primary" style="top: 10px; right: -2px;">SUPPORT CENTER</div>
                <div class="card-title">
                <h3 class="card-label">Support Center lukkeliste<span class="label label-sm label-danger label-pill label-inline ml-3 font-weight-bold">Skal klares hver dag</span></h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($todos->where('department_id', 1)->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">To Do</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="w-100px text-center">Færdig?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos->where('department_id', 1) as $td)
                        <tr class="h-50px{{$td->completed == 0 ? '' : ' bg-success-o-40'}}">
                            <td class="align-middle">{{$td->todo}}</td>
                            <td class="align-middle text-center">
                                @if($td->completed == 0)
                                    <span class="label label-inline label-light-dark font-weight-bold">Ikke klaret</span>
                                @else
                                    <span class="label label-inline label-success font-weight-bold">Klaret</span>
                                @endif
                            </td>
                            <td nowrap="nowrap" class="text-center">
                                @if($td->completed == 0)
                                <a href="{{route('home.todo.complete', $td->id)}}" class="btn btn-xs btn-light-success btn-icon todo-confirm" title="Færdiggør: {{$td->todo}}"><i class="la la-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">
                        <strong>Lukkelisten er tom!</strong><br>
                        Listen åbner hver morgen kl. <strong>08:00</strong> og lukker igen kl. <strong>19.30</strong>.
                    </div>
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
<!-- END SUPPORT CENTER TODOS -->
@endrole

<!-- BEGIN FÆLLES TODOS -->
<div class="row">
    <div class="col-lg-12">
        
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header ribbon ribbon-right">
                <div class="ribbon-target bg-info" style="top: 10px; right: -2px;">FÆLLES OPERATIONS</div>
                <div class="card-title">
                <h3 class="card-label">Fælles Operations lukkeliste<span class="label label-sm label-danger label-pill label-inline ml-3 font-weight-bold">Skal klares hver dag</span></h3>
                </div>
            </div>
            <div class="card-body"> 
                @if($todos->where('department_id', 10)->count() != 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">To Do</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="w-100px text-center">Færdig?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos->where('department_id', 10) as $td)
                        <tr class="h-50px{{$td->completed == 0 ? '' : ' bg-success-o-40'}}">
                            <td class="align-middle">{{$td->todo}}</td>
                            <td class="align-middle text-center">
                                @if($td->completed == 0)
                                    <span class="label label-inline label-light-dark font-weight-bold">Ikke klaret</span>
                                @else
                                    <span class="label label-inline label-success font-weight-bold">Klaret</span>
                                @endif
                            </td>
                            <td nowrap="nowrap" class="text-center">
                                @if($td->completed == 0)
                                <a href="{{route('home.todo.complete', $td->id)}}" class="btn btn-xs btn-light-success btn-icon todo-confirm" title="Færdiggør: {{$td->todo}}"><i class="la la-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-grin-hearts"></i></div>
                    <div class="alert-text">
                        <strong>Lukkelisten er tom!</strong><br>
                        Listen åbner hver morgen kl. <strong>08:00</strong> og lukker igen kl. <strong>19.30</strong>.
                    </div>
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
<!-- END FÆLELES TODOS -->

@endsection

@section('page-scripts')
<script>
$('.todo-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
        title: 'Vil du markere To Do som færdig?',
        text: 'Denne To Do vil blive markeret som færdig. Ændringen kan ikke fortrydes.',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#1BC5BD',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ja, færdig!',
        cancelButtonText: 'Nej'
    }).then(function(value) {
        if (value.isConfirmed) {
            window.location.href = url;
        }
    });
});
</script>
@endsection