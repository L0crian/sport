<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Notification;
use Session;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discuss');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' =>$request->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)
        ]);

        Session::flash('success', 'Discussion created');
        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where(['slug' => $slug])->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();


        return view('discussions.show')
            ->with('d', $discussion)
            ->with('best_answer', $best_answer);
    }

    public function reply($id)
    {

        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        $reply->user->points += 25;
        $reply->user->save();

        $watchers = array();

        foreach ($d->watchers as $w) {
                array_push($watchers, User::find($w->user_id));
        }

        Notification::send($watchers, new NewReplyAdded($d));

        Session::flash('success', 'Replied to discussion.');

        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where(['slug' => $slug])->first()]);
    }

    public function update(Request $request,$id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);
        $discussion = Discussion::find($id);
        $discussion->content = request()->content;
        $discussion->save();

        Session::flash('success', 'Discussion updated');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }
}
