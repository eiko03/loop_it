<?php
namespace Modules;

use Closure;

abstract class Filter{
    public function handle($request , Closure $next){
        $builder = $next( $request);
        $class= get_called_class();
        if(request()->has(['sort','sort_by']) && $class=='Modules\Car\Filters\Sort' || request()->has('search') && $class=='Modules\Car\Filters\Search')
            return $this->applyFilter($builder);

        return $builder;
    }

    protected abstract function applyFilter($builder);

}
