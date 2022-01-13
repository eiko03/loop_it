<?php
namespace Modules\Car\Filters;

use Modules\Filter;

class Sort extends Filter {

    protected function applyFilter($builder)
    {
        return $builder->orderBy(request('sort_by'),request('sort'));
    }
}
