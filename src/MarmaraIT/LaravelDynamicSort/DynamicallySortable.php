<?php

namespace MarmaraIT\LaravelDynamicSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class DynamicallySortable
 * @property string primaryKey
 * @method string getTable()
 * @method static Builder ordered()
 * @method static Builder sorted()
 * @package MarmaraIT\LaravelDynamicSort
 */
trait DynamicallySortable{
    /**
     * Sorts the Model according to the request
     * @param $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query){
        $request = request();
        $dir=$this->getDir($request);

        $sort=$this->getSortString($request);

        //Make an array, if multiple columns seperated by comma
        if(is_string($sort) && str_contains($sort, ',')){
            $sort=explode(',', $sort);
        }

        //first order by the given value next by primary key to avoid randomness on same values
        if(is_array($sort)){
            foreach($sort as $sortitem){
                $query->orderBy($sortitem, $dir);
            }
            $query->orderBy($this->getTable().'.'.$this->primaryKey, $dir);
        }else{
            $query->orderBy($sort, $dir)->orderBy($this->getTable().'.'.$this->primaryKey, $dir);
        }

        //Add the sort variables to the request instance to get it in the view
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
        /** @var DynamicallySortable $query */
        return $query->ordered();
    }

    /**
     * Returns the direction for sorting
     * @param $request
     * @return string
     */
    private function getDir(Request $request){
        if(!$request){
            return (isset($this->defaultDir) ? $this->defaultDir : 'asc');
        }
        $dir=$request->get('sort_dir', (isset($this->defaultDir) ? $this->defaultDir : 'asc'));
        $dir=$dir ? : (isset($this->defaultDir) ? $this->defaultDir : 'asc');
        return $dir;
    }

    /**
     * Returns the given sort string
     * @param $request
     * @return string
     */
    private function getSortString(Request $request){
        if(!$request){
            return (isset($this->defaultSort) ? $this->defaultSort : $this->getTable().'.'.$this->primaryKey);
        }
        $sort=$request->get('sort', (isset($this->defaultSort) ? $this->defaultSort : $this->getTable().'.'.$this->primaryKey));
        $sort=$sort ? : (isset($this->defaultSort) ? $this->defaultSort : $this->getTable().'.'.$this->primaryKey);
        return $sort;
    }
}