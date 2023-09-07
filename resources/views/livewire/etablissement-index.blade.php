<div>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Créer un élève</button>
        </div>

        <!--liste des élèves -->
        <div class="row">
            <div class="col-12 mt-4">
                <div class=" mb-4   ">
                    <input placeholder="rechercher"  type="search" wire:model='search' class="form-control shadow-2xl" wire:keydown.debounce.800ms='research' style="border-radius: 100px" />
                </div>
                <small style="font-weight: bold">recherche par matricule : <span style="color: blue">{{$orderField}}</span> </small> 
               
                <table class="table shadow-2xl" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th scope="col" wire:click="setOrderField('CODSERVs')" >Code établissement @if($orderField=='CODSERVs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                        <th scope="col" wire:click="setOrderField('NOMCOMPLs')">Nom établissement @if($orderField=='NOMCOMPLs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('GENREs')">Type  @if($orderField=='GENREs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('CODE_DREN')">Code DREN @if($orderField=='CODE_DREN') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('CODE_DREN')">Nom DREN @if($orderField=='CODE_DREN') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th> 
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody>

                     @foreach ($etablissements as $etablissement)
                         <tr>
                            <th scope="row">{{$etablissement->CODSERVs}}</th>
                            <td>{{$etablissement->NOMCOMPLs}}</td>
                            <td>{{$etablissement->GENREs}}</td>
                            <td>{{$etablissement->CODE_DREN}}</td>
                            <td>{{$etablissement->CODE_DREN}}</td>
                            <td>
                                <button class="btn btn-info btn-sm">selectionner</button>
                            </td>
                      </tr> 
                     @endforeach
                     
                     
                    </tbody>
                  </table>
            </div>

            
        </div>
        <!--fin liste des élèves -->
        <!-- modal -->
        @include('livewire.modal_form_etablissements')
        <!--fin modal -->
        {{$etablissements->links()}}
    </div>
    
</div>
