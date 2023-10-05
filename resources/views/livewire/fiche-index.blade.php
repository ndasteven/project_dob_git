<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FICHE ORIENTATION') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter une fiche</button>
        </div>
        
        <!--liste des fiche -->
        <div class="row">
            <div class="col-12 mt-4">
                <div class=" mb-4   ">
                    <input placeholder="rechercher"  type="search" wire:model='search' class="form-control shadow-2xl" wire:keydown.debounce.800ms='research' style="border-radius: 100px" />
                </div>
                <small style="font-weight: bold">recherche par matricule : <span style="color: blue">{{$orderField}}</span> </small> 
               
                <table class="table shadow-2xl" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th scope="col" wire:click="setOrderField('CODSERVs')" >Ecoles @if($orderField=='CODSERVs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                        <th scope="col" wire:click="setOrderField('NOMCOMPLs')">Drens @if($orderField=='NOMCOMPLs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('GENREs')">Années  @if($orderField=='GENREs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('GENREs')">Classe  @if($orderField=='GENREs') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('CODE_DREN')">Fiches @if($orderField=='CODE_DREN') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($fiche as $item)
                     
                         <tr>
                            <td>{{$item['fiche_ecole']->NOMCOMPLs}}</td>
                            <td>{{$item['fiche_dren']->nom_dren}}</td>
                            <td>{{$item->annee}}</td>
                            <td>{{$item->classe}}</td>
                            <td>{{$item->fiche_nom}}</td>
                            <td>
                                <button class="btn btn-info btn-sm">selectionner</button>
                            </td>
                      </tr> 
                     @endforeach
                     
                     
                    </tbody>
                  </table>
            </div>

            
        </div>
        <!--fin liste des fiche -->
        <!-- modal -->
        @include('livewire.modal_form_fiches')
        <!--fin modal -->
        {{$fiche->links()}}
    </div>
    
</div>

