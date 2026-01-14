<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';
    protected $fillable = ['type','code','khmer_name','name','province_id','district_id'];

    public function province() { return $this->belongsTo(Province::class, 'province_id'); }
    public function district() { return $this->belongsTo(District::class, 'district_id'); }
    public function villages() { return $this->hasMany(Village::class, 'commune_id'); }
}
