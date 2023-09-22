<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DREN') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Créer une DREN</button>
        </div>

        <!--liste des élèves -->
        <div class="row">
            <div class="col-12 mt-4">
                <div class=" mb-4">
                    <input placeholder="rechercher"  type="search" wire:model='search' class="form-control shadow-2xl" wire:keydown.debounce.800ms='research'
                    style="border-radius: 100px" />
                </div>
                <small style="font-weight: bold">recherche par  : <span style="color: blue">{{$orderField}}</span> </small> 
               
                <table class="table shadow-2xl" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th scope="col" wire:click="setOrderField('code_dren')" >CODE DREN @if($orderField=='code_dren') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                        <th scope="col" wire:click="setOrderField('nom_dren')">NOM DREN @if($orderField=='nom_dren') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody style="padding: 10px">

                     @foreach ($drens as $dren)
                         <tr>
                            <td>{{$dren->code_dren}}</td>
                            <td>{{$dren->nom_dren}}</td>
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
        @include('livewire.modal_form_drens')
        <!--fin modal -->
        {{$drens->links()}}
    </div>
    
</div>

