<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\GraphImport;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('backend.import.index');
    }

    public function import_processed()
    {
        //validation when upload file data
        Excel::import(new GraphImport, request()->file('file_data'));

        return redirect('importcsv')->with('success', 'Import data successfully!');
    }
}
