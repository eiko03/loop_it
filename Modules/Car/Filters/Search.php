<?php
namespace Modules\Car\Filters;

use Modules\Filter;

class Search extends Filter {

    protected function applyFilter($builder)
    {
        return $builder
            ->where('model', 'LIKE', '%' . request('search') . '%')
            ->orWhere('brand', 'LIKE', '%' . request('search') . '%');
    }
}
