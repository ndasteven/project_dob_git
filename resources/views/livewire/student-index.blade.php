<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elèves') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-sm col-md-2 col-4" data-bs-toggle="modal" data-bs-target="#modalStudent" wire:click='create()' style="background-color: #39b315;color:#fff; margin-right:12px">Ajouter un élève</button>
        </div>
        
        <!--liste des élèves -->
        <div class="row">
            <div class="col-12  mt-4">
                <div class=" row mb-4 ">
                    <div class="col-4 col-md-2 dropdown">
                        <button class="btn btn-primary dropdown-toggle  btn-sm p-1 mt-1 col-12" data-bs-toggle="dropdown" aria-expanded="false"> <span ><i class="bi bi-plus-circle"></i> recherche </span> </button>
                        <div class="dropdown-menu" style="font-size: 12px">
                            <small class="m-4" ><b style="color:blue">selectionner les éléments à rechercher</b>   </small>
                            <div class="form-check ml-4">
                                <input class="form-check-input matriculeCheck" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Matricule
                                </label>
                            </div>
                                <div class="form-check ml-4">
                                  <input class="form-check-input nomCheck" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                  Nom
                                  </label>
                                </div>
                            
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input prenomCheck" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Prenom
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input dateNaissCheck" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Date de naissance
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input genreCheck" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Sexe
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input classeCheck" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Classe
                                        </label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input serieCheck" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Série
                                        </label>
                                    </div>
                                </a>
                            </li>
                        </div>
                    </div>
                    <div class="col-8 col-md-10">
                      <input placeholder="rechercher"  type="search" wire:model='search' class="form-control shadow-lg" wire:keydown='research'
                    style="border-radius: 100px" />  
                    </div>
                    
                </div>
                <div class="row">
                    <div class="mb-3 matriculeInput col-md col-4" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">Matricule</label>
                        <input type="text" wire:model='matricule' wire:keydown='research' class="form-control" id="exampleFormControlInput1" placeholder="rechercher un matricule" style="font-size: 12px">
                    </div>
                    <div class="mb-3 col-md col-4 nomInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">Nom</label>
                        <input type="text" wire:model='nom' wire:keydown='research' class="form-control" id="exampleFormControlInput1" placeholder="rechercher un nom" style="font-size: 12px">
                    </div>
                    <div class="mb-3 col-md col-4 prenomInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">Prenom</label>
                        <input type="text" class="form-control" wire:model='prenom' wire:keydown='research' id="exampleFormControlInput1" placeholder="rechercher un prenom" style="font-size: 12px">
                    </div>
                    <div class="mb-3 col-md col-4 dateNaissInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">date de naissance</label>
                        <input type="date" class="form-control" wire:model='dateNaissance' wire:keydown='research' id="exampleFormControlInput1" placeholder="name@example.com" style="font-size: 12px">
                    </div>
                    <div class="mb-3 col-md col-3 genreInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">Selectionner le genre</label>
                        <select class="form-select" id="validationCustom04" wire:model='genre' wire:keydown='research' style="font-size: 12px" >
                            <option selected value="">choisir le genre de l'élève</option>
                            <option value="M">Masculin</option>
                            <option value="F">Feminin</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md col-3 classeInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">selectionner la classe</label>
                        <select class="form-select  " id="validationCustom04" wire:model='classe' wire:keydown='research' style="font-size: 12px" >
                            <option selected value="">choisir la classe</option>
                            <option value="M">6ieme</option>
                            <option value="F">2nde</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md col-3 serieInput" style="display: none" wire:ignore.self>
                        <label for="exampleFormControlInput1" class="form-label">selectionner la série</label>
                        <select class="form-select  " id="validationCustom04" wire:model='serie' wire:keydown='research' style="font-size: 12px" >
                            <option selected value="">choisir la série</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                </div>
                <small style="font-weight: bold">recherche par  : <span style="color: blue">{{$orderField}}</span> </small> 
                <table class="table shadow-2xl col-12 container-fluid" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th scope="col-1" wire:click="setOrderField('matricule')" >Matricule @if($orderField=='matricule') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                        <th scope="col-1" wire:click="setOrderField('nom')">Nom @if($orderField=='nom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col-1" wire:click="setOrderField('prenom')">Prenom @if($orderField=='prenom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col-1" wire:click="setOrderField('genre')" class="d-none d-sm-block">Genre @if($orderField=='genre') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                        <th scope="col-1" wire:click="setOrderField('classe')">Classe @if($orderField=='classe') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th> 
                        <th scope="col-1" wire:click="setOrderField('dateNaissance')" class="d-none d-sm-block">Ecole</th>
                        <th scope="col-1" >Fiches</th>
                        <th scope="col-1" class="d-none d-sm-block">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($students as $student)
                         <tr>
                            <th scope="row">{{$student->matricule}}</th>
                            <td>{{$student->nom}}</td>
                            <td>{{$student->prenom}}</td>
                            <td class="" >{{$student->genre}}</td>
                            <td>{{$student->classe}} @if ($student->classe=='2nde')( {{$student->serie}} )   @endif</td>
                            {{----}}
                            <td class="">{{$student['eleve_ecole_A']->NOMCOMPLs}}</td>                                
                            <td><a href="storage/fiche_orientation/{{$student['eleve_fiche']->fiche_nom}}" target="_blank"><button href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="voir la fiche d'orientation"> <i class="bi bi-filetype-pdf" style="color: red"></i></button></a></td>
                            <td class="d-none d-sm-block">
                            <button class="btn btn-sm "  data-bs-toggle="modal" data-bs-target="#modalStudentInfos" wire:click='studentInfo({{$student->id}})' style="background-color: #39b315;color:#fff">selectionner</button>
                        </td>
                      </tr> 
                     @endforeach
                     
                     
                    </tbody>
                  </table>
            </div>
            {{$students->links()}}
        </div>
        
        <!--fin liste des élèves -->
        <!-- modal formulaire inscription-->
        @include('livewire.modal_form_students')
        <!--fin modal -->
        <!-- modal formulaire inscription-->
        @include('livewire.modalStudentInfos')
        <!--fin modal -->

    </div>

   
    <script>
        $(document).ready(function() {
            $('.nomCheck').change(function() {
               if($(this).is(':checked')){
                $('.nomInput').css('display','block')
               }else{
                $('.nomInput').css('display','none')
               }
            });

            $('.prenomCheck').change(function() {
               if($(this).is(':checked')){
                $('.prenomInput').css('display','block')
               }else{
                $('.prenomInput').css('display','none')
               }
            });

            $('.matriculeCheck').change(function() {
               if($(this).is(':checked')){
                $('.matriculeInput').css('display','block')
               }else{
                $('.matriculeInput').css('display','none')
               }
            });

            $('.dateNaissCheck').change(function() {
               if($(this).is(':checked')){
                $('.dateNaissInput').css('display','block')
               }else{
                $('.dateNaissInput').css('display','none')
               }
            });

            $('.genreCheck').change(function() {
               if($(this).is(':checked')){
                $('.genreInput').css('display','block')
               }else{
                $('.genreInput').css('display','none')
               }
            });

            $('.classeCheck').change(function() {
               if($(this).is(':checked')){
                $('.classeInput').css('display','block')
               }else{
                $('.classeInput').css('display','none')
               }
            });
            $('.serieCheck').change(function() {
               if($(this).is(':checked')){
                $('.serieInput').css('display','block')
               }else{
                $('.serieInput').css('display','none')
               }
            });
        })
    </script>
</div>
