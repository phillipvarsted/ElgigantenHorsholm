@extends('layouts.eg')

@section('url', 'Brugere')
@section('title', 'Brugere')

@section('actions')
<a href="{{route('admin.users.create')}}" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Tilføj bruger</a>
@endsection

@section('content')

<!-- BEGIN BRUGERE -->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Alle brugere</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="w-450px">Service</th>
                            <th scope="col" class="w-350px">Rolle</th>
                            <th scope="col">Område</th>
                            <th scope="col" class="w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="align-middle">{{$user->name}}</td>
                            <td class="align-middle text-muted">
                                @foreach($user->roles as $roles)
                                    {{$roles->display_name}}
                                @endforeach
                            </td>
                            <td class="align-middle text-muted">Lager</td>
                            <td nowrap="nowrap">
                                <a href="{{route('admin.users.edit', ['id' => $user->id])}}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-trash"></i></a>
                                <a href="{{route('admin.users.act.as', $user->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-star"></i></a>
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