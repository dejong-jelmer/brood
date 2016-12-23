<?php

namespace Brood\Http\Controllers;

use Auth;
use Redirect;
use Brood\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
    public function postNewMessage(Request $request)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $this->validate($request, [
            'message' => 'required|alpha_num_spaces_spec_char|max:255',
            'expires' => 'required|date_format:Y-m-d|max:255',
            'color' => 'alpha|min:4|max:7|nullable',

            ]);

        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->message = $request->input('message');
        $message->expires = $request->input('expires');
        $message->color = $request->input('color');

        $message->save();

        return Redirect::back()->with('info_success', "Je mededeling is opgeslagen en zal tot $message->expires te zien zijn.");

    }
    
    public function removeMessage($message)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        $message = Message::find($message);
        $message->delete();

        return Redirect::back()->with('info_success', 'Mededeling verwijderd.');

    }
    
    


}
