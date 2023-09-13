<div class="modal fade" id="modalStudentInfos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
   
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" style="background-color: #e2e8f0">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMATIONS SUR L'ELEVE</h1>
          <button  class="btn-close" wire:click='closeStudent' data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--info students-->
     
          <div class="col-md-10 mx-auto col-12" >
              <div class="container">
                  <div class="main-body">
                                      
                        <div class="row gutters-sm">
                          <div class="col-md-4 mb-3">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                  @if($eleveInfo)
                                  @foreach ($eleveInfo as $eleveInfo)
                                    
                                  @endforeach
                                  @if ($eleveInfo->genre=='M')
                                  <img class="" src="https://cdn0.iconfinder.com/data/icons/professional-avatar-5/48/Junior_Consultant_male_avatar_men_character_professions-512.png" alt="Admin" class="rounded-circle" width="150">
                                   @else 
                                   <img class="" src="https://assets.onlinelabels.com/images/clip-art/GDJ/Female%20Avatar%205-277089.png" alt="Admin" class="rounded-circle" width="150">
                                  @endif
                                  
                                  <div class="mt-3">
                                    
                                    
                                    <p class="text-secondary mb-1">{{$eleveInfo->nom}} {{$eleveInfo->prenom}}</p>
                                    <p class="text-muted font-size-sm">{{$eleveInfo->classe}}</p>
                                    <p class="text-muted font-size-sm">{{$eleveInfo->matricule}}</p>
                                    
                                   <a href="storage/fiche_orientation/{{$eleveInfo->fichier}}" target="_blank">
                                    <button class="btn btn-outline-primary test_click">Voir Fiche</button>
                                  </a> 
                                  </div>
                                  
                                  @else
                                  <img src="https://cdn3.iconfinder.com/data/icons/ui-solid-2/32/people_profil_avatar_user_person_team_ui-512.png" alt="Admin" class="rounded-circle" width="150">
                                  <div class="mt-3">
                                      <h4 class="placeholder-glow col-6"></h4>
                                      <p class="card-text placeholder-glow">
                                          <span class="placeholder col-8 "></span>
                                          <span class="placeholder col-12"></span>
                                          <span class="placeholder col-10"></span>
                                        </p>
                                      
                                      <button class="btn btn-outline-primary">Voir fiche</button>
                                    </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                 
                          </div>
                          <div class="col-md-8">
                            <div class="card mb-3">
                              <div class="card-body">
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                   @if ($eleveInfo)
                                   {{$eleveInfo->nom}}
                                   @else
                                   <p class="placeholder-glow">
                                      <span class="placeholder col-6"></span>
                                   </p>
                                   @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Prenom</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->prenom}}
                                      @else
                                      <p class="placeholder-glow">
                                          <span class="placeholder col-5 "></span>
                                       </p>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Date de naissance</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->dateNaissance}}
                                      @else
                                      <p class="placeholder-glow col-5">
                                          <span class="placeholder col-1 "></span>/<span class="placeholder col-1 "></span>/<span class="placeholder col-4 "></span>
                                       </p>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Contact parent</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      @if (strlen($eleveInfo->contactParent)>=8 )
                                          {{$eleveInfo->contactParent}}
                                      @else
                                          Pas de contact
                                      @endif
                                      {{$eleveInfo->contactParent}}
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Moyenne d'orientation</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->tgp}}
                                      @else
                                      <span class="placeholder col-3 "></span>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Matricule</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->matricule}}
                                      @else
                                      <span class="placeholder col-5 "></span>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">classe</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->classe}}
                                      @else
                                      <span class="placeholder col-3 "></span>
                                      @endif
                                  </div>
                                </div>
                                @if ($eleveInfo)
                                  @if ($eleveInfo->classe=='2nde')
                                  <hr>
                                  <div class="row mb-3 mt-2">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Série</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$eleveInfo->serie}}
                                    </div>
                                  </div>
                                  @endif
                                @endif
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-12">
                                    <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                  </div>
                                </div>
                              </div>
                            </div>


                            @if ($eleveInfo)
                            
                            
                           
                            <div class="row gutters-sm">
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'origine:</i> <span style="font-size: 12px">{{$eleveInfo['eleve_ecole']->NOMCOMPLs}}</span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole']->CODSERVs}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole']->CODE_DREN}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$drenOrigine}}</span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                                    <small>Web Design</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Website Markup</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>One Page</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Mobile Template</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Backend API</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @else
                            <div class="row gutters-sm placeholder-glow">
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'origine:</i> <span class="placeholder col-5" style="font-size: 12px"></span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                                    <small>Web Design</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Website Markup</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>One Page</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Mobile Template</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Backend API</small>
                                    <div class="progress mb-3" style="height: 5px">
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
              
              
                          </div>
                        </div>
              
                      </div>
                  </div>
          <!--fin info students-->
        </div>
        
        <div class="modal-footer">
         
        </div>
      </div>
    </div>

  </div>
