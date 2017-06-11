<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Watcher;
use Auth;
use Session;
use Illuminate\Http\Request;

class WatchersController extends Controller
{
    public function watch($id)
    {
        Watcher::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You watch this discussion');

        return redirect()->back();
    }

    public function unwatch($id)
    {

        Watcher::where([
            'user_id' => Auth::id(),
            'discussion_id' => $id
        ])->delete();

        Session::flash('success', 'You unwatch this discussion');

        return redirect()->back();
    }
}
