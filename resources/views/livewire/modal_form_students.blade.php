<div class="modal fade" id="modalStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer un élève</h1>
          <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--Formulaire d'enregistrement-->
          <div class="col-md-10 mx-auto col-12">
            <!--Message alert-->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
            <!--Message alert-->
            <form wire:submit.prevent='storeStudent()' enctype="multipart/form-data">
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
                    <label for="validationCustom04" class="form-label">classe</label>
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
                    veillez selectionner une classe.
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
                <div class="col">
                    <label for="validationServer01" class="form-label">Moyenne d'orientation</label>
                    <input  class="form-control @error('tgp') is-invalid @enderror  " id="validationServer01" value="" wire:model='tgp'>
                    <div class="invalid-feedback">
                      Entrer une moyenne valide
                    </div>
                </div>
            </div>
            @if ($classe=='2nde')
            <div class="row mt-3">
              <div class="col">
                  <label for="validationServer01" class="form-label">Moyenne générale annuelle(MGA)</label>
                  <input  class="form-control @error('mo') is-invalid @enderror  " id="validationServer01" value="" wire:model='mo'  >
                  <div class="invalid-feedback">
                    Entrer un matricule valide
                  </div>
              </div>
              <div class="col">
                  <label for="validationServer01" class="form-label">Série</label>
                  <input  class="form-control @error('serie') is-invalid @enderror  " id="validationServer01" value="" wire:model='serie'>
                  <div class="invalid-feedback">
                    Entrer une moyenne valide
                  </div>
              </div>
          </div>
            @endif
            <div class="row mt-3 mb-2">
                <div class="col">
                    <label for="validationServer01" class="form-label">Date de naissance</label>
                    <input type="date"  class="form-control @error('dateNaissance') is-invalid @enderror " id="validationServer01" value="" wire:model='dateNaissance'  >
                    <div class="invalid-feedback">
                      Entrer une date valide
                    </div>
                </div>
                <div class="col ">
                    <label for="validationServer01" class="form-label @error('contactParent') is-invalid @enderror ">Contact du parent</label>
                    <input  class="form-control " id="validationServer01" wire:model='contactParent' value="" >
                    <div class="invalid-feedback">
                      Entrer une moyenne valide
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="mb-3 col">
                    <label for="formFile" class="form-label">Selectionner la décision</label>
                    <input class="form-control @error('fichier') is-invalid @enderror" type="file" wire:model='fichier' wire:change='getfilenames' >
                    <div class="invalid-feedback">
                        @error('fichier') {{$message}} @enderror"
                      </div>
                </div>
                <div wire:ignore class="col mb-3">
                  <label for="formFile" class="form-label">Selectionner un etablissement d'origine</label>
                  <select class="form-select @error('ecole_id') is-invalid @enderror" id="select-beast" wire:model='ecole_id' autocomplete="off" >
                    <option value="">selectionner une école</option>
                    @foreach ($ecole as $item)
                    <option value="{{$item->id}}">{{$item->NOMCOMPLs}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    @error('ecole_id')Selectionner un établissement @enderror"
                  </div>
                  <script>
                    
                    new TomSelect("#select-beast",{
                      create: true,
                      sortField: {
                        field: "text",
                        direction: "asc"
                      }
                    });
                </script>
                </div>
              
            </div>
            <div class="row">
                <button class="btn btn-success col-12" >
                    Valider l'enregistrement
                </button>
            </div>
            </form>
          </div>
          
          <!--fin Formulaire d'enregistrement-->
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>

  </div>
