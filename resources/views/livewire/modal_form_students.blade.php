<div class="modal fade" id="modalStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" >
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">@if($creer) Enregistrer un élève @endif @if($edit) Modifier l'élève @endif </h1>
          @if ($creer)<a  class="btn-close " data-bs-dismiss="modal" aria-label="Close" wire:click='cancel()'></a>
          @else
          <a  class="btn-close closeformUpdateStudent" wire:click='cancel()'></a>
          @endif"
          
        </div>
        
        <div class="modal-body">
          <!--Formulaire d'enregistrement-->
          <div class="col-md-10 mx-auto col-12">
            <!--Message alert-->
            
                <div class="alert alert-success" style=" @if (session()->has('success')) display:block @else display:none @endif " >
                    {{ session('success') }}
                </div>
            
                <div class="alert alert-warning" style=" @if (session()->has('error')) display:block @else display:none @endif ">
                    {{ session('error') }}
                </div>
           
            <!--Message alert-->
            <form @if ($creer) wire:submit.prevent='storeStudent()' @endif @if ($edit) wire:submit.prevent='updateStudent()' @endif  enctype="multipart/form-data">
              @csrf  
              <div class="row">
                <div class="col">
                    <label for="validationServer01" class="form-label">Nom</label>
                    <input  class="form-control @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='nom'  >
                    <div class="invalid-feedback">
                      Entrer un nom valide
                    </div>
                </div>
                <div class="col">
                    <label for="validationServer01" class="form-label">Prenom</label>
                    <input class="form-control @error('prenom') is-invalid @enderror " id="validationServer01" value="" wire:model='prenom'  >
                    <div class="invalid-feedback">
                      Entrer un nom valide
                    </div>
                </div>
                <div class="col-2">
                    <label for="validationCustom04" class="form-label">Niveau</label>
                    <select class="form-select @error('classe') is-invalid @enderror " id="validationCustom04" wire:change='selectclasse' wire:model='classe'  >
                      <option selected value="">choisir la classe de l'élève</option>
                      <option value="6eme">6eme</option>
                      <option value="2nde">2nde</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner une classe.
                    </div>
                </div>
              
                <div class="col-2">
                  <label for="validationCustom04" class="form-label">Genre</label>
                  <select class="form-select @error('genre') is-invalid @enderror " id="validationCustom04" wire:model='genre'  >
                    <option selected value="">choisir le genre de l'élève</option>
                    <option value="M">Masculin</option>
                    <option value="F">Feminin</option>
                  </select>
                  <div class="invalid-feedback">
                    veillez selectionner le sexe de l'élève.
                  </div>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="validationServer01" class="form-label">Matricule</label>
                    <input  class="form-control @error('matricule') is-invalid @enderror  " id="validationServer01" value="" wire:model='matricule'  >
                    <div class="invalid-feedback">
                      Entrer un matricule valide
                    </div>
                </div>
                  @if ($classe=='2nde')
                
                  <div class="col-2">
                    <label for="validationCustom04" class="form-label">Série</label>
                    <select class="form-select @error('serie') is-invalid @enderror " id="validationCustom04"  wire:model='serie'  >
                      <option selected value="">choisir la série</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner une série.
                    </div>
                  </div>
                
                @endif
                <div class="col-2">
                  <label for="validationServer01" class="form-label">Année d'orientation</label>
                  <input  class="form-control @error('annee') is-invalid @enderror  " id="validationServer01" value="" wire:model='annee'  >
                  <div class="invalid-feedback">
                    Entrer l'année d'orientation de l'élève
                  </div>
                </div>
                <div class="col">
                  <label for="validationServer01" class="form-label">Date de naissance</label>
                  <input type="date"  class="form-control @error('dateNaissance') is-invalid @enderror " id="validationServer01" value="" wire:model='dateNaissance'  >
                  <div class="invalid-feedback">
                    Entrer une date valide
                  </div>
                </div>
                
            </div>           
            <style>
              .disabled{
                opacity: 0.8;
              }
            </style>
            
            <div class="row mt-4" wire:loading.class="disabled">
              <div class="col mb-3">
                <label for="formFile" class="form-label " @error('ecole_id') style="color: rgb(192, 79, 79)" @enderror> Selectionner un etablissement d'origine</label>
                <div wire:ignore>
                  <select class="form-select @error('ecole_id') is-invalid @enderror" id="select-beast" wire:model='ecole_id' autocomplete="off">
                    <option value="">selectionner l'école d'origine</option>
                    @foreach ($ecole as $item)
                    <option value="{{$item->id}}" style="z-index: 1;" >{{$item->NOMCOMPLs}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="invalid-feedback">
                  @error('ecole_id')Selectionner un établissement d'origine @enderror"
                </div>
              
              </div>
                <div class="col mb-3">
                  <label for="formFile" class="form-label"  @error('ecole_A') style="color: rgb(192, 79, 79)" @enderror>Selectionner un etablissement d'accueil</label>
                  <div wire:ignore>
                    <select class="form-select @error('ecole_A') is-invalid @enderror" id="select-beast-1" wire:model='ecole_A' autocomplete="off">
                      <option value="">selectionner l'école d'accueil</option>
                      @foreach ($ecole as $item)
                      <option value="{{$item->id}}" style="z-index: 1;" >{{$item->NOMCOMPLs}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="invalid-feedback">
                    @error('ecole_A')Selectionner un établissement accueil @enderror"
                  </div>
                
                </div>
              
            </div>
            <div class="col mb-3" wire:loading.class="disabled">
              <label for="formFile" class="form-label"  @error('fiche_id') style="color: rgb(192, 79, 79)" @enderror>Selectionner la fiche d'orientation de l'élève</label>
              <div wire:ignore>
                <select class="form-select @error('fiche_id') is-invalid @enderror" id="select-beast-2" wire:model='fiche_id' autocomplete="off">
                  <option value="">selectionner la fiche d'orientation</option>fiche_ecole
                  @foreach ($fiche as $item)
                  <option value="{{$item->id}}" style="z-index: 1;" >{{$item->nom}} | {{$item->classe}} | {{$item->annee}} | {{$item['fiche_ecole']->NOMCOMPLs}} | {{$item['fiche_dren']->nom_dren}}  </option>
                  @endforeach
                </select>
              </div>
              <div class="invalid-feedback">
                @error('fiche_id')Selectionner la fiche d'orientation @enderror"
              </div>
            </div>

            <div class="row">
              <div class="col">
                <button class="btn btn-success col-12 " >
                  @if($creer)
                  Valider l'enregistrement de l'eleve
                  @endif
                  @if($edit)
                  Modifier les informations de l'eleve
                  @endif.
                </button>
              </div>  
            </div>
            </form>
          </div>
          
          <!--fin Formulaire d'enregistrement-->
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
<!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
@include('livewire.loading')
<!--fin loading -->
  </div>
       
<script>
  $(document).ready(function() {
    var select = new TomSelect("#select-beast",{
    create: true,
    sortField: {
    field: "text",
    direction: "asc"
    }
    });

    var select1 = new TomSelect("#select-beast-1",{
    create: true,
    sortField: {
    field: "text",
    direction: "asc"
    }
    });

    var select2 = new TomSelect("#select-beast-2",{
    create: true,
    sortField: {
    field: "text",
    direction: "asc"
    }
    });
    
$('#modalStudent').on('shown.bs.modal', function () { //permet de savoir si le modal est actif
  
    
      // Le modal est maintenant visible (actif) charger la valeur de ecole origine dans tom-select
       var checko= setInterval(() => {
         var i=0
          select.addItem(@this.ecole_id);
          if (@this.ecole_id!==null) {
            i++
          }
          if(i>0){
            clearInterval(checko)//arrete la varible check 
          } 
       }, 20);

       // Le modal est maintenant visible (actif) charger la valeur de ecole accueil dans tom-select
       var checka= setInterval(() => {
         var j=0
          select1.addItem(@this.ecole_A);
          if (@this.ecole_A!==null) {
            j++
          }
          if(j>0){
            clearInterval(checka)//arrete la varible check 
          } 
       }, 20);

       // Le modal est maintenant visible (actif) charger la valeur de ecole accueil dans tom-select
       var checkf= setInterval(() => {
         var h=0
          select2.addItem(@this.fiche_id);
          if (@this.fiche_id!==null) {
            h++
          }
          if(h>0){
            clearInterval(checkf)//arrete la varible check 
          } 
       }, 20);
    
  });

    
    
    
    $(('.closeformUpdateStudent')).on('click', function(e){
      $('#modalStudent').modal('hide')  
      $('#modalStudentInfos').modal('show') 
    })
});

</script>