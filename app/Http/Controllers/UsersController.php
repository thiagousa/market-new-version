<?php namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\User;
use App\PagesAdmin;
use App\Permissions;

class UsersController extends Controller
{
    protected $ACL;
    protected $user;
    protected $pagesAdmin;
    protected $permissions;

    public function __construct(ACL $ACL, User $user, PagesAdmin $pagesAdmin, Permissions $permissions)
    {
        $this->middleware('auth');
        $this->ACL          = $ACL;
        $this->user         = $user;
        $this->pagesAdmin   = $pagesAdmin;
        $this->permissions  = $permissions;
    }

    public function getIndex()
    {
        if (!$this->ACL->hasPermission('users')) {
            return redirect(route('home'))->withErrors(['You do not have permission for access Users\' page.']);
        }

        $users = $this->user->where('email', '!=', 'hello@brunomartins.com')->where('email', '!=', 'thiago@thiagodsantos.com')
            ->orderBy('name', 'ASC')
            ->addSelect('id')
            ->addSelect('name')
            ->addSelect('email')
            ->get();

        return view('users.index')->with(compact('users'));
    }

    public function getAdd()
    {
        if (!$this->ACL->hasPermission('users', 'add')) {
            return redirect(route('users'))->withErrors(['You do not have permission for add new user.']);
        }

        return view('users.add');
    }

    public function postAdd(Request $request)
    {
        if (!$this->ACL->hasPermission('users', 'add')) {
            return redirect(route('users'))->withErrors(['You do not have permission for add new user.']);
        }

        $this->validate($request, [
            'name'                  => 'required|max:100',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6|max:12',
        ]);

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        $success = "User created successfully";

        return redirect(route('usersPermissions', $user->id))->with(compact('success'));
    }

    public function getEdit($userId)
    {
        if (!$this->ACL->hasPermission('users', 'edit')) {
            return redirect(route('users'))->withErrors(['You do not have permission for edit the user.']);
        }

        $user = $this->user->where('id', '=', $userId)->first();

        return view('users.edit')->with(compact('user'));
    }

    public function putEdit(Request $request)
    {
        if (!$this->ACL->hasPermission('users', 'edit')) {
            return redirect(route('users'))->withErrors(['You do not have permission for edit the user.']);
        }

        $this->validate($request, [
            'name'                  => 'required|max:100',
            'email'                 => 'required|email|max:255',
            'password'              => 'confirmed|min:6|max:12',
        ]);

        $consultEmail = $this->user->where('email', '=', $request->email)->where('id', '!=', $request->userId)->count();
        if($consultEmail > 0){
            $error = "The email already has been taken for another user";
            return redirect(route('users'))->withErrors(compact('error'));
        }

        $user = $this->user->find($request->userId);
        $user->name     = $request->name;
        $user->email    = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $success = "User updated successfully";

        return redirect(route('users'))->with(compact('success'));
    }

    public function getPermissions($userId)
    {
        if (!$this->ACL->hasPermission('users', 'edit') || ! $this->ACL->hasPermission('users', 'add') || !$this->ACL->hasPermission('users', 'delete')) {
            return redirect(route('users'))->withErrors(['You do not have permission for give permissions to users.']);
        }

        $pagesAdmin = $this->pagesAdmin->permissionsByUser($userId);

        $user = $this->user->where('id', '=', $userId)->first();

        return view('users.permissions')->with(compact('pagesAdmin', 'user'));
    }

    public function postPermissions(Request $request)
    {
        //DELETE ALL
        $this->permissions->deletePermissionByUser($request->userId);
        //RECORD AGAIN
        $this->savePermissionsForUser($request->userId, $request->all());

        $success = "Permissions updated successfully";

        return redirect(route('users'))->with(compact('success'));
    }

    private function savePermissionsForUser($userId, Array $data)
    {
        $pages = [];

        foreach ($data as $k => $value) {
            $page = explode('@', $k);
            if (! isset($page[1])) {
                continue;
            }
            $pages[$page[0]][$page[1]] = $value;
        }

        foreach ($pages as $pageId => $values) {
            $this->permissions->create([
                'userId'        => $userId,
                'pageAdminId'   => $pageId,
                'access'        => (isset($values['access']))? $values['access'] : 0,
                'add'           => (isset($values['add']))? $values['add'] : 0,
                'edit'          => (isset($values['edit']))? $values['edit'] : 0,
                'delete'        => (isset($values['delete']))? $values['delete'] : 0
            ]);
        }
    }

    public function delete(Request $request)
    {
        if (!$this->ACL->hasPermission('users', 'delete')) {
            return redirect(route('users'))->withErrors(['You do not have permission for delete the users.']);
        }

        $this->permissions->deletePermissionByUser($request->get('userId'));
        $this->user->find($request->get('userId'))->delete();

        $success = "User deleted successfully";

        return redirect(route('users'))->with(compact('success'));
    }
}