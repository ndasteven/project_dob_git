<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elèves') }}
        </h2>
    </x-slot>
    <style>
.dataTables_filter input {
    /* Vos styles CSS personnalisés ici */
   display: none; 
    /* Ajoutez d'autres styles personnalisés selon vos besoins */
}
.dataTables_filter label {
    /* Vos styles CSS personnalisés ici */
   display: none; 
    /* Ajoutez d'autres styles personnalisés selon vos besoins */
}
.btn-spacing {
    margin-right: 10px; /* Ajoutez la marge à droite pour espacer les boutons */
    background-color: #fff;
    border-radius: 10px;

}
    </style>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-sm col-md-2 col-4" data-bs-toggle="modal" data-bs-target="#modalStudent" wire:click='create()' style="background-color: #39b315;color:#fff; margin-right:12px">Ajouter un élève</button>
        </div>
        
        <!--liste des élèves -->
        <div class="row">
            <div class="col-12  mt-4">
                <div class=" row mb-4 ">
                    <div class="col">
                      <input placeholder="rechercher"  type="search"  class="form-control shadow-lg chercher" style="border-radius: 100px" />  
                        <small class=""><div class="totalResultat"></div></small>
                    </div>  
                </div>                
            </div>
           {{--boutton de click cache qui declanche la function studentinfo() de notre controlleur livewire--}}
           <button class="clickstudentinfo" data-bs-toggle="modal" data-bs-target="#modalStudentInfos" wire:click='studentInfo' wire:model='ide' style="display: none"></button>
           {{--fin boutton--}}
            <div class="container" wire:ignore>
                
                <div class="row">
                    
                    <div class="col-md-12 col-12 overflow-x-scroll">
                        <table class="table shadow-2xl col-12 container-fluid display " style="font-size: 12px; padding:0; border-bottom:none; " id="example"  >
                            <thead class="table-light">
                              <tr>
                                <th scope="" >Matricule @if($orderField=='matricule') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif </th>
                                <th scope="">Nom @if($orderField=='nom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                                <th scope="" >Prenom @if($orderField=='prenom') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                                <th scope="" >Genre @if($orderField=='genre') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th>
                                <th scope="" >Classe @if($orderField=='classe') @if($orderDirection === 'ASC') <i class="bi bi-arrow-up-circle"></i> @else <i class="bi bi-arrow-down-circle"></i> @endif @endif</th> 
                                <th scope="" >Ecole</th>
                                <th scope="" >Fiches</th>
                                <th scope="" class="d-none d-sm-block">Action</th>
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
                                   <button class="btn btn-sm idinfo"  id="{{$student->id}}"    style="background-color: #39b315;color:#fff" >selectionner</button>
                                  </td>
                             </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
        var datatable= $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'pdf',
                text: 'Télécharger en PDF',
                className: 'btn btn-sm btn-outline-primary btn-spacing',
            },
            
            {
                extend: 'copy',
                text: 'Copier le tableau',
                className: 'btn btn-sm btn-outline-primary btn-spacing'
            },
            {
                extend: 'print',
                text: 'Imprimer',
                title: 'Mon Tableau de Données',
                className: 'btn btn-sm btn-outline-primary btn-spacing',
                customize: function(win) {
                    $(win.document.body).css('font-size', '12px').find('table').DataTable().columns([6,7]).visible(false);;
                }
            },
        ],        
    });
    
    $('.chercher').on('input', function(){
        datatable.search($('.chercher').val()).draw();
        if ($('.chercher').val().length>=1) {
            var totalResults = datatable.rows({ filter: 'applied' }).count(); 
            $('.totalResultat').html('<span>nombre de resultat trouvé : <span>'+ totalResults) 
        }else{
            $('.totalResultat').html('')
        }
        var totalResults = datatable.rows({ filter: 'applied' }).count();
    })
    $('.idinfo').on('click', function(){
        @this.set('ide',$(this).attr('id'))
        $('.clickstudentinfo').click() // nous recreons un button de class='clickstudentinfo' en cachette car lorsqu'un boutton se retrouve dans un datatable il perd sa fonction de communication avec livewire
    })
})
    </script>
</div>
