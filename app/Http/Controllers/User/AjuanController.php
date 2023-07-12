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
use App\Models\ParameterPatentCorrespondence;
use App\Models\PatentCorrespondence;
use App\Models\PatentInventor;
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

        $patentDetail->load([
            'PatentCorrespondent'
        ]);

        // return $data['patentDetail']->PatentCorrespondent;
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

        $attributes = [
            "patent_type_id" => 'Jenis Paten',
            "applicant_criteria_id" => 'Kriteria Pemohon',

            "name_applicant" => 'Nama',
            "email_applicant" => 'Email',
            "no_telp_applicant" => 'No Telepon',
            "nationality_id_applicant" => 'Kewarganegaraan',
            "country_id_applicant" => 'Negara Tempat Tinggal',
            "address_applicant" => 'Alamat Tempat Tinggal',
            "province_id_applicant" => 'Provinsi',
            "district_id_applicant" => 'Kabupaten / Kota',
            "subdistrict_id_applicant" => 'Kecamatan',

            // "is_fractions" => '',
            "fractions_number" => 'Nomor Permohonan Induk',
            "fractions_date" => 'Tanggal Penerimaan Permohonan Induk',
        ];
        
        Validator::make(
            data: $request->all(),
            rules: $rules,
            attributes: $attributes,
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

    public function destroyInventor(PatentDetail $patentDetail, PatentInventor $patentInventor)
    {
        $patentInventor->delete();
        return 'success';
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

        $defaultCorrespondent = ParameterPatentCorrespondence::first();

        $dataCreateCorrespondent = [
            'detail_id' => $patentDetail->id,
            'name' => $defaultCorrespondent->name,
            'address' => $defaultCorrespondent->address,
            'telephone' => $defaultCorrespondent->telephone,
            'country_id' => $defaultCorrespondent->country_id,
            // 'province_id' => $defaultCorrespondent,
            // 'district_id' => $defaultCorrespondent,
            // 'subdistrict_id' => $defaultCorrespondent,
            'email' => $defaultCorrespondent->email,
            // 'legal_entity_name' => $defaultCorrespondent,
        ];

        if ($defaultCorrespondent->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $dataCreateCorrespondent['province_id'] = $defaultCorrespondent->province_id;
            $dataCreateCorrespondent['district_id'] = $defaultCorrespondent->district_id;
            $dataCreateCorrespondent['subdistrict_id'] = $defaultCorrespondent->subdistrict_id;
        }else {
            $dataCreateCorrespondent['province_id'] = null;
            $dataCreateCorrespondent['district_id'] = null;
            $dataCreateCorrespondent['subdistrict_id'] = null;
        }

        if ($defaultCorrespondent->legal_entity_name) {
            $dataCreateCorrespondent['legal_entity_name'] = $defaultCorrespondent->legal_entity_name;
        }else {
            $dataCreateCorrespondent['legal_entity_name'] = null;
        }

        PatentCorrespondence::create($dataCreateCorrespondent);

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
