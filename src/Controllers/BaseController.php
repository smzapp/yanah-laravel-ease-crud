<?php
namespace Yanah\LaravelEase\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * This BaseController mediates the System Controller and Laravel Facade Controller
 * Author: Samuel
 */
abstract class BaseController extends Controller
{
    protected $model;

    abstract protected function getValidationRules(): array;


    public function index(): JsonResponse
    {
        $data = $this->model::all();
        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validateRequest($request);
        $createdItem = $this->model::create($validatedData);

        return response()->json($createdItem, 201);
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->model::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validatedData = $this->validateRequest($request);
        $item = $this->model::findOrFail($id);
        $item->update($validatedData);

        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        $item = $this->model::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    protected function validateRequest(Request $request): array
    {
        return $request->validate($this->getValidationRules());
    }

}