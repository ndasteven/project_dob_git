<div>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-1" data-bs-toggle="modal" data-bs-target="#modalStudent">Créer un élève</button>
        </div>

        <!--liste des élèves -->
        <div class="row">
            <div class="col-12 mt-4">
                <div class=" mb-4 ">
                    <input placeholder="rechercher"  type="search" wire:model='search' class="form-control shadow-lg" wire:keydown.debounce.500ms='research'
                    style="border-radius: 100px" />
                </div>
                <small style="font-weight: bold">recherche par matricule : <span style="color: blue">{{$orderField}}</span> </small> 
               
                <table class="table shadow-2xl " style="font-size: 12px">
                    <thead>
                      <tr>
                        <th scope="col" wire:click="setOrderField('matricule')" >Matricule @if($orderField=='matricule') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                        <th scope="col" wire:click="setOrderField('nom')">Nom @if($orderField=='nom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('prenom')">Prenom @if($orderField=='prenom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('genre')">Genre @if($orderField=='genre') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col" wire:click="setOrderField('tgp')">TGP @if($orderField=='tgp') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th> 
                        <th scope="col" wire:click="setOrderField('dateNaissance')">date naissance</th>
                        <th scope="col" >Fiches</th>
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody>

                     @foreach ($students as $student)
                         <tr>
                            <th scope="row">{{$student->matricule}}</th>
                            <td>{{$student->nom}}</td>
                            <td>{{$student->prenom}}</td>
                            <td>{{$student->genre}}</td>
                            <td>{{$student->tgp}}</td>
                            <td>{{$student->dateNaissance}}</td>
                            <td><button href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="voir la fiche d'orientation"> <i class="bi bi-filetype-pdf" style="color: red"> </a></i></td>
                            <td>
                            <button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#modalStudentInfos" wire:click='studentInfo({{$student->id}})'>selectionner</button>
                        </td>
                      </tr> 
                     @endforeach
                     
                     
                    </tbody>
                  </table>
            </div>

            
        </div>
        <!--fin liste des élèves -->
        <!-- modal formulaire inscription-->
        @include('livewire.modal_form_students')
        <!--fin modal -->
        <!-- modal formulaire inscription-->
        @include('livewire.modalStudentInfos')
        <!--fin modal -->
        {{$students->links()}}
    </div>

   
    
</div>
