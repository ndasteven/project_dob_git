<?php

namespace App\Http\Controllers;

use App\Models\ecole;
use App\Models\dren;
use App\Models\eleve;
use Illuminate\Http\Request;

class test extends Controller
{
    public function index(){     
        //$ecole = ecole::with('ecole_dren')->get();
        //$dren = dren::find(13);
        //dump($dren->dren_ecole);
        //dump($ecole->dren->nom_dren);
        
        return 'hello';
    }
}
