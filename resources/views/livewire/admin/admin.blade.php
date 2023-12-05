<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrateur') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="asset/css/admin/admin.css">
<div class="container">
    <div class="row mt-4">
        <div class="row">
            <div class="col-md-10 row d-flex justify-content-center  mx-auto" >
              <div class="col-md-4 ">
                  <div class="card">
                    <div class="card-content">
                      <p class="card-title">Profil</p>
                      <p>Super Admin: <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countSuperAdmin}} </span></p>
                      <p class="card-para">Ce profil super admin à tout les droits sur l'application.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                 <div class="card cardInfo">
                    <div class="card-content">
                        <p class="card-title">Profil</p>
                        <p>Admin : <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countAdmin}} </span> </p>
                      <p class="card-para">Ce profil admin peut lire, ajouter et modifier les données sur l'application .</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-content">
                        <p class="card-title">Profil</p>
                        <p>Utilisateur: <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countUtilisateur}} </span> </p>
                      <p class="card-para">Ce profil ne peut que lire les données sur l'application.</p>
                    </div>
                  </div>
                </div>   
            </div>
            <div class="col-md-10 row mx-auto">
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-md-5">
                      <div class="row">
                        <div class="col-10 ">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Rechercher un email</label>
                            <input type="email" class="form-control" wire:model="search" wire:keydown.debounce.900ms="research" id="exampleFormControlInput1" placeholder="email">
                          </div>
                        </div>
                        <div class="col-1 mt-4"">
                          <span wire:loading style="margin: 0; float-end">
                            <div class="spinner-border text-warning mt-2" role="status">
                            </div>
                          </span>
                        </div>
                      </div>
                        
                    </div>
                    
                  <div class=" col-5 col-md-4">
                    <button class="btn float-end btn-sm  btn-primary" wire:click="create()" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajouter un Utilisateur</button>    
                  </div>  
                </div>
                
                <div class="overflow-auto">
                    <table class="table mt-3">
                        <thead>
                          <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col" style="text-align:center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($userProfile as $user)
                             <tr>
                                <td>{{$user->name}} </td>
                                <td>{{$user->prenom}} </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="" style="text-align: center">
                                    <button class="btn btn-sm btn-warning col-4" wire:click="update({{$user->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Modifier</button>
                                    <button class="btn btn-sm btn-danger col-4" wire:click ="getUserId({{$user->id}})" style="margin-right:8px" data-bs-toggle="modal" data-bs-target="#exampleModal">supprimer</button>
                                </td>
                            </tr>    
                            @endforeach
                           
                        </tbody>
                    </table>
                    
                </div>
                {{$userProfile->links()}}
            </div>
        </div>
        
    </div>    
</div>
 <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

        <h1 class="modal-title fs-5" id="staticBackdropLabel">@if($creer) Ajouter un Utilisateur @endif @if($edit) Modifier l'utilisateur @endif </h1>
        <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
        {{--form register jetstream--}}
        <form @if($creer) wire:submit.prevent='storeUser' @endif @if($edit) wire:submit.prevent='updateUser()' @endif>
          @csrf
            <div class="row mb-6">
                <div class="col-md col-12">
                    <label for="validationServer01" class="form-label">Nom </label>
                    <input  class="form-control @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='name'  >
                    <div class="invalid-feedback">
                        @error('name')Entrer un nom valide @enderror"
                      </div>
                </div>
                
                <div class="col-md col-12">
                  <label for="validationServer01" class="form-label">Prenom</label>
                  <input  class="form-control @error('prenom') is-invalid @enderror " id="validationServer01" value="" wire:model='prenom'  >
                  <div class="invalid-feedback">
                      @error('prenom')Entrer un prenom valide @enderror"
                  </div>
                </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Email</label>
                  <input type="email"  class="form-control @error('email') is-invalid @enderror " id="validationServer01" value="" wire:model='email'  >
                  <div class="invalid-feedback">
                      @error('email')Entrer un email valide @enderror"
                  </div>
              </div>
            </div>
            <div style="text-align:center">
              <span style="color: red">{{$matchPass}}</span> 
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Mot de passe </label>
                  <input  type="password"  class="form-control @error('password') is-invalid @enderror " id="validationServer01" value="" placeholder="********" wire:model='password' @if (strlen($matchPass)>3) @dump("hello") @endif  >
                  <div class="invalid-feedback">
                      @error('password')Entrer un nom valide @enderror"
                  </div>
              </div>
            </div>
           
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Repeter le mot de passe </label>
                  <input type="password"  class="form-control @error('repeatPassword') is-invalid @enderror " id="validationServer01" value="" placeholder="********" wire:model='repeatPassword'  >
                  <div class="invalid-feedback">
                      @error('repeatPassword')Repeter le mot de passe svp @enderror"
                  </div>
              </div>
            </div>
            <div class="row">
              <select class="form-select form-control @error('role') is-invalid @enderror" aria-label="Default select example" wire:model="role">
                <option selected>Choisir le role de l'utilisateur</option>
                <option value="utilisateur">Utilisateur</option>
                <option value="admin">Admin</option>
                <option value="superAdmin">Super Admin</option>
              </select>
              <div class="invalid-feedback">
                      @error('role')selectionner le rôle de l'utilisateur svp @enderror"
                  </div>
            </div>
            <div class="row mt-3 ">
              <div class="col">
                <button class="btn btn-success col-12" >
                  @if($creer) Ajouter un Utilisateur @endif @if($edit) Modifier l'utilisateur @endif .
                </button>  
              </div>
              
          </div>
             </form>
        {{--form register jetstream--}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
      <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
      @include('livewire.loading')
      <!--fin loading -->
</div> 
<!--Fin modal form--> 
<!--Modal supression-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation de Suppression</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: red; font-weight:bold">Voulez vous vraiment supprimer  <span style="color:blue; font-weight:bold">{{$userName}} </span> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closer" data-bs-dismiss="modal">Annuler</button>
        <button wire:click="deleteUser({{$ide}})" type="button" class="btn btn-primary">Confirmer la suppression</button>
      </div>
    </div>
  </div>
</div>
<!--Fin modal suppression-->
</div>
<script>
  document.addEventListener('livewire:initialized', () => {
    @this.on('deleteUser', (data) => {
      $(".closer").click()
      Swal.fire(
      'suppression effectée',
      'l\'Utilisateur a été supprimé avec succès .',
      'success'
      ) 
    
         
    });
    @this.on('impossibledeleteUser', (data) => {
      $(".closer").click()
      Swal.fire(
      'suppression impossible',
      'Vous ne pouvez pas supprimer votre propre compte .',
      'error'
      ) 
   
         
    });
  })
</script>