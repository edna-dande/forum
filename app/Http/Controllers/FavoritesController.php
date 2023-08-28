<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Reply $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Reply $reply)
    {
        $reply->favorite();

        return back();
//        $reply->favorites()->create(['user_id' => auth()->id()]);
//        Favorite::create([
//            'user_id' => auth()->id(),
//            'favorited_id' => $reply->id,
//            'favorited_type' => get_class($reply)
//        ]);
    }
}
