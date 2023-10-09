<?php

namespace App\Http\Controllers;

use App\Models\ecole;
use App\Models\dren;
use App\Models\eleve;
use Illuminate\Http\Request;

class test extends Controller
{
    public function index(){   
        
        $eleves = eleve::with('eleve_ecole')->where('eleves.id',11)->get();
      foreach($eleves as $item){
        @dump($item['eleve_ecole']->CODE_DREN);
        @dump(dren::where('code_dren','=',$item['eleve_ecole']->CODE_DREN)->get());
      }
    
       

        return 'hello';
    }
}
