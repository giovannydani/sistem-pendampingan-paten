<?php

namespace App\Http\Controllers\User;

use App\Enums\AjuanStatus;
use App\Http\Controllers\Controller;
use App\Models\PatentDetail;
use App\Models\TransferEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransferEvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PatentDetail $patentDetail)
    {
        if ( $patentDetail->is_certificate_finish || $patentDetail->is_payment_failed) {
            $data = [
                'patentDetail' => $patentDetail,
            ];
    
            return view('user.ajuan.transfer_evidence.add', $data);
        }else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PatentDetail $patentDetail)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'file' => ['required', 'file', 'mimes:jpeg,png,jpg'],
            ],
        )->validate();

        if ($patentDetail->TransferEvidence()->exists()) {
            Storage::delete($patentDetail->TransferEvidence->file);

            $patentDetail->TransferEvidence()->delete();
        }

        TransferEvidence::create([
            'detail_id' => $patentDetail->id,
            'file' => $request->file('file')->store('transfer_evidence'),
            'file_name' => $request->file('file')->getClientOriginalName(),
        ]);

        $patentDetail->update([
            'status' => AjuanStatus::UploadPayment,
        ]);

        Alert::toast('Success Upload Transfer Evidence', 'success');

        return redirect()->to(route('user.ajuan.index'));
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
}
