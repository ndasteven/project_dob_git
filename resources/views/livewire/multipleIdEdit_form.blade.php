<div class="modal fade" id="multipleEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
       <a href=""> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </a>
      </div>
      <div class="modal-body">
        <div class="row">        
          <h1 class="modal-title fs-5 col-md-10 mx-auto" id="exampleModalLabel">Vous avez {{$restUpdate}} mise à jour à faire </h1>
          <hr>
            <small style="font-weight: bold">
              @if ($elevemultipleUpdate)
              <div class="alert alert-warning col-md-10 mx-auto">
                <h3>Effectuer la mise à jour pour :</h3>
                @foreach($elevemultipleUpdate as $eleveMultiUp)
                  <ul>
                    <li>Matricule : {{$eleveMultiUp->matricule}} </li>
                  </ul>  
                  <ul>
                    <li>Nom : {{$eleveMultiUp->nom}} </li>
                  </ul>
                  <ul>
                    <li>Prenom : {{$eleveMultiUp->prenom}} </li>
                  </ul>
                @endforeach 
              </div>
              @endif
            </small>
          
        </div>
        {{--Formulaire de mise à jour--}}
        <div class="col-md-10 mx-auto col-12">
          <!--Message alert-->
          
              <div class="alert alert-success" style=" @if (session()->has('success')) display:block @else display:none @endif " >
                  {{ session('success') }}
              </div>
          
              <div class="alert alert-warning" style=" @if (session()->has('error')) display:block @else display:none @endif ">
                  {{ session('error') }}
              </div>
         
          <!--Message alert-->
          <form class="formMupltiple"   wire:submit.prevent='updateMultiple()'    enctype="multipart/form-data" >
            @csrf  
            
            <div class="row">
              <div class="col">
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
              @if ($classe=='2nde')
              
              <div class="col">
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
              <div class="col">
                <label for="validationServer01" class="form-label">Année d'orientation</label>
                <input  class="form-control @error('annee') is-invalid @enderror  " id="validationServer01" value="" wire:model='annee'  >
                <div class="invalid-feedback">
                  Entrer l'année d'orientation de l'élève
                </div>
              </div>
          </div>
          <div class="row mt-3">
              
               
                
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
                <select class="form-select @error('ecole_id') is-invalid @enderror" id="select_ecole_O" wire:model='ecole_id' autocomplete="off">
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
                  <select class="form-select @error('ecole_A') is-invalid @enderror" id="select_ecole_A" wire:model='ecole_A' autocomplete="off">
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
              <select class="form-select @error('fiche_id') is-invalid @enderror" id="select_fiche" wire:model='fiche_id' autocomplete="off">
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
          @if($countTableIndex < $longueurTable)
          <div class="row mt-5">
            <div class="col">
              <button class="btn btn-success col-12 " >
               Mettre à jour les informations de l'élève.
              </button>
            </div>  
          </div>
          @else
          <div class="row mt-5">
            <div class="col">
              <a href="">
              <div class="btn btn-primary col-12 " >
               Retour.
              </div>
            </a>
            </div>  
          </div>
          @endif
          </form>
        </div>
        {{--fi Formulaire de mise à jour--}}
      </div>
      
    </div>
  </div>
  @include('livewire.loading')
</div>

<script>
  document.addEventListener('livewire:initialized', () => {
        @this.on('getIdArray', () => {
          
        var select = new TomSelect("#select_ecole_O",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
        }
        });

        var select1 = new TomSelect("#select_ecole_A",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
        }
        });

        var select2 = new TomSelect("#select_fiche",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
        }
        });
           })})
  </script>
