<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\ParameterPatentCorrespondence;

class PatentCorrespondenceController extends Controller
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
    public function create() : View
    {
        $data = [
            'kewarganegaraans' => Country::all(),
            'provinsis' => Province::all(),
            'correspondence' => ParameterPatentCorrespondence::first(),
        ];
        return view('admin.parameter.korespondensi.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "name_correspondent" => ['required'],
            "email_correspondent" => ['required'],
            "no_telp_correspondent" => ['required'],
            "country_id_correspondent" => ['required'],
            "address_correspondent" => ['required'],
            "province_id_correspondent" => [Rule::requiredIf($request->country_id_correspondent == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            "district_id_correspondent" => [Rule::requiredIf($request->country_id_correspondent == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            "subdistrict_id_correspondent" => [Rule::requiredIf($request->country_id_correspondent == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            // 'legal_entity_name_correspondent',
        ];

        Validator::make(
            data: $request->all(),
            rules: $rules,
        )->validate();

        $dataUpdate = [
            'name' => $request->name_correspondent,
            'address' => $request->address_correspondent,
            'country_id' => $request->country_id_correspondent,
            // 'province_id' => $request->,
            // 'district_id' => $request->,
            // 'subdistrict_id' => $request->,
            'telephone' => $request->no_telp_correspondent,
            'email' => $request->email_correspondent,
            // 'legal_entity_name' => $request->,
        ];

        if ($request->country_id_correspondent == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $dataUpdate['province_id'] = $request->province_id_correspondent;
            $dataUpdate['district_id'] = $request->district_id_correspondent;
            $dataUpdate['subdistrict_id'] = $request->subdistrict_id_correspondent;
        }else {
            $dataUpdate['province_id'] = null;
            $dataUpdate['district_id'] = null;
            $dataUpdate['subdistrict_id'] = null;
        }

        if ($request->legal_entity_name_correspondent) {
            $dataUpdate['legal_entity_name'] = $request->legal_entity_name_correspondent;
        }else {
            $dataUpdate['legal_entity_name'] = null;
        }

        $correspondence = ParameterPatentCorrespondence::first();

        $correspondence->update($dataUpdate);

        Alert::toast('Success Edit Data Koresponden', 'success');

        return to_route('admin.parameter.korespondensi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParameterPatentCorrespondence $parameterPatentCorrespondence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParameterPatentCorrespondence $parameterPatentCorrespondence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParameterPatentCorrespondence $parameterPatentCorrespondence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParameterPatentCorrespondence $parameterPatentCorrespondence)
    {
        //
    }
}
