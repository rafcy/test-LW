<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeadRequest;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        return response()->json(Lead::all());
    }

    public function store(CreateLeadRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (isset($data['id'])) {
            $lead = Lead::find($data['id']);
            if ($lead) {
                $lead->update($data);
                return response()->json(['message' => 'Lead updated successfully', 'lead' => $lead], 200);
            }
        }

        $lead = Lead::create($data);
        return response()->json(['message' => 'Lead created successfully', 'lead' => $lead], 201);
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->all());

        return response()->json($lead);
    }
}
