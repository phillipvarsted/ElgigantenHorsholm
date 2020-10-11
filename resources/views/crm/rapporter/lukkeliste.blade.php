@extends('layouts.eg')

@section('url', 'Rapport - Lukkeliste')
@section('title', 'Rapport - Lukkeliste')

@section('actions')

<button type="button" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2" data-toggle="modal" data-target="#nyKundeopgave">Ny Todo</button>

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
                <h3 class="card-label">Vis lukkerapport for specifik dag</h3>
                </div>
            </div>
            @if($todos->count() != 0)
            <div class="card-body"> 
                <p>Vælg hvilken dag du vil se rapport for:</p>
                <div class="input-group date">
                    <input type="text" class="form-control" readonly="readonly">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-primary mr-2" disabled>Vis rapport</button>
            </div>
            @else
            <div class="card-body">
                <div class="alert alert-custom alert-notice alert-light-primary fade show" role="alert">
                    <div class="alert-icon"><i class="far fa-frown-open"></i></div>
                    <div class="alert-text">Øv.. Så snart jeg får mere data kan jeg genere en rapport til dig..</div>
                </div>
            </div>
            @endif
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END LUKKELISTER -->

@endsection

@section('page-scripts')
<script>
    $('.input-group.date').datepicker({
        language: "da",
        clearBtn: true,
        orientation: "bottom left",
        todayHighlight: true,
        forceParse: false,
        autoclose: true,
        toggleActive: true
    });
</script>
@endsection