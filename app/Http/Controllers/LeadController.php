<?php

namespace App\Http\Controllers;

use App\Facades\Mailchimp;
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

        $lead = Lead::create($data);

        $mailchimpResponse = Mailchimp::subscribe($lead->email, $lead->full_name);

        return response()->json([
            'message' => 'Lead created successfully',
            'lead' => $lead,
            'mailchimp' => $mailchimpResponse
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        if (!$lead) {
            abort(404);
        }

        $lead->update($request->all());

        $mailchimpResponse = Mailchimp::updateSubscriber($lead->email, $lead->full_name);

        return response()->json([
            'message' => 'Lead updated successfully',
            'lead' => $lead,
            'mailchimp' => $mailchimpResponse
        ], 200);
    }
}
