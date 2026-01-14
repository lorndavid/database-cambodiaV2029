<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['type','code','khmer_name','name'];

    public function districts() { return $this->hasMany(District::class, 'province_id'); }
    public function communes()  { return $this->hasMany(Commune::class, 'province_id'); }
    public function villages()  { return $this->hasMany(Village::class, 'province_id'); }
}
