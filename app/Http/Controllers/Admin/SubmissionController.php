<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddressSubmission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $items = AddressSubmission::query()
            ->when($q, function ($query) use ($q) {
                $query->where('user_name', 'like', "%$q%")
                      ->orWhere('province_name', 'like', "%$q%")
                      ->orWhere('district_name', 'like', "%$q%")
                      ->orWhere('commune_name', 'like', "%$q%")
                      ->orWhere('village_name', 'like', "%$q%");
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.submissions', compact('items', 'q'));
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'address_submissions.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');

            fputcsv($out, [
                'id','user_name','lang',
                'province','district','commune','village',
                'province_id','district_id','commune_id','village_id',
                'created_at'
            ]);

            AddressSubmission::orderBy('id')->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->id,
                        $r->user_name,
                        $r->lang,
                        $r->province_name,
                        $r->district_name,
                        $r->commune_name,
                        $r->village_name,
                        $r->province_id,
                        $r->district_id,
                        $r->commune_id,
                        $r->village_id,
                        $r->created_at,
                    ]);
                }
            });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
