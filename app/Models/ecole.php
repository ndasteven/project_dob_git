<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ecole extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'CODSERVs','NOMCOMPLs','GENREs','CODE_DREN'
    ];
    public function ecole_dren(){
        return $this->belongsTo(dren::class, 'CODE_DREN', 'code_dren');//CODE_DREN : cle etrangere dans ecole et code_dren est la cle primaire
    }
    public function ecole_eleve(){
        return $this->hasMany(eleve::class);
    }
    public function ecole_fiche(){
        return $this->hasMany(fiche::class);
    }
}
