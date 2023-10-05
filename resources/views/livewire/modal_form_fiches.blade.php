<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer une fiche d'orientation</h1>
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
            <form wire:submit.prevent='storeFiche'>
              
                <div class="row mb-6">
                    <div class="col">
                        <label for="validationServer01" class="form-label">Nom de la fiche</label>
                        <input  class="form-control @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='nom'  >
                        <div class="invalid-feedback">
                            @error('nom')Entrer un nom valide @enderror"
                          </div>
                    </div>
                    
                    <div class=" col">
                            <label >Selectionner la fiche de décision en PDF</label>
                              <input style="display:none" class="form-control file-select @error('fiche_nom') is-invalid  @enderror" type="file" wire:model='fiche_nom' wire:change='getfilenames' id="fileInput" >
                              <a class="btn btn-primary @error('fiche_nom') btn-danger  @enderror bouton-select-file col-12 mt-2" >
                                <span wire:loading wire:target="fiche_nom" class="spinner-border spinner-border-sm spinner-border float-end mt-1" aria-hidden="true"></span>
                                <i class="bi bi-file-earmark-pdf-fill"></i>Selectionner la décision en PDF</a>
                              <div class="invalid-feedback">
                                  @error('fiche_nom') {{$message}} @enderror"
                             </div> 
                    </div>
                    <div class="col-3">
                        <label for="validationCustom04" class="form-label">classe</label>
                        <select class="form-select @error('classe') is-invalid @enderror " id="validationCustom04"  wire:model='classe'  >
                            <option selected value="">choisir la classe </option>
                            <option value="6eme">6eme</option>
                            <option value="2nde">2nde</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('classe')Selectionner une classe valide @enderror"
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-6">
                    <div class="col ">
                        <label for="validationServer01" class="form-label">Année de la fiche</label>
                        <input type="tel" style="padding: 5px"  class="form-control mt-1 p-2 @error('annee') is-invalid @enderror " id="validationServer01" value="" wire:model='annee' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        <div class="invalid-feedback">
                            @error('annee')Entrer une année valide @enderror"
                        </div>
                    </div>
                    <div wire:ignore class="col">
                        <label for="formFile" class="form-label">Selectionner la DREN de la fiche</label>
                        <select class="form-select  @error('dren_id') is-invalid @enderror" id="select-dren" wire:model='dren_id' autocomplete="off" >
                            <option value="">selectionner le code DREN</option>
                            @foreach ($codeDren as $item)
                            @dump($item)
                            <option value="{{$item->id}}">{{$item->code_dren}}-{{$item->nom_dren}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('dren_id')Selectionner une DREN @enderror
                        </div>
                    </div>
                    <div wire:ignore class="col mb-3">
                        <label for="formFile" class="form-label">Selectionner l'etablissement de la fiche</label>
                        <select class="form-select @error('ecole_id') is-invalid @enderror" id="select-beast" wire:model='ecole_id' autocomplete="off" style="z-index: 2;" >
                          <option value="">selectionner une école</option>
                          @foreach ($ecole as $item)
                          <option value="{{$item->id}}" style="z-index: 1;" >{{$item->NOMCOMPLs}}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                          @error('ecole_id')Selectionner un établissement @enderror"
                        </div>
                      </div>
                </div>
            
            
            <div class="row mt-3 ">
                <div class="col">
                  <button class="btn btn-success col-12" wire:loading.attr="disabled">
                    Valider l'enregistrement
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
    var select = new TomSelect("#select-dren",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
    }
    });
    $('.bouton-select-file').on('click', function(e){
      
      $('.file-select').click()
    })
})
$("#fileInput").on("change", function(e) {
        var input = e.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Afficher la prévisualisation de l'image
                console.log(e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
  </script>
