@extends('layouts.eg')

@section('url', 'Tilføj bruger')
@section('title')
Tilføj ny bruger
@endsection


@section('content')

<!-- BEGIN BRUGER -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Bruger</h3>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.users.post')}}">
                    <div class="row">
                        @csrf
                        <div class="col-xl-2"></div>
                        <div class="col-xl-7 my-2">
                            <!--begin::Row-->
                            <div class="row">
                                <label class="col-3"></label>
                                <div class="col-9">
                                    <h6 class="text-dark font-weight-bold mb-10">Brugerinformation:</h6>
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Fulde navn</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="Fulde navn" name="name">
                                </div>
                            </div>
                            <!--end::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Emailadresse</label>
                                <div class="col-9">
                                    <div class="input-group input-group-lg input-group-solid">
                                        <input type="text" class="form-control" placeholder="Brugernavn" name="idm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">@giganten.dk</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Område</label>
                                <div class="col-9">
                                    <select class="form-control form-control-lg form-control-solid">
                                        <option>Vælg område..</option>
                                        <option value="id">Lager</option>
                                        <option value="id">Kasse</option>
                                        <option value="id">Knowhow</option>
                                        <option value="id">Salg</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Rolle</label>
                                <div class="col-9">
                                    <select class="form-control form-control-lg form-control-solid">
                                        <option>Vælg rolle..</option>
                                        <option value="id">Medarbejder</option>
                                        <option value="id">Leder</option>
                                        <option value="id">Salg</option>
                                        <option value="id">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Adgangskode</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Adgangskode" name="password">
                                </div>
                            </div>
                            <!--end::Group-->

                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success mr-2">Tilføj bruger</button>
                                    <a href="{{route('admin.users.index')}}" class="btn btn-secondary">Tilbage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END BRUGER -->

@endsection