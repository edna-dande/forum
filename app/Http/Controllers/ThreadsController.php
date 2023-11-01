<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($filters, $channel);

        if (request()->wantsJson()) {
            return $threads;
        }

//        if ($channel->exists) {
//            $threads = $channel->threads()->latest();
//        } else {
//            $threads = Thread::latest();
//        }

//        if ($username = request('by')) {
//            $user = \App\User::where('name', $username)->firstOrFail();
//
//            $threads->where('user_id', $user->id);
//        }

//        $threads = Thread::filter($filters)->get();
//        $threads = $this->getThreads($channel);

        return view('threads.index', compact('threads'));
    }

    public function create()
    {
        return view('threads.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published!');
    }


    public function show($channel, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function edit(Thread $thread)
    {
        //
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy($channel, Thread $thread)
    {
//        $thread->replies()->delete();
//        if ($thread->user_id != auth()->id()) {
//           abort(403, 'You do not have permission to do this.');
//        }
        $this->authorize('update', $thread);
        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads');

    }

    protected function getThreads(ThreadFilters $filters, Channel $channel)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

//        $threads = $threads->get();
        return $threads->get();
    }
}
