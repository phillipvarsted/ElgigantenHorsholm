@extends('layouts.eg')

@section('url', 'Rediger bruger')
@section('title')
Rediger: {{$user->name}}
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
                <form method="post" action="{{route('admin.users.update', ['id' => $user->id])}}">
                    @csrf
                    <div class="row">
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
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{$user->name}}" name="name">
                                </div>
                            </div>
                            <!--end::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Emailadresse</label>
                                <div class="col-9">
                                    <div class="input-group input-group-lg input-group-solid">
                                        <input type="text" class="form-control" placeholder="Brugernavn" value="{{$user->idm}}" name="idm">
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
                                <label class="col-3 col-form-label text-lg-right text-left">Roller</label>
                                <div class="col-9 col-form-label">
                                    <div class="checkbox-inline">
                                    @foreach ($roles as $role)
                                        <label class="checkbox checkbox-success">
                                        <input
                                            type="checkbox"
                                            @if ($role->assigned && !$role->isRemovable)
                                            class="form-checkbox focus:shadow-none focus:border-transparent text-gray-500 h-4 w-4"
                                            @else
                                            class="form-checkbox h-4 w-4"
                                            @endif
                                            name="roles[]"
                                            value="{{$role->id}}"
                                            {!! $role->assigned ? 'checked' : '' !!}
                                            {!! $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' !!}
                                        >
                                        <span class="ml-2 {!! $role->assigned && !$role->isRemovable ? 'text-gray-600' : '' !!}">
                                        </span>
                                        {{$role->display_name ?? $role->name}}
                                        </label>
                                    @endforeach                                   
                                    </div>
                                </div>
                            </div>

                            <!--begin::Group-->
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Skift adgangskode</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="password" value="" placeholder="Adgangskode" name="password">
                                </div>
                            </div>
                            <!--end::Group-->

                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success mr-2">Gem</button>
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

<!-- BEGIN LOGS -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Log</h3>
                </div>
            </div>
            <div class="card-body">
                @if($user->authentications()->count() == 0)
                    <span class="text-muted">Der findes ingen logs for brugeren, da brugeren aldrig har været aktiv.</span>
                @else

                    <table class="table">
                        <thead>
                            <tr>
                                <th>IP Address</th>
                                <th>Agent</th>
                                <th>Login at</th>
                                <th>Logout at</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($user->authentications()->paginate(10) as $a)
                                <tr>
                                    <td>{{$a->ip_address}}</td>
                                    <td>{{Str::limit($a->user_agent, 65, $end='...')}}</td>
                                    <td>{{$a->login_at}}</td>
                                    <td>{{$a->logout_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
            </div>
        </div>
        <!--end::Card-->    
    </div>
</div>
<!-- END BRUGER -->

@endsection