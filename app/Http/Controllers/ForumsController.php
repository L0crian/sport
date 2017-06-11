<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index(Request $request)
    {

        switch($request->filter){
            case 'me':
                $result = Discussion::where('user_id', Auth::id())->paginate(3);
                break;
            case 'solved':
                $answered = array();
                foreach (Discussion::all() as $d) {
                    if($d->hasBestAnswer()) {
                        array_push($answered, $d);
                    }
                }

                $page = Input::get('page', 1); // Get the current page or default to 1, this is what you miss!
                $perPage = 3;
                $offset = ($page * $perPage) - $perPage;

                $result =  new LengthAwarePaginator(
                    array_slice($answered, $offset, $perPage, true),
                        count($answered), $perPage, $page,
                        ['path' => $request->url(), 'query' => $request->query()]);
                break;
            case 'unsolved':
                $unanswered = array();
                foreach (Discussion::all() as $d) {
                    if(!$d->hasBestAnswer()) {
                        array_push($unanswered, $d);
                    }
                }
                $page = Input::get('page', 1); // Get the current page or default to 1, this is what you miss!
                $perPage = 3;
                $offset = ($page * $perPage) - $perPage;
                $result =  new LengthAwarePaginator(
                    array_slice($unanswered, $offset, $perPage, true),
                    count($unanswered), $perPage, $page,
                    ['path' => $request->url(), 'query' => $request->query()]);
                break;
            default:
                $result = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }

        return view('forum')->with('discussions', $result);
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel')->with('discussions', $channel->discussions);
    }
}
