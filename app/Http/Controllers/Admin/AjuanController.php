<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AjuanStatus;
use App\Models\PatentDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
            'status' => AjuanStatus::Finish,
        ]);

        return "success";
    }
}
