<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Models\Village;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function provinces()
    {
        return Province::select('id','name','khmer_name','code')
            ->orderBy('name')
            ->get();
    }

    public function districts(Request $request)
    {
        $request->validate(['province_id' => ['required','integer']]);

        return District::select('id','name','khmer_name','code','province_id')
            ->where('province_id', $request->province_id)
            ->orderBy('name')
            ->get();
    }

    public function communes(Request $request)
    {
        $request->validate([
            'province_id' => ['required','integer'],
            'district_id' => ['required','integer'],
        ]);

        return Commune::select('id','name','khmer_name','code','province_id','district_id')
            ->where('province_id', $request->province_id)
            ->where('district_id', $request->district_id)
            ->orderBy('name')
            ->get();
    }

    public function villages(Request $request)
    {
        $request->validate(['commune_id' => ['required','integer']]);

        return Village::select('id','name','khmer_name','code','commune_id')
            ->where('commune_id', $request->commune_id)
            ->orderBy('name')
            ->get();
    }

    // ✅ Quick search villages (type -> click -> auto fill chain)
    public function searchVillages(Request $request)
    {
        $request->validate([
            'q' => ['required','string','min:1','max:100'],
        ]);

        $q = $request->q;

        return Village::select(
                'id','name','khmer_name','code',
                'province_id','district_id','commune_id'
            )
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('khmer_name', 'like', "%$q%")
                      ->orWhere('code', 'like', "%$q%");
            })
            ->orderBy('name')
            ->limit(30)
            ->get();
    }
}
