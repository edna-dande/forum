<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded= [];

    protected $with= ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
           $thread->replies()->delete();
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
//        return '/threads/' .$this->channel->slug . '/' . $this->id;
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
//        ->withCount('favorites')
//        ->with('owner');
    }
//    public function getReplyCountAttribute()
//    {
//        return $this->replies()->count();
//    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
