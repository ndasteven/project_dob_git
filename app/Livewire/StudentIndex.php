<?php

namespace App\Livewire;

use App\Models\ecole;
use App\Models\eleve;
use App\Models\Student;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class StudentIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $matricule, $nom, $prenom, $genre, $tgp, $dateNaissance, $contactParent,  $fichier,$ecole_id ;
    public $fileName;
    public $search;
    public $icon;
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
    ];
    public function research(){
        $this->search = $this->search; 
    }
    public function getfilenames(){
        $this->fileName ='file name : ' ;
    }
    public string $orderField= 'nom';
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

    private function resetInput(){
        $this->matricule=$this->nom=$this->prenom=$this->genre=$this->tgp=$this->dateNaissance=$this->contactParent=$this->fichier=$this->ecole_id='';
    }

    public function storeStudent(){
           
        $validate = $this->validate([
            'matricule'=>'required|min:6',
            'nom'=>'required|min:3',
            'prenom'=>'required|min:6',
            'genre'=>'required|min:1',
            'tgp'=>'required',
            'dateNaissance'=>'required|date',
            'contactParent'=>'',
            'fichier' =>'required|mimes:pdf|',
            'ecole_id' =>'required|min:1'  
            
        ]);
        
        if($this->fichier!==null ){
            $extensiValide = array("PDF","pdf");
            $fichiers = $this->fichier->store('public/fiche_orientation');
            $this->fichier= basename($fichiers);
            $validate['fichier'] = $this->fichier;
            
            if(in_array((pathinfo($this->fichier, PATHINFO_EXTENSION)),$extensiValide)){
        
                if(!eleve::where('matricule', $this->matricule)->exists()){
                    eleve::create($validate);
                    session()->flash("success", "Enregistrement effectué avec succès");
                    $this->resetInput();
                    
                }else
                {
                    session()->flash('error', 'Matricule existe déjà');
                }
            }else{
                $this->fileName='erreur de fichier! selectionner le bon fichier';
            }
        } 
        
        

        
    }

    public function show(){

    }

    public function render()
    {
        return view('livewire.student-index', [
            'students'=> eleve::where($this->orderField, 'LIKE', '%'.$this->search.'%')
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(10),
            
            'ecole'=>ecole::select('id','NOMCOMPLs')->get()
            
        ]);
    }
}
