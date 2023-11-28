<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AjuanStatus;
use App\Http\Controllers\Controller;
use App\Models\PatentDetail;
use App\Models\RegistrationCertificate;
use App\Models\TransferEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationCertificateController extends Controller
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
        $data = [
            'patentDetail' => $patentDetail,
        ];

        return view('admin.ajuan.upload_certificate.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PatentDetail $patentDetail)
    {
        // return $patentDetail->RegistrationCertificate()->exists();

        Validator::make(
            data: $request->all(),
            rules: [
                'file' => ['required', 'file'],
            ],
        )->validate();

        $reUpload = false;

        if ($patentDetail->RegistrationCertificate()->exists()) {
            Storage::delete($patentDetail->RegistrationCertificate->file);

            $patentDetail->RegistrationCertificate()->delete();

            $reUpload = true;
        }

        RegistrationCertificate::create([
            'detail_id' => $patentDetail->id,
            'file' => $request->file('file')->store('registration_certificate'),
            'file_name' => $request->file('file')->getClientOriginalName(),
        ]);

        if ($reUpload == false) {
            $patentDetail->update([
                'status' => AjuanStatus::CertificateFinish,
            ]);
        }

        Alert::toast('Success Upload Certificate', 'success');

        return redirect()->to(route('admin.ajuan.index'));
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
