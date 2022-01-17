<?php
namespace Modules\Car\Controllers;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Car\Requests\UpdateCarRequest;
use Modules\Car\Resources\CarResource;
use Modules\Car\Filters\Search;
use Modules\Car\Filters\Sort;
use Modules\Car\Models\Car;
use Modules\Car\Requests\CarIndexRequest;
use Modules\Car\Requests\CreateCarRequest;

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

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $query = Car::find($id);
        if($query){
            $query->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['error' => 'Car not found'], 404);
    }

    public function create(CreateCarRequest $request): \Illuminate\Http\JsonResponse
    {
        Car::create($request->toArray());
        return response()->json(['message' => 'Successfully created'], 201);

    }
    public function retrieve($id): CarResource
    {
        return new CarResource(Car::find($id));

    }

    public function update(UpdateCarRequest $request,$id): \Illuminate\Http\JsonResponse
    {
        $query=Car::find($id);
        if($query){
            $query->update($request->toArray());
            return response()->json(['message' => 'Successfully updated']);
        }

        return response()->json(['error' => 'Car not found'], 404);

    }
}
