@extends('layouts.eg')

@section('url', 'Rediger kundeopgave')
@section('title')
{{$kundeopgave->service->service}} - {{$kundeopgave->produkt}} - {{$kundeopgave->salgs_id}}
@endsection

@section('content')

<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="d-flex">
            <!--begin: Info-->
            <div class="flex-grow-1">
                <!--begin: Content-->
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
                        @if($kundeopgave->service->tekst == '')
                            Der er ikke oprettet nogen beskrivelse af servicen endnu..
                        @else
                            @parsedown($kundeopgave->service->tekst)
                        @endif
                    </div>
                    <div class="d-flex flex-wrap align-items-center py-2">
                        <div class="d-flex align-items-center mr-5">
                            <div class="mr-6">
                                <div class="font-weight-bold mb-2">Startdato</div>
                                <span class="btn btn-sm btn-text btn-light-primary font-weight-bold">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kundeopgave->created_at)->format('j. F Y, H:i')}}</span>
                            </div>
                            <div class="mr-6">
                                <div class="font-weight-bold mb-2">Tidsfrist</div>
                                <span class="btn btn-sm btn-text btn-light-danger font-weight-bold">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kundeopgave->datetime)->format('j. F Y, H:i')}}</span>
                            </div>
                            <div class="">
                                <div class="font-weight-bold mb-2">Status</div>
                                <span class="btn btn-sm btn-text btn-{{$kundeopgave->label->label}} font-weight-bold">{{$kundeopgave->label->text}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Content-->
            </div>
            <!--end: Info-->
        </div>
    </div>
</div>

@if($kundeopgave->status == 3)
    <div class="alert alert-danger gutter-b" role="alert">
        Kundeopgaven er afsluttet og kan ikke ændres længere. Skal der foretages ændringer skal der oprettes en ny kundeopgave i stedet for.
    </div>
@endif

<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header card-header-tabs-line">
        <div class="card-toolbar">
            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                <li class="nav-item mr-3">
                    <a class="nav-link active" data-toggle="tab" href="#tab-detaljer">
                        <span class="nav-icon mr-2">
                            <span class="svg-icon mr-3">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Chat-check.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="nav-text font-weight-bold">Opgavedetaljer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-noter">
                        <span class="nav-icon mr-2">
                            <span class="svg-icon mr-3">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Notification2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"></path>
                                        <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="nav-text font-weight-bold">Noter</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <div class="tab-content pt-5">
            <!--begin::Tab Content-->
            <div class="tab-pane active" id="tab-detaljer" role="tabpanel">
                <form class="form" method="post" action="{{route('kundeopgaver.update', ['id' => $kundeopgave->id])}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9 col-xl-6 offset-xl-3">
                            <h3 class="font-size-h6 mb-5">Opgaveinfo:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Salgs ID</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$kundeopgave->salgs_id}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Service type</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" disabled>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}" {{$kundeopgave->service_id == $service->id  ? 'selected' : ''}}>{{$service->service}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Produkt</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$kundeopgave->produkt}}" name="produkt" disabled>
                        </div>
                    </div>
                    @role('administrator')
                    <div class="separator separator-dashed my-10"></div>
                    <div class="row">
                        <div class="col-lg-9 col-xl-6 offset-xl-3">
                            <h3 class="font-size-h6 mb-5">Yderligere oplysninger:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Ekstra info</label>
                        <div class="col-lg-9 col-xl-6">
                            <textarea id="" rows="8" class="form-control form-control-lg form-control-solid" name="ekstra">{!! $kundeopgave->ekstra !!}</textarea>
                        </div>
                    </div>
                    @endrole
                    <div class="separator separator-dashed my-10"></div>
                    <!--begin::Heading-->
                    <div class="row">
                        <div class="col-lg-9 col-xl-6 offset-xl-3">
                            <h3 class="font-size-h6 mb-5">Opdateringer:</h3>
                        </div>
                    </div>
                    <!--end::Heading-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Status</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" name="status">
                                @foreach($labels as $label)
                                    <!-- <option value="id">{{$label->text}}</option> -->
                                    <option value="{{$label->status}}" {{$kundeopgave->status == $label->status  ? 'selected' : ''}}>{{$label->text}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Oprettet af</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{$kundeopgave->created_by}}, {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kundeopgave->created_at)->format('d.m.Y \k\l\. H:i')}}" name="produkt" disabled>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>

                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2"{{$kundeopgave->status == 3 ? ' disabled' : ''}}>Gem</button>
                            <a href="{{route('home')}}" class="btn btn-secondary">Tilbage</a>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Tab Content-->
            
            <!--begin::Tab Content-->
            @role('administrator')
            <div class="tab-pane" id="tab-noter" role="tabpanel">
                <div class="container">
                    <form class="form" method="post" action="{{route('kundeopgaver.note.post', ['id' => $kundeopgave->id])}}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-solid" id="note" rows="3" placeholder="Hvad er udført? Hvad mangler? Uddyb.." name="note"></textarea>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-light-primary font-weight-bold">Tilføj note</button>
                                <button type="reset" class="btn btn-clean font-weight-bold">Nulstil</button>
                            </div>
                        </div>
                    </form>
                    <div class="separator separator-dashed my-10"></div>
                    <!--begin::Timeline-->
                    <div class="timeline timeline-3">
                        <div class="timeline-items">
                            @foreach($notes as $note) 
                            <div class="timeline-item">
                                <div class="timeline-media">
                                    <i class="flaticon2-chat fl pt-2 text-primary"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="mr-2 mt-3">
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">{{$note->user->name}}</a>
                                            <span class="text-muted ml-2">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $note->created_at)->format('j. F Y H:i')}}</span>
                                        </div>
                                    </div>
                                    <p class="p-0">{{$note->note}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Timeline-->
                </div>
            </div>
            @endrole
            <!--end::Tab Content-->
        </div>
    </div>
    <!--end::Body-->
</div>

@endsection