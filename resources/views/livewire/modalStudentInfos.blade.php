<div class="modal fade" id="modalStudentInfos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
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
                                    <img class="" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                      
                                      <p class="text-secondary mb-1">{{$eleveInfo->nom}} {{$eleveInfo->prenom}}</p>
                                      <p class="text-muted font-size-sm">{{$eleveInfo->nom}}</p>
                                      <p class="text-muted font-size-sm">{{$eleveInfo->matricule}}</p>
                                      <button class="btn btn-primary">Follow</button>
                                      <button class="btn btn-outline-primary">Message</button>
                                    </div>
                                    @else
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4 class="placeholder-glow col-6"></h4>
                                        <p class="card-text placeholder-glow">
                                            <span class="placeholder col-8 "></span>
                                            <span class="placeholder col-12"></span>
                                            <span class="placeholder col-10"></span>
                                          </p>
                                        <button class="btn btn-primary ">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button>
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
                                        {{$eleveInfo->nom}}
                                        @else
                                        <span class="placeholder col-3 "></span>
                                        @endif
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row mb-3 mt-2">
                                    <div class="col-sm-12">
                                      <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                
                              <div class="row gutters-sm">
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
  