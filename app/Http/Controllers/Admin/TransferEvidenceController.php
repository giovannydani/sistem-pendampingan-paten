<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AjuanStatus;
use App\Http\Controllers\Controller;
use App\Models\PatentDetail;
use App\Models\TransferEvidence;
use Illuminate\Http\Request;

class TransferEvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PatentDetail $patentDetail)
    {
        $patentDetail->load([
            'TransferEvidence'
        ]);

        $data = [
            'patentDetail' => $patentDetail,
        ];

        // return $patentDetail;

        return view('admin.ajuan.transfer_evidence.check', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PatentDetail $patentDetail)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PatentDetail $patentDetail)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransferEvidence $transferEvidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransferEvidence $transferEvidence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransferEvidence $transferEvidence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransferEvidence $transferEvidence)
    {
        //
    }

    public function validEvindance(PatentDetail $patentDetail)
    {
        $patentDetail->update([
            'status' => AjuanStatus::Finish,
        ]);

        return "success";
    }

    public function invalidEvindance(PatentDetail $patentDetail)
    {
        $patentDetail->update([
            'status' => AjuanStatus::PaymentFailed,
        ]);

        return "success";
    }
}
