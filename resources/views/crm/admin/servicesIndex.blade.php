@extends('layouts.eg')

@section('url', 'Services')
@section('title', 'Services')


@section('content')

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
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Service</th>
                            <th scope="col" class="w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td class="align-middle">{{$service->service}}</td>
                            <td nowrap="nowrap">
                                <a href="{{route('admin.services.edit', ['id' => $service->id])}}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END KUNDEOPGAVER -->

@endsection