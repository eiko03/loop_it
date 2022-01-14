<?php
namespace Modules\Car\Controllers;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Car\Filters\Search;
use Modules\Car\Filters\Sort;
use Modules\Car\Models\Car;
use Modules\Car\Requests\CarIndexRequest;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(CarIndexRequest $request)
    {

        return app(Pipeline::class)
            ->send(Car::query())
            ->through([
                Sort::class,
                Search::class
            ])
            ->thenReturn()
            ->paginate(($request->count_per_page) ?: 10);


    }
}
