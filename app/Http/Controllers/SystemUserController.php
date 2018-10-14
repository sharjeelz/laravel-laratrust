<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use App\Role;
use App\User;
use DateTime;
use App\Hospital;
use Carbon\Carbon;
use App\Permission;
use App\Mail\Mailer;
use App\Events\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllRoles()
    {
        $condition = ['type' => null];
        return Role::where($condition)->get();
    }

    public function getAllPermissions()
    {
        $condition = ['type' => null];
        return Permission::where($condition)->get();
    }

    /**
     * Display a listing of the System Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $get_all_users = User::withTrashed()->get();
        $all_roles = $this->getAllRoles();
        $all_permissions = $this->getAllPermissions();
        $is_valid_to_send_reset_pass;
        foreach ($get_all_users->sortByDesc('created_at') as $user) {

            $is_valid_to_send_reset_pass = $this->checkEmailForPassReset($user->email);
            $user_data[] = array('users' => $user, 'pexpiry' => $is_valid_to_send_reset_pass);
        }

        return view('sysuser.users')->with(['data' => $user_data, 'roles' => $all_roles, 'permissions' => $all_permissions]);
    }

    public function sendEmail(Request $request, $to)
    {
        $user = User::withTrashed()->findOrFail($to);

        Mail::to($user->email)
            ->cc($request->input('cc'))
            ->queue(new Mailer($request, $user->name)
            );
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Email Sent');
        return back();

    }

    public function checkEmailForPassReset($email)
    {
        $results = DB::select(DB::raw("SELECT * FROM password_resets WHERE email = '$email'"));

        if (!empty($results)) {

            $created_at = $results[0]->created_at;
            $current_date = new DateTime();
            $created_at = new DateTime($created_at);
            $since_start = $created_at->diff($current_date);
            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            $minutes += $since_start->i;

            if ($minutes > env('PASSWORD_EXPIRE_MINUTES')) {

                return true;
            } else {

                return false;
            }
        } else {

            // user is never asked for changing password
            return true;
        }
    }

    /**
     * Display a listing of the System Permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function Permissionsindex()
    {
        $condition = ['type' => null];
        $get_all_permissions = Permission::where($condition)->get()->sortByDesc('created_at');

        return view('sysuser.permissions')->withPermissions($get_all_permissions);
    }


    /**
     * Display a listing of the System Roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function Rolesindex()
    {
        $condition = ['type' => null];
        $get_all_roles = Role::where($condition)->get()->sortByDesc('created_at');
        return view('sysuser.roles')->withRoles($get_all_roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRole()
    {
        return view('sysuser.create-role');
    }

    /**
     * Store Role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $role = new Role();
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();
        event(new UserEvent($role, UserEvent::ADDED));
        return redirect('admin/roles');
    }

    public function destroyRole(Request $request)
    {
        $role_id = $request->get('id');
        $role = Role::find($role_id);
        $event = 'Deleted';
        event(new UserEvent($role, UserEvent::DELETED));
        $role->delete();
        return $role_id;
    }

    /**
     * Assign Roles To User
     *
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request)
    {
        $params = array();
        parse_str($request->get('data'), $params);
        if (isset($params['user_roles'])) {
            $roles_user = $params['user_roles'];
        } else {

            $roles_user = [];
        }

        $user_id = $params['user_id'];
        $user = User::find($user_id);

        if ($user) {
            $guest = Role::where('name', '=', 'guest')->first();
            $user->syncRoles($roles_user);
            $user->attachRole($guest);
            return $user_id;
        } else {
            return '0';
        }
    }

    /**
     * Assign Permissions To USer
     *
     * @return \Illuminate\Http\Response
     */
    public function assignPermission(Request $request)
    {
        $params = array();
        parse_str($request->get('data'), $params);
        $user_id = $params['user_id'];
        $user = User::find($user_id);
        if ($user) {

            if (empty($params['user_permissions'])) {

                $user->detachPermissions(null);
            } else {
                $permission_user = $params['user_permissions'];
                $user->syncPermissions($permission_user);
                return $user_id;

            }
        } else {
            return '0';
        }
    }



    /**
     * Show the form for creating a new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPermission()
    {

        return view('sysuser.create-permission');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {

        return view('sysuser.create-user');
    }

    /**
     * Show the User Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile($user_id)
    {

        $user = User::withTrashed()->findOrFail($user_id);
        if ($user) {
            return view('sysuser.user')->withUser($user);
        }
    }

    /**
     * Update User Profile
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfileUpdate(Request $request, $id)
    {
        $input = $request->all();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'pic' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($request->hasFile('pic')) {

            $path = $request->file('pic')->store(
                'avatars', 'public'
            );
        } else {
            $path = 'avatars/noimage.png';
        }
        $user = User::withTrashed()->findOrFail($id);
        $user->name = $input['name'];
        $user->email = $input['email'];

        if ($request->hasFile('pic')) {
            $user->pic = $path;
        }
        $user->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'User Updated');
        return redirect()->back();
    }



    /**
     * Store Permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {

        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->display_name = $request->get('display_name');
        $permission->description = $request->get('description');
        $permission->save();
        event(new UserEvent($permission, UserEvent::ADDED));
        return redirect('admin/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroyUser(Request $request)
    {
        $user_id = $request->get('id');
        //soft delete
        $user = User::find($user_id);
        $user->delete();
        event(new UserEvent($user, UserEvent::BLOCKED));
        return $user_id;
    }

    public function destroyUsers(Request $request)
    {
        $user_id = $request->get('data');
        //soft delete
        foreach ($user_id as $uid) {

            $user = User::find($uid);
            $user->delete();

        }

        event(new UserEvent($user, UserEvent::BLOCKED));


        return '0';

    }

    public function exportUsers(Request $request)
    {
        $data = $request->get('data');
        $filename = "users-" . Carbon::today()->toDateString() . ".csv";
        $ids = explode(',', $data[0]);
        $users = [];
        $csvExporter = new \Laracsv\Export(null, $filename);
        $users = User::withTrashed()->find($ids);
        $csvExporter->build($users, ['email', 'name', 'created_at', 'updated_at', 'deleted_at', 'pic'])->download();
        return redirect('admin/users');

    }
    public function exportLogins($id)
    {
        $auth_logs = User::withTrashed()->find($id)->authentications;
        $filename = "Login-Logout-activity-of-" . str_replace(' ', '', $auth_logs[0]->authenticatable->name) . ".csv";
        $csvExporter = new \Laracsv\Export(null, $filename);
        $csvExporter->build($auth_logs, ['authenticatable.name' => 'Name', 'authenticatable.email' => 'Email', 'ip_address', 'login_at', 'logout_at'])->download();
        return back();

    }

    public function restoreUsers(Request $request)
    {

        $user_id = $request->get('data');
        //soft delete
        foreach ($user_id as $uid) {

            $user = User::withTrashed()->find($uid);
            $user->restore();

        }

        event(new UserEvent($user, UserEvent::RESTORED));

        return '0';

    }

    public function destroyPermission(Request $request)
    {
        $permission_id = $request->get('id');
        $permission = Permission::find($permission_id);
        event(new UserEvent($permission, UserEvent::DELETED));
        $permission->delete();
        return $permission_id;

    }

    public function getUsersByRole($id)
    {
        $get_all_roles = Role::find($id);
        $users = User::whereRoleIs($get_all_roles->name)->get();
        return view('sysuser.roles')->withRoles($get_all_roles);
    }

    public function restoreUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::withTrashed()->find($user_id);
        $user->restore();
        $event = 'Restored';
        event(new UserEvent($user, $event));
        return $user_id;

    }
}
