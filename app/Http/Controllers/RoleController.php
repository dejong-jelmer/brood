<?php 

namespace Brood\Http\Controllers;

use Auth;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

public function getUserChangeRights()
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $users = User::all();

        return view('admin.user.changerights')->with([
                'users' => $users,
            ]); 
    }

    public function postAdminRights(Request $request)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $this->validate($request, [
                'id' => 'required|integer',
                'admin' => 'boolean',
            ]);

        $user = User::findOrFail($request->input('id'));
                
        // checks value of input (true) and if not own user id
        if ($request->input('admin') && $user->id != $admin->id) {
            
            $user->takeAdminRights();

            $info = 'info_success';
            $response = "Beheerdersrechten van $user->name ingetrokken.";
        }


        // checks value of input (false) and if already in role table
        if (!$request->input('admin')) {
            
            $user->giveAdminRights();

            $info = 'info_success';
            $response = "Beheerdersrechten aan $user->name gegeven.";
        }

        if ($user->id == $admin->id) {
            
            $info = 'info_error';
            $response = "Je kunt de beheerdersrechten van jezelf niet aanpassen.";
            
        }

        return Redirect::back()->with($info, $response);

    }
    
    public function postUserRights(Request $request)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $this->validate($request, [
                'id' => 'required|integer',
                'deactivated' => 'boolean',
            ]);

        $user = User::findOrFail($request->input('id'));
        
        if (!$request->input('deactivated') && $user->id != $admin->id) {
            
            $user->deactivate();
            
            $info = 'info_success';
            $response = "Gebruikersrechten van $user->name ingetrokken.";
        }

        if ($request->input('deactivated')) {
            
            $user->reactivate();

            $info = 'info_success';
            $response = "Gebruikersrechten van $user->name teruggegeven.";

        }

        if ($user->id == $admin->id) {
            
            $info = 'info_error';
            $response = "Je kunt de gebruikersrechten van jezelf niet aanpassen.";

        }
        
        return Redirect::back()->with($info, $response);
        
    }

}