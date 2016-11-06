<?php 

namespace Brood\Http\Controllers;

use Auth;
use Mail;
use Redirect;
use Brood\Models\User;
use Brood\Models\Bread;
use Illuminate\Http\Request;

class BreadlistController extends Controller
{
    public function getBreadUpdate()
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $breads = Bread::where('deleted', false)->get();

        return view('admin.bread.updatebreadlist')->with([
                'breads' => $breads
            ]);
    }

    public function postBreadUpdate(Request $request)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $this->validate($request, [
                'remove' => 'boolean',
                'bread' => 'alpha_dash_spaces|required|max:50',
                'price' => 'required|numeric|between:0,25', 
                'id' => 'integer', 
            ]);

        $id = $request->input('id');

        if ($request->input('remove') && $id) {
        
            $bread = Bread::findOrFail($id);
            
            $bread->deleteBread();

            $info = 'info_success';
            $response =  'Het brood is verwijderd.';

        } else {
            
            $bread = Bread::findOrFail($id);

            $bread->deleteBread();
    
            Bread::create([
                    'bread' => $request->input('bread'),
                    'price' => $request->input('price'),
                    'deleted' => false,
                ]);

            $info = 'info_success';
            $response =  'De broodlijst is aangepast.';
        }       
        
        return Redirect::back()->with($info, $response);
    }

}