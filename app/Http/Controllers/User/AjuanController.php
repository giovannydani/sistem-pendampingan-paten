<?php

namespace App\Http\Controllers\User;

use App\Rules\MaxWord;
use App\Models\Country;
use App\Models\Province;
use App\Enums\AjuanStatus;
use App\Models\PatentType;
use App\Models\PatentDetail;
use Illuminate\Http\Request;
use App\Models\PatentInventor;
use App\Models\PatentApplicant;
use Illuminate\Validation\Rule;
use App\Models\PatentAttachment;
use App\Models\ApplicantCriteria;
use App\Rules\required_striptags;
use App\Http\Controllers\Controller;
use App\Models\PatentCorrespondence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\ParameterPatentCorrespondence;
use Illuminate\Validation\Validator as ValidationValidator;

class AjuanController extends Controller
{
    public $_minInventorCount = 1;
    public $_minApplicantCount = 1;

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
            'patentDetail' => $patentDetail,
            'patent_types' => PatentType::all(),
            'applicant_criterias' => ApplicantCriteria::all(),
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
        // return $request;
        $rules = [
            "patent_type_id" => ['required', 'exists:patent_types,id'],
            "applicant_criteria_id" => ['required', 'exists:applicant_criterias,id'],
            
            "is_fractions" => ['required'],
            "fractions_number" => [Rule::requiredIf($request->is_fractions == 'yes')],
            "fractions_date" => [Rule::requiredIf($request->is_fractions == 'yes')],

            // "name_applicant" => ['required'],
            // "email_applicant" => ['required'],
            // "no_telp_applicant" => ['required'],
            // "nationality_id_applicant" => ['required', 'exists:countries,id'],
            // "country_id_applicant" => ['required', 'exists:countries,id'],
            // "address_applicant" => ['required'],
            // "province_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            // "district_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            // "subdistrict_id_applicant" => [Rule::requiredIf($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],


            "invention_title_id" => ['required'],
            "claim_add.*" => ['required', new required_striptags],
            "invention_abstract_id" => ['required', new MaxWord(200)],
            "invention_abstract_en" => [new MaxWord(200)],

            "description_attachment_id" => ['required', File::types(['pdf'])->max(5000)],
            "description_attachment_en" => ['required', File::types(['pdf'])->max(5000)],
            "sequence_attachment" => ['required', File::types(['pdf'])->max(5000)],
            "claim_attachment" => ['required', File::types(['pdf'])->max(5000)],
            "abstract_attachment" => ['required', File::types(['pdf'])->max(5000)],
            "technical_pict_attachment" => ['required', File::types(['pdf'])->max(5000)],
            "pict_to_show_on_announcement_attachment" => ['required', File::types(['pdf'])->max(5000)],
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

            "invention_title_id" => 'Judul Invensi (Indonesia)',
            "invention_title_en" => 'Judul Invensi (Inggris)',
            "invention_abstract_id" => 'Abstrak (Indonesia)',
            "invention_abstract_en" => 'Abstrak (Inggris)',
            "claim_add.*" => 'Klaim',

            "description_attachment_id" => "Deskripsi (Indonesia)",
            "description_attachment_en" => "Deskripsi (Inggris)",
            "sequence_attachment" => "Sequence",
            "claim_attachment" => "Klaim",
            "abstract_attachment" => "Abstrak",
            "technical_pict_attachment" => "Gambar teknik",
            "pict_to_show_on_announcement_attachment" => "Gambar yang akan digunakan di pengumuman",
        ];
        
        $validator = Validator::make(
            data: $request->all(),
            rules: $rules,
            attributes: $attributes,
        );

        $validator->after(function (ValidationValidator $validator) use ($patentDetail) {
            $inventor = $patentDetail->isInventorExist($this->_minInventorCount);
            if ($inventor->status == false) {
                $validator->errors()->add('inventor', $inventor->message);
            }
            
            $applicant = $patentDetail->isApplicantExist($this->_minApplicantCount);
            if ($applicant->status == false) {
                $validator->errors()->add('applicant', $applicant->message);
            }

        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // storing PatentDetail data
        $dataPatentDetail = [
            'patent_type_id' => $request->patent_type_id, 
            'applicant_criterias_id' => $request->applicant_criteria_id,
            'status' => AjuanStatus::AdminProcess,
            'is_submited' => 1,
        ];

        if ($request->is_fractions == 'yes') {
            $dataPatentDetail['is_fractions'] = 1;
            $dataPatentDetail['fractions_number'] = $request->fractions_number;
            $dataPatentDetail['fractions_date'] = $request->fractions_date;
        }else {
            $dataPatentDetail['is_fractions'] = 0;
            $dataPatentDetail['fractions_number'] = null;
            $dataPatentDetail['fractions_date'] = null;
        }
        
        $patentDetail->update($dataPatentDetail);
        
        // storing PatentDetail data
        // $dataPatentApplicant = [
        //     'name' => $request->name_applicant,
        //     'email' => $request->email_applicant,
        //     'telephone' => $request->no_telp_applicant,
        //     'nationality_id' => $request->nationality_id_applicant,
        //     'country_id' => $request->country_id_applicant,
        //     'address' => $request->address_applicant,
        // ];

        // if ($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
        //     $dataPatentApplicant['province_id'] = $request->province_id_applicant;
        //     $dataPatentApplicant['district_id'] = $request->district_id_applicant;
        //     $dataPatentApplicant['subdistrict_id'] = $request->subdistrict_id_applicant;
        // }else {
        //     $dataPatentApplicant['province_id'] = null;
        //     $dataPatentApplicant['district_id'] = null;
        //     $dataPatentApplicant['subdistrict_id'] = null;
        // }
        
        // $patentDetail->PatentApplicants()->create($dataPatentApplicant);
        
        // document
        $dataPatentDocument = [
            'title_id' => $request->invention_title_id,
            'abstract_id' => $request->invention_abstract_id,
        ];
        
        if ($request->invention_title_en) {
            $dataPatentDocument['title_en'] = $request->invention_title_en;
        }else {
            $dataPatentDocument['title_en'] = null;
        }
        
        if ($request->invention_abstract_en) {
            $dataPatentDocument['abstract_en'] = $request->invention_abstract_en;
        }else {
            $dataPatentDocument['abstract_en'] = null;
        }

        $patentDetail->PatentDocument()->create($dataPatentDocument);
        
        foreach ($request->claim_add as $index => $claim_add) {
            $dataPatentClaim = [
                'iteration' => $index+1,
                'claim' => $claim_add,
            ];

            $patentDetail->PatentClaims()->create($dataPatentClaim);
        }

        // attachment
        $dataPatentAttachment = [];
        
        if($request->description_attachment_id){
            $dataPatentAttachment['attachment']['description_id'] = $request->file('description_attachment_id')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->description_attachment_en){
            $dataPatentAttachment['attachment']['description_en'] = $request->file('description_attachment_en')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->sequence_attachment){
            $dataPatentAttachment['attachment']['sequence'] = $request->file('sequence_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->claim_attachment){
            $dataPatentAttachment['attachment']['claim'] = $request->file('claim_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->abstract_attachment){
            $dataPatentAttachment['attachment']['abstract'] = $request->file('abstract_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->technical_pict_attachment){
            $dataPatentAttachment['attachment']['technical_pict'] = $request->file('technical_pict_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->pict_to_show_on_announcement_attachment){
            $dataPatentAttachment['attachment']['pict_to_show_on_announcement'] = $request->file('pict_to_show_on_announcement_attachment')->store('attachment_patent_'.$patentDetail->id);
        }

        $patentDetail->PatentAttachment()->create($dataPatentAttachment);

        Alert::toast('Success Menambahkan Ajuan', 'success');

        return to_route('user.ajuan.index');

        // return $patentDetail;
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
        $patentDetail->load([
            'PatentDocument',
            'PatentClaims',
            'PatentAttachment',
            'PatentNewComment',
        ]);

        $data = [
            'patentDetail' => $patentDetail,
            'patent_types' => PatentType::all(),
            'applicant_criterias' => ApplicantCriteria::all(),
            'kewarganegaraans' => Country::all(),
            'provinsis' => Province::all(),
        ];
        // return $data;
        return view('user.ajuan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatentDetail $patentDetail)
    {
        $patentDetail->load([
            'PatentApplicant',
            'PatentDocument',
            'PatentClaims',
            'PatentAttachment',
        ]);

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

            "invention_title_id" => ['required'],
            "claim_add.*" => ['required', new required_striptags],
            "invention_abstract_id" => ['required', new MaxWord(200)],
            "invention_abstract_en" => [new MaxWord(200)],

            "description_attachment_id" => [File::types(['pdf'])->max(5000)],
            "description_attachment_en" => [File::types(['pdf'])->max(5000)],
            "sequence_attachment" => [File::types(['pdf'])->max(5000)],
            "claim_attachment" => [File::types(['pdf'])->max(5000)],
            "abstract_attachment" => [File::types(['pdf'])->max(5000)],
            "technical_pict_attachment" => [File::types(['pdf'])->max(5000)],
            "pict_to_show_on_announcement_attachment" => [File::types(['pdf'])->max(5000)],
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

            "invention_title_id" => 'Judul Invensi (Indonesia)',
            "invention_title_en" => 'Judul Invensi (Inggris)',
            "invention_abstract_id" => 'Abstrak (Indonesia)',
            "invention_abstract_en" => 'Abstrak (Inggris)',
            "claim_add.*" => 'Klaim',

            "description_attachment_id" => "Deskripsi (Indonesia)",
            "description_attachment_en" => "Deskripsi (Inggris)",
            "sequence_attachment" => "Sequence",
            "claim_attachment" => "Klaim",
            "abstract_attachment" => "Abstrak",
            "technical_pict_attachment" => "Gambar teknik",
            "pict_to_show_on_announcement_attachment" => "Gambar yang akan digunakan di pengumuman",
        ];
        
        $validator = Validator::make(
            data: $request->all(),
            rules: $rules,
            attributes: $attributes,
        );

        $validator->after(function (ValidationValidator $validator) use ($patentDetail) {
            $inventor = $patentDetail->isInventorExist($this->_minInventorCount);
            if ($inventor->status == false) {
                $validator->errors()->add('inventor', $inventor->message);
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // storing PatentDetail data
        $dataPatentDetail = [
            'patent_type_id' => $request->patent_type_id, 
            'applicant_criterias_id' => $request->applicant_criteria_id,
            // 'is_fractions' => $request->is_fractions,
            'status' => AjuanStatus::AdminProcess,
            'is_submited' => 1,
        ];

        if ($request->is_fractions == 'yes') {
            $dataPatentDetail['is_fractions'] = 1;
            $dataPatentDetail['fractions_number'] = $request->fractions_number;
            $dataPatentDetail['fractions_date'] = $request->fractions_date;
        }else {
            $dataPatentDetail['is_fractions'] = 0;
            $dataPatentDetail['fractions_number'] = null;
            $dataPatentDetail['fractions_date'] = null;
        }
        
        $patentDetail->update($dataPatentDetail);

        // storing PatentDetail data
        // $dataPatentApplicant = [
        //     'name' => $request->name_applicant,
        //     'email' => $request->email_applicant,
        //     'telephone' => $request->no_telp_applicant,
        //     'nationality_id' => $request->nationality_id_applicant,
        //     'country_id' => $request->country_id_applicant,
        //     'address' => $request->address_applicant,
        // ];

        // if ($request->country_id_applicant == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
        //     $dataPatentApplicant['province_id'] = $request->province_id_applicant;
        //     $dataPatentApplicant['district_id'] = $request->district_id_applicant;
        //     $dataPatentApplicant['subdistrict_id'] = $request->subdistrict_id_applicant;
        // }else {
        //     $dataPatentApplicant['province_id'] = null;
        //     $dataPatentApplicant['district_id'] = null;
        //     $dataPatentApplicant['subdistrict_id'] = null;
        // }
        
        // $patentDetail->PatentApplicant()->update($dataPatentApplicant);

        // document
        $dataPatentDocument = [
            'title_id' => $request->invention_title_id,
            'abstract_id' => $request->invention_abstract_id,
        ];
        
        if ($request->invention_title_en) {
            $dataPatentDocument['title_en'] = $request->invention_title_en;
        }else {
            $dataPatentDocument['title_en'] = null;
        }
        
        if ($request->invention_abstract_en) {
            $dataPatentDocument['abstract_en'] = $request->invention_abstract_en;
        }else {
            $dataPatentDocument['abstract_en'] = null;
        }

        $patentDetail->PatentDocument()->update($dataPatentDocument);

        $patentDetail->PatentClaims()->delete();
        foreach ($request->claim_add as $index => $claim_add) {
            $dataPatentClaim = [
                'iteration' => $index+1,
                'claim' => $claim_add,
            ];

            $patentDetail->PatentClaims()->create($dataPatentClaim);
        }

        $dataPatentAttachment = [];
        
        if($request->description_attachment_id){
            Storage::delete($patentDetail->PatentAttachment->attachment['description_id']);
            $dataPatentAttachment['attachment->description_id'] = $request->file('description_attachment_id')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->description_attachment_en){
            Storage::delete($patentDetail->PatentAttachment->attachment['description_en']);
            $dataPatentAttachment['attachment->description_en'] = $request->file('description_attachment_en')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->sequence_attachment){
            Storage::delete($patentDetail->PatentAttachment->attachment['sequence']);
            $dataPatentAttachment['attachment->sequence'] = $request->file('sequence_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->claim_attachment){
            Storage::delete($patentDetail->PatentAttachment->attachment['claim']);
            $dataPatentAttachment['attachment->claim'] = $request->file('claim_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->abstract_attachment){
            Storage::delete($patentDetail->PatentAttachment->attachment['abstract']);
            $dataPatentAttachment['attachment->abstract'] = $request->file('abstract_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->technical_pict_attachment){
            Storage::delete($patentDetail->PatentAttachment->attachment['technical_pict']);
            $dataPatentAttachment['attachment->technical_pict'] = $request->file('technical_pict_attachment')->store('attachment_patent_'.$patentDetail->id);
        }
        if($request->pict_to_show_on_announcement_attachment){
            Storage::delete($patentDetail->PatentAttachment->attachment['pict_to_show_on_announcement']);
            $dataPatentAttachment['attachment->pict_to_show_on_announcement'] = $request->file('pict_to_show_on_announcement_attachment')->store('attachment_patent_'.$patentDetail->id);
        }

        $patentDetail->PatentAttachment()->update($dataPatentAttachment);

        Alert::toast('Success Edit Ajuan', 'success');

        return to_route('user.ajuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatentDetail $patentDetail)
    {
        $patentDetail->delete();

        return 'success';
    }

    public function destroyInventor(PatentDetail $patentDetail, PatentInventor $patentInventor)
    {
        $patentInventor->delete();
        return 'success';
    }

    public function destroyApplicant(PatentDetail $patentDetail, PatentApplicant $patentApplicant)
    {
        $patentApplicant->delete();
        return 'success';
    }

    public function data() {
        $data = Auth::user()->applications;

        $data->load('PatentDocument');

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
            'email' => $defaultCorrespondent->email,
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

        return $patentDetail->id;
    }

    function log(PatentDetail $patentDetail) {
        $patentDetail->load([
            'PatentComments',
        ]);

        return view('user.ajuan.log', ['patentDetail' => $patentDetail]);
    }
}
