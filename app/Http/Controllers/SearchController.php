<?php 

namespace Brood\Http\Controllers;

use DB;
use Auth;
use Redirect;
use Brood\Models\User; 
use Brood\Models\Bread; 
use Illuminate\Http\Request;


class SearchController extends Controller
{

    public function getResults(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return redirect()->route('home');
        }

        $users = User::where(DB::raw('name', 'LIKE', "%{$query}%"))
        ->orWhere('email', 'LIKE', "%{$query}%")->with('breads')
        ->get();

        $breads = Bread::where('bread', 'LIKE', "%{$query}%")->get();
        

        return view('admin.user.changeorder')->with([
            'users'=> $users,
            'breads' => $breads,
            ]);
    }
    


}