<?php namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller
{
    protected $ACL;
    protected $user;

    public function __construct(ACL $ACL, User $user)
    {
        $this->middleware('auth');
        $this->ACL  = $ACL;
        $this->user = $user;
    }

    public function getIndex()
    {
        if (!$this->ACL->hasPermission('profile', 'edit')) {
            return redirect(route('home'))->withErrors(['You do not have permission for edit your profile.']);
        }

        $user = $this->user->where('id', '=', \Auth::user()->id)->first();

        return view('profile.index')->with(compact('user'));
    }

    public function putUpdate(Request $request)
    {
        if (!$this->ACL->hasPermission('profile', 'edit')) {
            return redirect(route('home'))->withErrors(['You do not have permission for edit your profile.']);
        }

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'confirmed|min:6|max:12',
        ]);

        $consultEmail = $this->user->where('email', '=', $request->email)->where('id', '!=', $request->userId)->count();
        if($consultEmail > 0){
            $error = "The email already has been taken for another user";
            return redirect(route('profile'))->withErrors(compact('error'));
        }

        $user = $this->user->find($request->userId);
        $user->name  = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $success = "Profile updated successfully.";

        return redirect(route('profile'))->with(compact('success'));
    }
}