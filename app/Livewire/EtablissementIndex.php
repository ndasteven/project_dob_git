<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class EtablissementIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $CODSERVs, $NOMCOMPLs, $GENREs, $CODE_DREN;
    public $search;
    public $icon;
    private function resetInput(){
        $this->CODSERVs=$this->NOMCOMPLs=$this->GENREs=$this->CODE_DREN='';
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
         ];
    public function research(){
        $this->search = $this->search; 
    }

    public string $orderField= 'NOMCOMPLs';
    public string $orderDirection = 'ASC';


    //FONCTION DE FILTRRE
    public function setOrderField(string $nom){
        if($nom === $this->orderField){
            $this->orderDirection = $this->orderDirection ==='ASC' ? 'DESC': 'ASC';
            $this->icon ='check';
        }else{
            $this->orderField = $nom;
            $this->reset('orderDirection');   
        }
    }
    public function storeEtablissement(){

        $validate = $this->validate([
            'CODSERVs'=>'required|min:1|integer',
            'NOMCOMPLs'=>'required|min:3', 
            'GENREs'=>'required|min:1',
            'CODE_DREN'=>'required:min:1|integer',    
        ]);
 
        if(!ecole::where('CODSERVs', $this->CODSERVs)->exists() || !ecole::where('NOMCOMPLs', $this->CODSERVs)->exists() ){
            ecole::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            
        }
        else
        {
            session()->flash('error', 'le code Etablissement existe déjà');
        }

    }
    public function updateEtablissement(){

        $validate = $this->validate([
            'CODSERVs'=>'required|min:1|integer',
            'NOMCOMPLs'=>'required|min:3', 
            'GENREs'=>'required|min:1',
            'CODE_DREN'=>'required:min:1|integer',    
        ]);
 
        if(!ecole::where('CODSERVs', $this->CODSERVs)->exists() || !ecole::where('NOMCOMPLs', $this->CODSERVs)->exists() ){
            ecole::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            
        }
        else
        {
            session()->flash('error', 'le code Etablissement existe déjà');
        }

    }
    public function render()
    {
        
        
        return view('livewire.etablissement-index',[
            'etablissements'=> ecole::with('ecole_dren')->where($this->orderField, 'LIKE', '%'.$this->search.'%')
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(10),
            
            'codeDren'=>  dren::select('code_dren','nom_dren')
            ->orderBy('code_dren', 'ASC')
            ->get()  
        ]);
        
    }
}
