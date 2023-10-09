<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fiche extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','fiche_nom','classe','ecole_id','dren_id','annee',
    ];

    public function fiche_dren(){
        return 	$this->belongsTo(dren::class,'dren_id','id');
    }
    public function fiche_ecole(){
        return 	$this->belongsTo(ecole::class,'ecole_id','id');
    }

}
