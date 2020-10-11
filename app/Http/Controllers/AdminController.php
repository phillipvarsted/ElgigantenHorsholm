<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Laratrust\Helper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $rolesModel;
    protected $permissionModel;
    protected $assignPermissions;

    public function __construct()
    {
        $this->rolesModel = Config::get('laratrust.models.role');
        $this->permissionModel = Config::get('laratrust.models.permission');
        $this->assignPermissions = Config::get('laratrust.panel.assign_permissions_to_user');
    }
    
    public function servicesIndex()
    {
        $services = Service::orderBy('service', 'ASC')->get();

        return view('crm.admin.servicesIndex', [
            'services' => $services,
        ]);
    }

    public function servicesEdit(Request $request, $id)
    {
        $service = Service::find($id);

        return view('crm.admin.servicesEdit', [
            'service' => $service,
        ]);
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service = Service::find($id);

        $service->service = $request->servicetitel;
        $service->tekst = $request->servicetekst;

        $service->save();

        return redirect()->back();
    }

    public function usersIndex()
    {
        $users = User::all();

        return view('crm.admin.usersIndex', [
            'users' => $users,
        ]);
    }

    public function usersEdit(Request $request, $id)
    {
        $user = User::find($id);
        $roles = $this->rolesModel::orderBy('name')->get(['id', 'name', 'display_name'])
        ->map(function ($role) use ($user) {
            $role->assigned = $user->roles
            ->pluck('id')
                ->contains($role->id);
            $role->isRemovable = Helper::roleIsRemovable($role);

            return $role;
        });

        return view('crm.admin.usersEdit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function usersUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'idm' => [
                'required',
                'alpha',
                Rule::unique('users')->ignore($id),
            ],
            'password' => [
                Rule::requiredIf($request->get('password') != ''),
            ],
        ]);

        if($validator->fails())
        {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $user = User::findOrFail($id);
        $user->syncRoles($request->get('roles') ?? []);
        if ($this->assignPermissions) {
            $user->syncPermissions($request->get('permissions') ?? []);
        }

        if($request->get('password') != '')
        {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->idm = $request->idm;

        $user->save();

        return redirect('/admin/users')->with('toast_success', 'Brugeren blev opdateret!');
    }
    
    public function usersCreate()
    {
        return view('crm.admin.usersCreate');
    }

    public function usersPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'idm' => 'required|alpha|unique:users,idm',
            'password' => 'required|min:5'
        ]);

        if($validator->fails())
        {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $user = new User;

        $user->name = $request->name;
        $user->idm = $request->idm;
        $user->email = $request->idm . '@giganten.dk';
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/admin/users')->with('toast_success', 'Brugeren blev tilføjet!');
    }

    public function usersActAs($user_id)
    {
        Auth::user()->impersonate($user_id);
        return back();
    }
}
