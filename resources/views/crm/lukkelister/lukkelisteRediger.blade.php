@extends('layouts.eg')

@section('url', 'Rediger To do')
@section('title', 'Rediger To do')

@section('actions')



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
                <h3 class="card-label">Lukkeliste</h3>
                </div>
            </div>
            <form action="{{route('manager.lukkeliste.update', ['id' => $todo->id])}}" method="post">
                @csrf
                <div class="card-body"> 
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>To Do:</label>
                            <input type="text" name="todo" class="form-control" placeholder="ex. Quality Inspection skal være tom..." value="{{$todo->todo}}">
                            <span class="form-text text-muted">Beskrivelse af lukkerutinen for denne To Do</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Afdeling:</label>
                            <select class="form-control" id="exampleSelect1" name="department">
                                <option value="">Vælg afdeling..</option>
                                <option value="1"{{$todo->department_id == 1 ? 'selected' : ''}}>Support Center</option>
                                <option value="2"{{$todo->department_id == 2 ? 'selected' : ''}}>Cashier</option>
                                <option value="3"{{$todo->department_id == 3 ? 'selected' : ''}}>Aftersales</option>
                                <option value="10"{{$todo->department_id == 10 ? 'selected' : ''}}>Fælles Operations</option>
                            </select>
                            <span class="form-text text-muted">Angiv hvilken afdeling rutinen er gældende for</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Gentages hver:</label>
                            <div class="checkbox-inline mt-3">

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="1" checked disabled>
                                <span></span>Man</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="2" checked disabled>
                                <span></span>Tirs</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="3" checked disabled>
                                <span></span>Ons</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="4" checked disabled>
                                <span></span>Tors</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="5" checked disabled>
                                <span></span>Fre</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="6" checked disabled>
                                <span></span>Lør</label>

                                <label class="checkbox checkbox-lg checkbox-success">
                                <input type="checkbox" name="frequency_weekdays[]" value="0" checked disabled>
                                <span></span>Søn</label>

                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label>Starttid:</label>
                            <input type="email" class="form-control" value="8:00" disabled>
                        </div>

                        <div class="col-lg-3">
                            <label>Sluttid:</label>
                            <input type="email" class="form-control" value="19:45" disabled>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-5"></div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Vil du slette denne To Do?</label>
                            <div class="checkbox-inline mt-3">

                                <label class="checkbox checkbox-lg checkbox-danger">
                                <input type="checkbox" name="delete" value="1">
                                <span></span>Ja</label>

                            </div>
                        </div>
                    </div>

                </div>

                

                <div class="card-footer">
                    <div class="row">
                        <div class="col text-left">
                            <button type="submit" class="btn btn-success mr-2">Gem</button>
                            <button type="reset" class="btn btn-secondary">Annuller</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END LUKKELISTER -->

@endsection