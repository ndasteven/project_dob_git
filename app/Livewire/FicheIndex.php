<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use App\Models\fiche;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class FicheIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';   
    public $nom, $fiche_nom, $classe, $annee, $ecole_id, $dren_id;
    public $search;
    public $icon;
    public $fileName;
    private function resetInput(){
        $this->nom = $this->fiche_nom=$this->classe=$this->annee=$this->ecole_id=$this->dren_id ="";
    }
    public function getfilenames(){
       
        $this->fileName ='file name : ' ;
    }
    public string $orderField= 'nom';
    public string $orderDirection = 'ASC';
    public function setOrderField(string $nom){
        if($nom === $this->orderField){
            $this->orderDirection = $this->orderDirection ==='ASC' ? 'DESC': 'ASC';
            $this->icon ='check';
        }else{
            $this->orderField = $nom;
            $this->reset('orderDirection');
            
        }
       
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
    ];
    public function research(){
        $this->search = $this->search;
    }
    public function storeFiche(){
        $validate = $this->validate([
            'nom'=>'required|min:3',
            'fiche_nom'=>'required|file|mimes:pdf|max:4000',
            'classe'=>'required|min:1',
            'ecole_id'=>'required|min:1',
            'dren_id'=>'required|min:1',
            'annee'=>'required|min:4',
        ]);
        if($this->fiche_nom!==null ){
            $extensiValide = array("PDF","pdf");
            $fichiers = $this->fiche_nom->store('fiche_orientation', 'public');
            $this->fiche_nom= basename($fichiers);
            $validate['fiche_nom'] = $this->fiche_nom;
            
            if(in_array((pathinfo($this->fiche_nom, PATHINFO_EXTENSION)),$extensiValide)){
                    fiche::create($validate);
                    session()->flash("success", "Enregistrement effectué avec succès");
                    $this->resetInput();
                    $this->fiche_nom==null;
            }else{
                $this->fileName='erreur de fichier! selectionner le bon fichier';
            }
        } 
        
    }
    public function render()
    {
        return view('livewire.fiche-index',[
            'fiche'=> fiche::with('fiche_ecole')->with('fiche_dren')->where($this->orderField, 'LIKE', '%'.$this->search.'%')->paginate(10),
            
            'ecole'=>ecole::select('id','NOMCOMPLs')->get(),
            'codeDren'=>  dren::select('code_dren','nom_dren')
            ->orderBy('code_dren', 'ASC')
            ->get()  
        ]);
    }
}
