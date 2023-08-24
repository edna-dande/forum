<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\String_;

class ThreadFilters extends Filters
{

        protected $filters = ['by', 'popular'];
    /**
     * Filter the query by a given username.
     *
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     *Filter the query according to most popular.
     *
     * @return $this
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

//    protected function popular()
//    {
//        return $this->builder->orderBy('replies_count', 'desc');
//    }

}

