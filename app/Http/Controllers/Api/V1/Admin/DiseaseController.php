<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Actions\Disease\StoreDiseaseAction;
use App\DTO\DiseaseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\DiseaseRequest;
use App\Http\Resources\Api\V1\Admin\DiseaseResource;
use App\Models\Disease;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $diseases = Disease::query()
            ->paginate(15);

        return [
            'status'  => true,
            'payload' => (new DiseaseResource($diseases))->response()->getData(true)
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiseaseRequest $request, StoreDiseaseAction $action): JsonResponse
    {
        $DTO = DiseaseDTO::create($request);

        $disease = $action->handle($DTO);

        return jsonResponseFormat(payload: $disease, message: __('Disease Added!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Disease $disease)
    {
        return jsonResponseFormat(payload: new DiseaseResource($disease));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
