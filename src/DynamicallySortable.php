<?php

namespace MarmaraIT\LaravelDynamicSort;
use Illuminate\Database\Eloquent\Builder;

trait DynamicallySortable{
    /**
     * Sorts the Model according to the request
     * @param $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query){
        $request = request();
        $dir=$request->get('sort_dir', (isset($this->defaultDir) ? $this->defaultDir : 'asc'));
        $dir=$dir?:(isset($this->defaultDir) ? $this->defaultDir : 'asc');

        $sort=$request->get('sort', (isset($this->defaultSort) ? $this->defaultSort : $this->getTable().'.id'));
        $sort=$sort?:(isset($this->defaultSort) ? $this->defaultSort : $this->getTable().'.'.'id');
        if(is_string($sort) && str_contains($sort, ',')){
            $sort=explode(',', $sort);
        }

        if(is_array($sort)){
            foreach($sort as $sortitem){
                $query->orderBy($sortitem);
            }
            $query->orderBy($this->getTable().'.id', $dir);
        }else{
            $query->orderBy($sort, $dir)->orderBy($this->getTable().'.id', $dir);
        }

        if(!$request->has('sort')){
            if(is_array($sort)){
                $sort=join(',', $sort);
            }
            $request->request->add(['sort'=>$sort]);
        }
        if(!$request->has('sort_dir')){
            $request->request->add(['sort_dir'=>$dir]);
        }
        return $query;
    }

    /**
     * Sorts the Model according to the request
     * Alias Method
     * @param Builder $query
     * @return Builder
     */
    public function scopeSorted(Builder $query){
        return $query->ordered();
    }
}