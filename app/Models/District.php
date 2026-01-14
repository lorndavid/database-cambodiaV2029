<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['type','code','khmer_name','name','province_id'];

    public function province() { return $this->belongsTo(Province::class, 'province_id'); }
    public function communes() { return $this->hasMany(Commune::class, 'district_id'); }
    public function villages() { return $this->hasMany(Village::class, 'district_id'); }
}
