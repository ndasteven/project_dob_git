<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
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
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Genre</label>
                    <select class="form-select @error('genre') is-invalid @enderror " id="validationCustom04" wire:model='genre'  >
                      <option selected value="">choisir le genre de l'élève</option>
                      <option value="M">Homme</option>
                      <option value="F">Femme</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner le genre.
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
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selectionner la décision</label>
                    <input class="form-control @error('fichier') is-invalid @enderror" type="file" wire:model='fichier' wire:change='getfilenames' >
                    <div class="invalid-feedback">
                        @error('fichier') {{$message}} @enderror"
                      </div>
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
