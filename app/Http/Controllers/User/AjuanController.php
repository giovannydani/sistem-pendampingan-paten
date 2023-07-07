<?php

namespace App\Http\Controllers\User;

use App\Models\Country;
use App\Models\Province;
use App\Models\PatentType;
use App\Models\PatentDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ApplicantCriteria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request, PatentDetail $patentDetail)
    {
        $rules = [
            "patent_type_id" => ['required', 'exists:patent_types,id'],
            "applicant_criteria_id" => ['required', 'exists:applicant_criterias,id'],

            "name_applicant" => ['required'],
            "email_applicant" => ['required'],
            "no_telp_applicant" => ['required'],
            "nationality_id_applicant" => ['required', 'exists:countries,id'],
            "country_id_applicant" => ['required', 'exists:countries,id'],
            "address_applicant" => ['required'],
            "province_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            "district_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            "subdistrict_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],

            "is_fractions" => ['required'],
            "fractions_number" => [Rule::requiredIf($request->is_fractions == 'yes')],
            "fractions_date" => [Rule::requiredIf($request->is_fractions == 'yes')],
        ];
        
        Validator::make(
            data: $request->all(),
            rules: $rules,
        )->validate();

        // storing PatentDetail data
        $dataPatentDetail = [
            'patent_type_id' => $request->patent_type_id,
            'applicant_criterias_id' => $request->applicant_criteria_id,
            'is_fractions' => $request->is_fractions,
        ];

        if ($request->is_fractions == 'yes') {
            $dataPatentDetail['fractions_number'] = $request->fractions_number;
            $dataPatentDetail['fractions_date'] = $request->fractions_date;
        }else {
            $dataPatentDetail['fractions_number'] = null;
            $dataPatentDetail['fractions_date'] = null;
        }
        
        $patentDetail->update($dataPatentDetail);
        
        // storing PatentDetail data
        $dataPatentApplicant = [
            'name' => $request->name_applicant,
            'email' => $request->email_applicant,
            'telephone' => $request->no_telp_applicant,
            'nationality_id' => $request->nationality_id_applicant,
            'country_id' => $request->country_id_applicant,
            'address' => $request->address_applicant,
        ];

        if ($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $dataPatentApplicant['province_id'] = $request->province_id_applicant;
            $dataPatentApplicant['district_id'] = $request->district_id_applicant;
            $dataPatentApplicant['subdistrict_id'] = $request->subdistrict_id_applicant;
        }else {
            $dataPatentApplicant['province_id'] = null;
            $dataPatentApplicant['district_id'] = null;
            $dataPatentApplicant['subdistrict_id'] = null;
        }

        $patentDetail->PatentApplicants()->create($dataPatentApplicant);

        return to_route('user.ajuan.index');
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
        $patentDetail = PatentDetail::create([
            'owner_id' => Auth::id(),
        ]);

        // $defaultHolder = ParameterHolder::all();

        // foreach ($defaultHolder as $key => $value) {
        //     $dataCreate = [
        //         'detail_hakcipta_id' => $patentDetail->id,
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

        return $patentDetail->id;
    }
}
