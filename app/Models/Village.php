<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';
    protected $fillable = ['type','code','khmer_name','name','province_id','district_id','commune_id'];

    public function province() { return $this->belongsTo(Province::class, 'province_id'); }
    public function district() { return $this->belongsTo(District::class, 'district_id'); }
    public function commune()  { return $this->belongsTo(Commune::class, 'commune_id'); }
}
