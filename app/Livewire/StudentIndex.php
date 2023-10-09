<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use App\Models\eleve;
use App\Models\fiche;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class StudentIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $matricule, $nom, $prenom, $genre, $tgp, $dateNaissance, $contactParent, $ecole_id,$ecole_A, $classe, $mo, $serie, $fiche_id ;
    public $fileName;
    public $search;
    public $icon;
    public $eleveInfo;
    public $drenOrigine;
    public $drenAccueil;
    public $class;
    public $creer;
    public $edit;
    public $id_eleve;
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
    ];
    public function research(){
        $this->search = $this->search;
        $this->nom = $this->nom;
        $this->prenom = $this->prenom; 
        $this->genre = $this->genre;
        $this->dateNaissance = $this->dateNaissance;
        $this->matricule = $this->matricule;
        $this->classe = $this->classe;
        $this->serie = $this->serie;
    }
    public function getfilenames(){
        $this->fileName ='file name : ' ;
    }
    public string $orderField= 'nom';
    public string $orderDirection = 'ASC';

    public function closeStudent(){
        $this->eleveInfo='';
   
    } 

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
    public function create(){
        $this->creer = true;
        $this->edit = false;
        $this->resetInput();
    }
    public function update($id){
        $this->id_eleve=$id;
        $this->creer = false;
        $this->edit = true;
        $eleveupdate = eleve::findOrFail($id);
        $this->matricule = $eleveupdate->matricule;
        $this->nom = $eleveupdate->nom  ;
        $this->prenom = $eleveupdate->prenom  ;
        $this->classe = $eleveupdate->classe  ;
        $this->genre = $eleveupdate->genre  ;
        $this->tgp = $eleveupdate->tgp  ;
        $this->mo = $eleveupdate->mo  ;
        $this->serie = $eleveupdate->serie  ;
        $this->dateNaissance = $eleveupdate->dateNaissance  ;
        $this->contactParent = $eleveupdate->contactParent  ;
        $this->ecole_id = $eleveupdate->ecole_id;
        $this->ecole_A = $eleveupdate->ecole_A;
        $this->fiche_id = $eleveupdate->fiche_id;
        
    }
    
    public function cancel(){
        $this->creer =false;
        $this->edit = false;
        $this->resetInput();
    }
    private function resetInput(){
        $this->matricule=$this->nom=$this->prenom=$this->genre=$this->tgp=$this->dateNaissance=$this->contactParent=$this->ecole_id=$this->ecole_A=$this->classe=$this->mo=$this->serie=$this->fiche_id='';
        
    }
    public function studentInfo($id){
        $this->eleveInfo = eleve::with('eleve_ecole_O')->where('eleves.id',$id)->get();
        $dren_O = dren::where('code_dren',$this->eleveInfo[0]['eleve_ecole_O']->CODE_DREN)->get();
        $this->drenOrigine=$dren_O[0]->nom_dren;
        $dren_A = dren::where('code_dren',$this->eleveInfo[0]['eleve_ecole_A']->CODE_DREN)->get();
        $this->drenAccueil=$dren_A[0]->nom_dren;
        
        /*
        $this->eleveInfo= eleve::where('eleves.id',$id)
        ->join('ecoles', 'eleves.ecole_id', '=', 'ecoles.id')
        ->join('drens', 'drens.code_dren','=','ecoles.CODE_DREN')
        ->get() ;
        */
       
        
    }
    public function selectclasse(){
        if($this->classe=='2nde'){
            
        }else{
            $this->serie = 'NA';
            $this->mo = 0.00;
        }
    }
    public function storeStudent(){
        
        $validate = $this->validate([
            'matricule'=>'required|min:6',
            'nom'=>'required|min:2',
            'prenom'=>'required|min:2',
            'classe'=>'required|min:3',
            'genre'=>'required|min:1',
            'tgp'=>'',
            'mo'=>'',
            'dateNaissance'=>'',
            'contactParent'=>'',
            'ecole_id' =>'required|min:1',
            'ecole_A' =>'required|min:1',
            'serie'=>'required|min:1',
            'fiche_id' =>'required|min:1',  
            
        ]);
        
        if(strlen($this->tgp)==0 ){
            $validate['tgp']=1;
         };
         if(strlen($this->mo)==0 ){
            $validate['mo']=1;
         };
         if(strlen($this->dateNaissance)==0 ){
            $validate['dateNaissance']='0000-01-01';
         };
        if(!$this->classe=='2nde'){
            $validate['serie']=$this->serie;
            $validate['mo']=$this->mo;
        }
        if(!eleve::where('matricule', $this->matricule)->exists()){
            eleve::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            
        }else
        {
            session()->flash('error', 'Matricule existe déjà');
        }
        
        

        
    }
    public function updateStudent(){
        $validate = $this->validate([
            'matricule'=>'required|min:6',
            'nom'=>'required|min:3',
            'prenom'=>'required|min:3',
            'classe'=>'required|min:3',
            'genre'=>'required|min:1',
            'tgp'=>'',
            'mo'=>'',
            'dateNaissance'=>'',
            'contactParent'=>'',
            'ecole_id' =>'required|min:1',
            'ecole_A' =>'required|min:1',
            'serie'=>'required|min:1',
            'fiche_id' =>'required|min:1',     
        ]);
        if(!$this->classe=='2nde'){
            $validate['serie']=$this->serie;
            $validate['mo']=$this->mo;
        }
        $eleveupdate = eleve::find($this->id_eleve);
        if($eleveupdate->update($validate)){
            session()->flash("success", "Mise à jour effectué avec succès");
        }else{
            session()->flash("error", "Erreur de mise à jour");
        } 
        
    }
    public function show(){

    }

    public function render()
    { 
        return view('livewire.student-index', [
            'students'=> eleve::where($this->orderField, 'LIKE', '%'.$this->search.'%')
            ->with('eleve_ecole_A')
            ->with('eleve_fiche')
            ->where('nom', 'LIKE', '%'.$this->nom.'%')
            ->where('prenom', 'LIKE', '%'.$this->prenom.'%')
            ->where('matricule', 'LIKE', '%'.$this->matricule.'%')
            ->where('dateNaissance', 'LIKE', '%'.$this->dateNaissance.'%')
            ->where('serie', 'LIKE', '%'.$this->serie.'%')
            ->where('classe', 'LIKE', '%'.$this->classe.'%')
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(10),
            
            'ecole'=>ecole::select('id','NOMCOMPLs')->get(), 
            'fiche'=> fiche::with('fiche_ecole')->with('fiche_dren')->get()
            
        ]);
    }
}
