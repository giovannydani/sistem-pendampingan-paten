<?php

namespace App\Http\Controllers\Admin;

use App\Models\PatentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PatentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.patent_type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patent_type.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatorr = Validator::make(
            data: $request->all(),
            rules: [
                'name' => 'required',
            ],
            attributes: [
                'name' => 'nama tipe'
            ],
        )
        ->validate();

        $data = [
            'name' => $request->name
        ];

        PatentType::create($data);

        Alert::toast('Success Menambahkan Tipe', 'success');

        return to_route('admin.patent-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatentType $patentType)
    {
        return view('admin.patent_type.edit', [
            'patentType' => $patentType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatentType $patentType)
    {
        // return $patentType;
        $validatorr = Validator::make(
            data: $request->all(),
            rules: [
                'name' => 'required',
            ],
            attributes: [
                'name' => 'nama tipe'
            ],
        )
        ->validate();

        $data = [
            'name' => $request->name
        ];

        $patentType->update($data);

        Alert::toast('Success Update Tipe', 'success');

        return to_route('admin.patent-type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatentType $patentType)
    {
        $patentType->delete();

        return 'success';
    }

    public function restore(PatentType $patentType)
    {
        $patentType->restore();

        return 'success';
    }

    public function data()
    {
        $data = PatentType::withTrashed()->get();

        return DataTables::of($data)->make(true);
    }
}
