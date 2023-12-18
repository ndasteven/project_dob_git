<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use App\Models\eleve;
use App\Models\fiche;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;



class StudentIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    protected $paginationTheme = 'bootstrap';
    public $matricule, $nom, $prenom, $genre, $dateNaissance, $ecole_id,$ecole_A, $classe, $serie, $fiche_id, $annee, $ecole_origine ;
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
    public $ide;
    public $idSuppr;
    public $idsSelects;
    public $countTableIndex=0;
    public $longueurTable=0;
    public $perPage=10;
    public $restUpdate=0;
    public $errorCount =0;
    public $elevemultipleUpdate;
    public $message_error=[];
    public $serieMultiple;
    public $hasRole="user";
    public $shareAnnee;
    public $shareNiveau;

    public function getfilenames(){
    $this->fileName ='file name : ' ;

    }
    public string $orderField= 'nom';
    public string $orderDirection = 'ASC';

    public function closeStudent(){
        $this->eleveInfo='';
   
    } 
    
    public function research(){
        $this->search = $this->search;
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
        if($this->edit){
            $this->dispatch('modifier');
        }
        $eleveupdate = eleve::findOrFail($id);
        $this->matricule = $eleveupdate->matricule;
        $this->nom = $eleveupdate->nom  ;
        $this->prenom = $eleveupdate->prenom  ;
        $this->annee = $eleveupdate->annee;
        $this->classe = $eleveupdate->classe  ;
        $this->genre = $eleveupdate->genre  ;
        $this->serie = $eleveupdate->serie  ;
        $this->dateNaissance = date('Y-m-d', strtotime($eleveupdate->dateNaissance))   ;
        $this->ecole_id = $eleveupdate->ecole_id;
        $this->ecole_A = $eleveupdate->ecole_A;
        $this->fiche_id = $eleveupdate->fiche_id;
        $this->ecole_origine = $eleveupdate->ecole_origine;
        
    }
    
    public function cancel(){
        $this->creer =false;
        $this->edit = false;
        $this->resetInput();
        $this->dispatch('cancel');
    }
    public function closeUpdate(){
        $this->creer =false;
        $this->edit = false;
        $this->resetInput();
        $this->dispatch('closeUpdate');
    }
    private function resetInput(){
        $this->matricule=$this->nom=$this->prenom=$this->genre=$this->dateNaissance=$this->ecole_id=$this->ecole_A=$this->classe=$this->serie=$this->fiche_id=$this->annee='';
        
    }
    public function verifyStudentSelect(){
        $requete=eleve::where('eleves.id',$this->idsSelects[$this->countTableIndex] );
        $this->elevemultipleUpdate=$requete->get();
        if(strlen($this->elevemultipleUpdate[0]->ecole_id)==null){
            if(strlen($this->elevemultipleUpdate[0]->ecole_origine)!=null){
                
                $words= '%'.$this->elevemultipleUpdate[0]->ecole_origine.'%' ;
                $son_ecole_origin=ecole::where('NOMCOMPLs','like', $words)->get();
                if(count($son_ecole_origin)==0){
                    $this->errorCount +=1;
                    array_push($this->message_error, 'Ecole d\'origine '.$this->elevemultipleUpdate[0]->ecole_origine.' n\'esxiste pas dans la base pour le matricule '. $this->elevemultipleUpdate[0]->matricule);
                }else{
                //ici a selectionner id de son ecole origine 
                $this->elevemultipleUpdate[0]->ecole_id=$son_ecole_origin[0]->id;
                $requete->update(['ecole_id'=>$son_ecole_origin[0]->id]);
                }
                
                              
            }else{
                $this->errorCount +=1;
                array_push($this->message_error,'Veillez selectionner l\'école origine de l\'éleve qui a pour le matricule '. $this->elevemultipleUpdate[0]->matricule);  
            }
            
           }else{
            $this->ecole_id = $this->elevemultipleUpdate[0]->ecole_id;
            $this->dispatch('verifyStudentSelect');            
           }
    }
    public function getIdArray(){ // permet d'etre active pour les element selectionner
       $this->idsSelects=$this->idsSelects;
       $this->longueurTable = count($this->idsSelects);
       $this->countTableIndex = 0;
       $this->verifyStudentSelect();
       $this->dispatch('getIdArray');
       $this->restUpdate = $this->longueurTable;
       //dd($this->idsSelects);
    }
    
    public function studentInfo(){

        $this->ide=$this->ide;
         $id=$this->ide;
        $this->eleveInfo = eleve::with('eleve_ecole_O')->where('eleves.id', $id)->get();
        
        if ($this->eleveInfo[0]['eleve_ecole_O']!=null) {
        $dren_O = dren::where('code_dren',$this->eleveInfo[0]['eleve_ecole_O']->CODE_DREN)->get();
        $this->drenOrigine=$dren_O[0]->nom_dren;
        }
        if ($this->eleveInfo[0]['eleve_ecole_A']!=null) {
        $dren_A = dren::where('code_dren',$this->eleveInfo[0]['eleve_ecole_A']->CODE_DREN)->get();
        $this->drenAccueil=$dren_A[0]->nom_dren;
        }
        if ($this->eleveInfo[0]['eleve_fiche']!=null) {   
        }
        
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
        }
    }
    public function checkSerieMultiple(){
        $this->serieMultiple = $this->serieMultiple; // il regarde si la serie est identique pour tous les élèves selectionnés 
    }
    public function storeStudent(){
        
        $validate = $this->validate([
            'matricule'=>'required|min:6',
            'nom'=>'required|min:2',
            'prenom'=>'required|min:2',
            'classe'=>'required|min:3',
            'ecole_origine'=>'',
            'genre'=>'required|min:1',
            'dateNaissance'=>'',
            'ecole_id' =>'required|min:1',
            'ecole_A' =>'required|min:1',
            'serie'=>'required|min:1',
            'fiche_id' =>'required|min:1',
            'annee'  =>'required|min:4' ,

        ]);
         if(strlen($this->dateNaissance)==0 ){
            $validate['dateNaissance']='0000-01-01';
         };
        if(!$this->classe=='2nde'){
            $validate['serie']=$this->serie;
        }
        if(!eleve::where('matricule', $this->matricule)->exists()){
            
            if(strlen($this->ecole_id)!=0){
                $ecole = ecole::where('id','=',$this->ecole_id)->get();
                $validate['ecole_origine']=$ecole[0]->NOMCOMPLs;
            }
            
            eleve::create($validate);
            session()->flash("success", "Enregistrement effectué avec succès");
            $this->resetInput();
            $this->dispatch('save');
            
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
            'dateNaissance'=>'',
            'ecole_id' =>'',
            'ecole_A' =>'',
            'serie'=>'',
            'fiche_id' =>'',
            'annee'=>'required|min:4' ,  
        ]);
        if(!$this->classe=='2nde'){
            $validate['serie']=$this->serie;
        }
        if(strlen($this->dateNaissance)==0 ){
            $validate['dateNaissance']='0000-01-01';
         };
        $eleveupdate = eleve::find($this->id_eleve);
        if($eleveupdate->update($validate)){
            session()->flash("success", "Mise à jour effectué avec succès");
        }else{
            session()->flash("error", "Erreur de mise à jour");
        } 
        
    }
    public function pushUpdateMultiple(){
        if($this->longueurTable > $this->countTableIndex ){
            $validate = $this->validate([
                'classe'=>'required|min:3',
                'ecole_A' =>'',
                'serie'=>'required|min:1',
                'fiche_id' =>'',
                'annee'=>'required|min:4' ,  
            ]);
            if(!$this->classe=='2nde'){
                $validate['serie']=$this->serie;
            }
            
            $eleveupdate = eleve::find($this->idsSelects[$this->countTableIndex]);
            if($eleveupdate->update($validate)){
                $this->countTableIndex = $this->countTableIndex + 1 ;
                 //il verifie le suivant
            }else{
            session()->flash("error", "Erreur de mise à jour");
            } 
            
            $this->restUpdate = $this->longueurTable - $this->countTableIndex;
           
            if ($this->countTableIndex == $this->longueurTable) {
                session()->flash("success", " Toutes les mises à jour ont été effectué avec succès");
            }else{                
                $this->verifyStudentSelect();
                   
            }

        }
    }
    public function updateMultiple(){

        if($this->classe=="6eme" || $this->serieMultiple == true){
            for ($i=0; $i < $this->longueurTable; $i++) {
                $this->pushUpdateMultiple();
                }
        }else{
                $this->pushUpdateMultiple();
        }  
    }
    public function deleteStudent($a){
        eleve::find($a)->delete();
        $this->ide="";
        $this->eleveInfo='';
    }
    public function toSearchableArray(): array
    {
        $array = [
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
        ];
 
        // Customize the data array...
 
        return $array;
    }
    
    public function render()
    {
        
        
        $this->shareAnnee = session('shareYear');
        $this->shareNiveau = session('shareNiveau');
        
        $words= '%'.$this->search.'%' ;
        $students=eleve::where('nom','like', $words)
        ->orWhere('prenom','like', $words)
        ->orWhere('matricule','like', $words)
        ->with('eleve_ecole_A')
        ->with('eleve_fiche')
        ->paginate($this->perPage);
        $studentCount=$students->count();
        return view('livewire.student-index', [
            'students'=> $students,

            'ecole'=>ecole::select('id','NOMCOMPLs')->get(), 
            'fiche'=> fiche::with('fiche_ecole')->with('fiche_dren')
            ->orderBy('created_at', 'ASC')
            ->get(),
            'studentCount'=>$studentCount,
            'hasRole'=>$this->hasRole
            
        ]);
    }
}
