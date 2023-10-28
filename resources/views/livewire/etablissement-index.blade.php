<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Etablissements') }}
        </h2>
    </x-slot>
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
                <livewire:ecole-table/>
            </div>

            
        </div>
        <!--fin liste des élèves -->
        <!-- modal -->
        @include('livewire.modal_form_etablissements')
        <!--fin modal -->
    </div>
    
</div>
