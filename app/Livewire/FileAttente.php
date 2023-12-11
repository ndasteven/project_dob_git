<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FileAttente extends Component
{
    public $fileAttente;
    public $countTache;

    public function checkFileAttente(){
        //@dump("hello");
        $countJobs = DB::table('jobs')->count();
        if($countJobs>0){
            $this->countTache = $countJobs;
            $this->fileAttente=true;
            $this->dispatch('desableForm');
        }else{
            $this->fileAttente=false;
            $this->countTache = 0;
            $this->dispatch('ActiveForm');
        }
    }
    public function render()
    {
        return view('livewire.file-attente');
    }
}
