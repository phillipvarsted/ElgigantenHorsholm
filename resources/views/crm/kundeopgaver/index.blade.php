@extends('layouts.eg')

@section('url', 'Kundeopgaver')
@section('title', 'Kundeopgaver')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-favourite text-primary"></i>
                    </span>
                    <h3 class="card-label">Kundeopgaver - tasks</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus"></i>Ny opgave</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable" id="egKundeopgaver" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <th>Salgs ID</th>
                            <th>Produkt</th>
                            <th>Service</th>
                            <th class="w-120px">Status</th>
                            <th>Tidsfrist</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kundeopgaver as $ko)
                            <tr>
                                <td>{{$ko->salgs_id}}</td>
                                <td>{{$ko->produkt}}</td>
                                <td>{{$ko->service->service}}</td>
                                <td class="text-center"><span class="label label-inline label-{{$ko->label->label}} font-weight-bold">{{$ko->label->text}}</span></td>
                                <td>
                                    @if($ko->status === 3)
                                    <span class="text-muted">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ko->datetime)->diffForHumans()}}</span>
                                    @else
                                    {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ko->datetime)->diffForHumans()}}
                                    @endif
                                </td>
                                <td nowrap="nowrap">
                                    <a href="{{route('kundeopgaver.edit', ['id' => $ko->id])}}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>

@endsection