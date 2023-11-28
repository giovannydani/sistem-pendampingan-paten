<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AjuanStatus;
use App\Models\PatentDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistrationCertificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AjuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ajuan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PatentDetail $patentDetail)
    {
        $patentDetail->load([
            'PatentType' => function ($query){
                $query->withTrashed();
            },
            'ApplicantCriteria',
            'PatentApplicant' => function ($query){
                $query->with([
                    'Nationality',
                    'Country',
                    'Province',
                    'District',
                    'Subdistrict',
                ]);
            },
            'PatentInventor' => function ($query){
                $query->with([
                    'Nationality',
                    'Country',
                    'Province',
                    'District',
                    'Subdistrict',
                ]);
            },
            'PatentDocument',
            'PatentClaims',
            'PatentAttachment',
            'PatentNewComment',
        ]);

        $data = [
            'patentDetail' => $patentDetail,
        ];

        // return $patentDetail;
        return view('admin.ajuan.check', $data);
    }
    
    public function createUploadCertificate(PatentDetail $patentDetail)
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
        Validator::make(
            data: $request->all(),
            rules: [
                'comment' => ['required']
            ],
        )->validate();

        $patentDetail->update([
            'status' => AjuanStatus::Revision,
        ]);

        $patentDetail->PatentComments()->create([
            'comment' => $request->comment,
        ]);

        Alert::toast('Success Menabahkan Komen ke Ajuan', 'success');

        return to_route('admin.ajuan.index');
    }

    public function storeUploadCertificate(Request $request, PatentDetail $patentDetail)
    {
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

        if ($reUpload) {
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
    public function show(PatentDetail $patentDetail)
    {
        $patentDetail->load([
            'PatentType' => function ($query){
                $query->withTrashed();
            },
            'ApplicantCriteria',
            'PatentApplicant' => function ($query){
                $query->with([
                    'Nationality',
                    'Country',
                    'Province',
                    'District',
                    'Subdistrict',
                ]);
            },
            'PatentInventor' => function ($query){
                $query->with([
                    'Nationality',
                    'Country',
                    'Province',
                    'District',
                    'Subdistrict',
                ]);
            },
            'PatentDocument',
            'PatentClaims',
            'PatentAttachment',
            'PatentNewComment',
        ]);

        $data = [
            'patentDetail' => $patentDetail,
        ];

        // return $patentDetail;
        return view('user.ajuan.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatentDetail $patentDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatentDetail $patentDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatentDetail $patentDetail)
    {
        //
    }

    public function data(Request $request) {
        
        $data = PatentDetail::query()
        ->with([
            'PatentDocument',
            'Owner',
        ])
        ->orderBy('status') 
        ->IsSubmited()
        ->when($request->input('_startDate'), function ($query) use ($request){
            $startDate = Carbon::parse($request->input('_startDate'))->startOfDay();
            $query->where('updated_at', '>', $startDate);
        })
        ->when($request->input('_endDate'), function ($query) use ($request){
            $endDate = Carbon::parse($request->input('_endDate'))->endOfDay();
            $query->where('updated_at', '<', $endDate);
        })
        ->get();

        return DataTables::of($data)->make(true);
    }

    public function finishAjuan(PatentDetail $patentDetail) {
        $patentDetail->update([
            // 'status' => AjuanStatus::Finish,
            'status' => AjuanStatus::AdminProcess,
        ]);

        return "success";
    }
}
