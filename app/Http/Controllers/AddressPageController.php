<?php

namespace App\Http\Controllers;

use App\Models\AddressSubmission;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Models\Village;
use Illuminate\Http\Request;

class AddressPageController extends Controller
{
    public function show()
    {
        return view('address');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'user_name'   => ['required','string','min:2','max:80'],
            'lang'        => ['required','in:en,km'],

            'province_id' => ['required','integer'],
            'district_id' => ['required','integer'],
            'commune_id'  => ['required','integer'],
            'village_id'  => ['required','integer'],
        ]);

        // fetch rows (with safety filters to ensure correct chain)
        $province = Province::findOrFail($data['province_id']);

        $district = District::where('province_id', $province->id)
            ->findOrFail($data['district_id']);

        $commune = Commune::where('district_id', $district->id)
            ->findOrFail($data['commune_id']);

        $village = Village::where('commune_id', $commune->id)
            ->findOrFail($data['village_id']);

        // ✅ Save name in chosen language
        $lang = $data['lang'];

        $provinceName = $lang === 'km'
            ? ($province->khmer_name ?? $province->name)
            : ($province->name ?? $province->khmer_name);

        $districtName = $lang === 'km'
            ? ($district->khmer_name ?? $district->name)
            : ($district->name ?? $district->khmer_name);

        $communeName = $lang === 'km'
            ? ($commune->khmer_name ?? $commune->name)
            : ($commune->name ?? $commune->khmer_name);

        $villageName = $lang === 'km'
            ? ($village->khmer_name ?? $village->name)
            : ($village->name ?? $village->khmer_name);

        AddressSubmission::create([
            'user_name' => $data['user_name'],
            'lang'      => $lang,

            'province_id' => $province->id,
            'district_id' => $district->id,
            'commune_id'  => $commune->id,
            'village_id'  => $village->id,

            'province_name' => $provinceName,
            'district_name' => $districtName,
            'commune_name'  => $communeName,
            'village_name'  => $villageName,
        ]);

        return back()->with('success', 'Saved ✅');
    }
}
