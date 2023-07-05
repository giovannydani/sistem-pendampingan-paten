<?php

namespace App\Http\Controllers\User;

use App\Models\PatentDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicantCriteria;
use App\Models\Country;
use App\Models\PatentType;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AjuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.ajuan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PatentDetail $patentDetail)
    {
        $data = [
            'patent_types' => PatentType::all(),
            'applicant_criterias' => ApplicantCriteria::all(),
            'patentDetail' => $patentDetail,
            'kewarganegaraans' => Country::all(),
            'provinsis' => Province::all(),
        ];
        return view('user.ajuan.add', $data);
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
        //
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
        $data = Auth::user()->applications;

        return DataTables::of($data)->make(true);
    }

    public function generateAdd()
    {
        $detailHakcipta = PatentDetail::create([
            'owner_id' => Auth::id(),
        ]);

        // $defaultHolder = ParameterHolder::all();

        // foreach ($defaultHolder as $key => $value) {
        //     $dataCreate = [
        //         'detail_hakcipta_id' => $detailHakcipta->id,
        //         'name' => $value->name,
        //         'email' => $value->email,
        //         'no_telp' => $value->no_telp,
        //         'nationality_id' => $value->nationality_id,
        //         'address' => $value->address,
        //         'country_id' => $value->country_id,
        //         'postal_code' => $value->postal_code,
        //         'is_manageable' => 0,
        //     ];
    
        //     if ($value->is_company) {
        //         $dataCreate['is_company'] = $value->is_company;
        //     }else {
        //         $dataCreate['is_company'] = 0;
        //     }
    
        //     if ($value->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
        //         $dataCreate['province_id'] = $value->province_id;
        //         $dataCreate['district_id'] = $value->district_id;
        //         $dataCreate['subdistrict_id'] = $value->subdistrict_id;
        //     }else {
        //         $dataCreate['district'] = $value->district;
        //     }
    
        //     HolderHakcipta::create($dataCreate);
        // }

        return $detailHakcipta->id;
    }
}
