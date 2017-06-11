<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Auth;
use Session;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function like($id)
    {
        Like::create([
            'user_id' => Auth::id(),
            'reply_id' => $id
        ]);


        Session::flash('success', 'You liked the reply');

        return redirect()->back();
    }

    public function unlike($id)
    {

        Like::where([
            'user_id' => Auth::id(),
            'reply_id' => $id
        ])->delete();

        Session::flash('success', 'You unliked the reply');

        return redirect()->back();
    }


    public function best_answer($id)
    {
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();

        $reply->user->points += 100;
        $reply->user->save();

        Session::flash('success', 'Reply has been marked as the best answer.');
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('replies.edit', ['reply' => Reply::find(['id' => $id])->first()]);
    }

    public function update(Request $request,$id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);
        $reply = Reply::find($id);
        $reply->content = request()->content;
        $reply->save();

        Session::flash('success', 'Reply updated');

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug]);
    }
}
