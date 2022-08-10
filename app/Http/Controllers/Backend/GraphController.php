<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Graph;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function index()
    {
        $graphs = Graph::select(DB::raw("COUNT(created_at) as count"), DB::raw("DATE(created_at) as day_date"))
            ->groupBy('day_date')
            ->orderBy('day_date')
            ->get();

        $data = [];

        foreach ($graphs as $row) {
            $data['label'][] = $row->day_date;
            $data['data'][] = (int) $row->count;
        }

        $data['chart_data'] = json_encode($data);
        // dd($data['chart_data']);
        return view('backend.graph.index', compact('data'));
    }
}
