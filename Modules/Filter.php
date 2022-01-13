<?php
namespace Modules;

use Closure;

abstract class Filter{
    public function handle($request , Closure $next){
        $builder = $next( $request);

        if(request()->has(['sort','sort_by']))
            return $this->applyFilter($builder);

        return $builder;
    }

    protected abstract function applyFilter($builder);

}
