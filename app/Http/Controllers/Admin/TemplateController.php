<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TemplateDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.template.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.template.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:255'],
                'file' => ['required', 'file'],
            ],
        )->validate();

        TemplateDocument::create([
            'name' => $request->name,
            'file' => $request->file('file')->store('template-document'),
            'file_name' => $request->file('file')->getClientOriginalName(),
        ]);

        Alert::toast('Success Adding Document', 'success');

        return redirect()->to(route('admin.template.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemplateDocument $templateDocument)
    {
        return view('admin.template.edit', ['templateDocument' => $templateDocument]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemplateDocument $templateDocument)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:255'],
                'file' => ['file'],
            ],
        )->validate();

        $data = [
            'name' => $request->name,
        ];

        if ($request->file('file')) {
            Storage::delete($templateDocument->file);

            $data['file'] = $request->file('file')->store('template-document');
            $data['file_name'] = $request->file('file')->getClientOriginalName();
        }

        $templateDocument->update($data);

        Alert::toast('Success Edit Document', 'success');

        return redirect()->to(route('admin.template.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemplateDocument $templateDocument)
    {
        Storage::delete($templateDocument->file);

        $templateDocument->delete();
        return "sucess";
    }

    public function data()
    {
        $data = TemplateDocument::all();

        return DataTables::of($data)->make(true);
    }
}
