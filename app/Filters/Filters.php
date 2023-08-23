<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
     * ThreadFilters Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
//            if (! $this->hasFilter($filter)) return;
//
//            $this->filter($this->request->$filter);

        }

//        if ($this->request->has('by')) {
//            $this->by($this->request->by);
//        }

        return $this->builder;
//        if (! $username = $this->request->by) return $builder;

//            if ($username = $this->request->by) {
//            $user = User::where('name', $username)->firstOrFail();

//            return $builder->where('user_id', $user->id);
//        return $this->by($username);
    }

    public function getFilters()
    {
        return$this->request->only($this->filters);
    }

//    /**
//     * @param $filter
//     * @return bool
//     */
//    public function hasFilter($filter): bool
//    {
//        return  && $this->request->has($filter);
//    }
}