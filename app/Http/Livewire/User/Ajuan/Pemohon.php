<?php

namespace App\Http\Livewire\User\Ajuan;

use App\Models\Country;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\PatentApplicant;
use Illuminate\Validation\Rule;

class Pemohon extends Component
{
    public $ids;
    public $data;
    public $applicants = [];
    public $countries = [];
    public $kewarganegaraans;

    public function mount($id)
    {
        $this->ids = $id;

        $this->countries = Country::all();

        // $this->data['country'] = Country::all();

        $this->data['provinsis'] = Province::all();

        $this->gettingApplicants();
        
    }

    public function gettingApplicants() {
        $this->applicants =  PatentApplicant::query()
                            ->where('detail_id', $this->ids)
                            ->with([
                                'Nationality',
                                'Country',
                                'Province',
                                'District',
                                'Subdistrict',
                            ])
                            ->get();
    }

    public function openModalAdd()
    {
        $this->dispatchBrowserEvent('openModalAddApplicant');
    }

    public function closeModalAddApplicant()
    {
        $this->dispatchBrowserEvent('closeModalAddApplicant');
    }

    public $name;
    public $nationality_id;
    public $country_id;
    public $address;
    public $province_id;
    public $district_id;
    public $subdistrict_id;
    public $email;
    public $no_telp;
    public $is_company;

    public $districts = [];
    public $subdistricts = [];

    public function rst()
    {
        $this->resetExcept('data', 'ids', 'countries');
    }

    public function updatedProvinceId($value)
    {
        if ($value != "") {
            $this->districts = District::where('province_id', $value)->get();
        }else {
            $this->districts = [];
        }
    }

    
    public function updatedDistrictId($value)
    {
        if ($value != "") {
            $this->subdistricts = Subdistrict::where('district_id', $value)->get();
        }else {
            $this->subdistricts = [];
        }
    }

    public function saveApplicant() {
        $this->validate([
            'name' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required'],
            'nationality_id' => ['required'],
            'address' => ['required'],
            'country_id' => ['required'],
            'province_id' => [Rule::requiredIf($this->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            'district_id' => [Rule::requiredIf($this->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            'subdistrict_id' => [Rule::requiredIf($this->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
        ]);

        
        $dataCreate = [
            'detail_id' => $this->ids,
            'name' => $this->name,
            'nationality_id' => $this->nationality_id,
            'address' => $this->address,
            'country_id' => $this->country_id,
            'email' => $this->email,
            'telephone' => $this->no_telp,
        ];

        if ($this->country_id == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $dataCreate['province_id'] = $this->province_id;
            $dataCreate['district_id'] = $this->district_id;
            $dataCreate['subdistrict_id'] = $this->subdistrict_id;
        }else {
            $dataCreate['province_id'] = null;
            $dataCreate['district_id'] = null;
            $dataCreate['subdistrict_id'] = null;
        }

        if ($this->is_company) {
            $dataCreate['is_company'] = $this->is_company;
        }

        PatentApplicant::create($dataCreate);
        $this->rst();
        $this->gettingApplicants();

        $this->closeModalAddApplicant();
    }

    protected $validationAttributes = [
        "name" => 'Nama',
        "nationality_id" => 'Kewarganegaraan',
        "country_id" => 'Negara tempat tinggal',
        "province_id" => 'Provinsi',
        "district_id" => 'Kabupaten / Kota',
        "subdistrict_id" => 'Kecamatan',
        "address" => 'Alamat',
        "email" => 'Email',
        "no_telp" => 'Nomor Telepon',
    ];

    // edit

    public function openModalEdit()
    {
        $this->dispatchBrowserEvent('openModalEditApplicant');
    }

    public function closeModalEditApplicant()
    {
        $this->dispatchBrowserEvent('closeModalEditApplicant');
    }

    public $idsEdit;

    public $name_edit;
    public $nationality_id_edit;
    public $country_id_edit;
    public $province_id_edit;
    public $district_id_edit;
    public $subdistrict_id_edit;
    public $address_edit;
    public $email_edit;
    public $no_telp_edit;
    public $is_company_edit;

    public $districts_edit = [];
    public $subdistricts_edit = [];

    public function edit($id)
    {
        $this->idsEdit = $id;
        $pemohon = PatentApplicant::where('id', $id)->first();

        $this->name_edit = $pemohon['name'];
        $this->nationality_id_edit = $pemohon['nationality_id'];
        $this->country_id_edit = $pemohon['country_id'];
        $this->address_edit = $pemohon['address'];
        $this->email_edit = $pemohon['email'];
        $this->no_telp_edit = $pemohon['telephone'];
        $this->is_company_edit = $pemohon['is_company'];
        
        if ($pemohon['country_id'] == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $this->province_id_edit = $pemohon['province_id'];
            $this->district_id_edit = $pemohon['district_id'];
            $this->subdistrict_id_edit = $pemohon['subdistrict_id'];

            $this->districts_edit = District::where('province_id', $pemohon['province_id'])->get();
            $this->subdistricts_edit = Subdistrict::where('district_id', $pemohon['district_id'])->get();
        }

        $this->openModalEdit();
    }

    public function updatedProvinceIdEdit($value)
    {
        if ($value != "") {
            $this->districts_edit = District::where('province_id', $value)->get();
        }else {
            $this->districts_edit = [];
        }
    }

    
    public function updatedDistrictIdEdit($value)
    {
        if ($value != "") {
            $this->subdistricts_edit = Subdistrict::where('district_id', $value)->get();
        }else {
            $this->subdistricts_edit = [];
        }
    }

    public function editApplicant(PatentApplicant $patentApplicant)
    {
        $this->validate([
            'name_edit' => ['required'],
            'email_edit' => ['required'],
            'no_telp_edit' => ['required'],
            'nationality_id_edit' => ['required'],
            'address_edit' => ['required'],
            'country_id_edit' => ['required'],
            'province_id_edit' => [Rule::requiredIf($this->country_id_edit == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            'district_id_edit' => [Rule::requiredIf($this->country_id_edit == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
            'subdistrict_id_edit' => [Rule::requiredIf($this->country_id_edit == '8d1458c5-dde2-3ac3-901b-29d55074c4ec')],
        ]);

        $dataUpdate = [
            'name' => $this->name_edit,
            'nationality_id' => $this->nationality_id_edit,
            'address' => $this->address_edit,
            'country_id' => $this->country_id_edit,
            'email' => $this->email_edit,
            'telephone' => $this->no_telp_edit,
        ];

        if ($this->country_id_edit == '8d1458c5-dde2-3ac3-901b-29d55074c4ec') {
            $dataUpdate['province_id'] = $this->province_id_edit;
            $dataUpdate['district_id'] = $this->district_id_edit;
            $dataUpdate['subdistrict_id'] = $this->subdistrict_id_edit;
        }else {
            $dataUpdate['province_id'] = null;
            $dataUpdate['district_id'] = null;
            $dataUpdate['subdistrict_id'] = null;
        }

        if ($this->is_company_edit) {
            $dataUpdate['is_company'] = $this->is_company_edit;
        }else {
            $dataUpdate['is_company'] = 0;
        }

        $patentApplicant->update($dataUpdate);

        $this->rst();
        $this->gettingApplicants();

        $this->closeModalEditApplicant();
    }

    protected $listeners = ['deleteApplicant' => 'deleteApplicant'];
    
    function deleteApplicant() {
        $this->gettingApplicants();
    }

    public function render()
    {
        return view('livewire.user.ajuan.pemohon', $this->data);
    }
}
