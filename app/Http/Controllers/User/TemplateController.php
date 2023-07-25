<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\TemplateDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templateDocument = TemplateDocument::all();
        return view('user.template.index', ['templateDocuments' => $templateDocument]);
    }

    public function download(TemplateDocument $templateDocument)
    {
        // return $templateDocument;
        return Storage::download($templateDocument->file, $templateDocument->file_name);
    }
}
