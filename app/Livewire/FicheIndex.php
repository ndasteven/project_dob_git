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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FicheIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';   
    public $nom, $fiche_nom, $classe, $annee,$type_fiche, $ecole_id, $dren_id, $remarkFiche;
    public $search;
    public $shareAnnee;
   
    public $icon;
    public $fileName;
    public $idefiche;
    public $ficheInfo;
    public $ide;
    public $backgroundUpload;
    public $creer,$edit;
    public $liste_students_fiche;
    private function resetInput(){
        $this->nom = $this->fiche_nom=$this->classe=$this->annee=$this->ecole_id=$this->dren_id =$this->type_fiche=$this->remarkFiche="";
    }
    public function getfilenames(){
        $this->fileName ='file name : ' ; 
        
        if(strlen($this->fileName)>10){
            $this->dispatch("uploaded");
            $this->backgroundUpload = "green";
        }; 
        
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
    public function create(){
        $this->creer = true;
        $this->edit = false;
        $this->resetInput();
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
    ];
    public function research(){
        $this->search = $this->search;
    }
    

    public function ficheinfo(){

        $this->ficheInfo=fiche::with('fiche_dren')->with('fiche_ecole')->with("fiche_eleve")->where('fiches.id',$this->idefiche)->get() ;
    }
    public function closefiche(){
        $this->ficheInfo="";
        $this->liste_students_fiche="";
        $this->creer = false;
        $this->edit = false;
    }
    public function storeFiche(){
        $validate = $this->validate([
            'nom'=>'required|min:3',
            'fiche_nom'=>'required|file|mimes:pdf|max:4000',
            'classe'=>'required|min:1',
            'type_fiche'=>'required|min:5',
            'ecole_id'=>'required|min:1',
            'dren_id'=>'required|min:1',
            'annee'=>'required|min:4',
            'remarkFiche'=>'',
        ]);
        if($this->fiche_nom!==null ){
            $extensiValide = array("PDF","pdf");
            $fichiers = $this->fiche_nom->store('fiche_orientation', 'public');
            $this->fiche_nom= basename($fichiers);
            $validate['fiche_nom'] = $this->fiche_nom;
            
            if(in_array((pathinfo($this->fiche_nom, PATHINFO_EXTENSION)),$extensiValide)){

                if(!fiche::where('nom', $this->nom)->exists() ){
                   fiche::create($validate);
                    session()->flash("success", "Enregistrement effectué avec succès");
                    $this->resetInput();
                    $this->fiche_nom==null; 
                    $this->dispatch('save');
                }else{
                    session()->flash("error", "Ce nom de la fiche existe déja dans la base de données");
                    $this->dispatch('error');
                }
                    
            }else{
                $this->fileName='erreur de fichier! selectionner le fichier au format PDF';
                $this->dispatch('errorFile');
            }
        } 
        
    }
    public function close(){
        $this->edit=false;
        $this->creer=false;
        $this->resetInput();
        $this->backgroundUpload = " ";
        
    }
    public function update($id){
        $this->ide = $id;
        $this->creer = false;
        $this->edit = true;
        
        $ficheEdit = fiche::where("id", $id)->get(); 
        $this->nom = $ficheEdit[0]->nom;
        $this->fiche_nom = $ficheEdit[0]->fiche_nom;
        $this->classe = $ficheEdit[0]->classe;
        $this->annee = $ficheEdit[0]->annee;
        $this->type_fiche = $ficheEdit[0]->type_fiche;
        $this->remarkFiche = $ficheEdit[0]->remarkFiche;
        $this->ecole_id = $ficheEdit[0]->ecole_id;
        $this->dren_id = $ficheEdit[0]->dren_id;
        $this->dispatch('check');
       
    }
    public function updateFiche(){
        $validate = $this->validate([
            'nom'=>'required|min:3',
            'type_fiche'=>'required|min:5',
            'classe'=>'required|min:1',
            'ecole_id'=>'required|min:1',
            'dren_id'=>'required|min:1',
            'annee'=>'required|min:4',
            'remarkFiche'=>'',
        ]);
        $ficheInfo = fiche::find($this->ide);
        
        if(strlen($this->fiche_nom) >=10 && !is_string($this->fiche_nom)){
            $extensiValide = array("PDF","pdf");
            Storage::disk('public')->delete('fiche_orientation/'.$ficheInfo->fiche_nom);//supprime la precedente fiche
            $fichiers = $this->fiche_nom->store('fiche_orientation', 'public');
            $this->fiche_nom= basename($fichiers);
            $validate['fiche_nom'] = $this->fiche_nom;
            if($ficheInfo->update($validate)){
                session()->flash("success", "Mise à jour effectué avec succès");
                $this->dispatch('save');
            }else{
                session()->flash("error", "Erreur de mise à jour");
                $this->dispatch('error');
            }
        }else{
            if($ficheInfo->update($validate)){
                session()->flash("success", "Mise à jour effectué avec succès");
                $this->dispatch('save');
            }else{
                session()->flash("error", "Erreur de mise à jour");
                $this->dispatch('error');
            }   
        }
       
    }
    public function render()
    {
        $this->shareAnnee = session('shareYear');
        return view('livewire.fiche-index',[ 
            'liste_students_fiches'=>eleve::where('fiche_id',$this->idefiche)->where("matricule","LIKE", "%".$this->search."%" )->paginate(8),           
            'ecole'=>ecole::select('id','NOMCOMPLs')->get(),
            'codeDren'=>  dren::select('id','code_dren','nom_dren')
            ->orderBy('code_dren', 'ASC')
            ->get() ,
            "colorUpload"=>$this->backgroundUpload 
        ]);
    }
}
