@extends('layouts.eg')

@section('url', 'Rediger service')
@section('title')
Rediger: {{$service->service}}
@endsection


@section('content')

<!-- BEGIN KUNDEOPGAVER -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Rediger</h3>
                </div>
            </div>
            <div class="card-body">
                
                <form class="form" method="post" action="{{route('admin.services.update', ['id' => $service->id])}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Servicetitel</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="servicetitel" value="{{$service->service}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Servicetekst</label>
                        <div class="col-lg-9 col-xl-6">
                            <textarea name="servicetekst" class="form-control" data-provide="markdown" rows="10">{{$service->tekst}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Gem</button>
                            <a href="{{route('admin.services.index')}}" class="btn btn-secondary">Tilbage</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END KUNDEOPGAVER -->

@endsection