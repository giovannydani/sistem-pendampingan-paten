<?php

namespace App\Http\Controllers\Admin;

use App\Models\PatentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PatentType $patentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatentType $patentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatentType $patentType)
    {
        //
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
