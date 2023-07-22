<?php

namespace App\Http\Controllers\Admin;

use App\Models\PatentDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PatentDetail $patentDetail)
    {
        $patentDetail->load([
            'PatentType',
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

    public function data() {
        $data = PatentDetail::query()
        ->with([
            'PatentDocument'
        ])
        ->orderBy('status') 
        ->IsSubmited()
        ->get();

        return DataTables::of($data)->make(true);
    }
}
