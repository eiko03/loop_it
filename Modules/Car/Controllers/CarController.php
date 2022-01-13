<?php
namespace Modules\Car\Controllers;

use Illuminate\Routing\Controller;
use Modules\Authentication\Models\Car;
use Modules\Car\Requests\CarIndexRequest;

class CarController extends Controller
{
    public function index(CarIndexRequest $request)
    {
        return Car::paginate($request->count_per_page);
    }
}
