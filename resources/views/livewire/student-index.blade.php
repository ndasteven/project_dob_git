<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elèves') }}
        </h2>
    </x-slot>
    <style>
.dataTables_filter input {
    /* Vos styles CSS personnalisés ici */
  
    /* Ajoutez d'autres styles personnalisés selon vos besoins */
}
.dataTables_filter label {
    /* Vos styles CSS personnalisés ici */
   
    /* Ajoutez d'autres styles personnalisés selon vos besoins */
}
.btn-spacing {
    margin-right: 10px; /* Ajoutez la marge à droite pour espacer les boutons */
    background-color: #fff;
    border-radius: 10px;

}
.checkinfo{
    background-color: #39b315;color:#fff;
}
    </style>
    <div class="container" >
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-sm col-md-2 col-4" data-bs-toggle="modal" data-bs-target="#modalStudent" wire:click='create()' style="background-color: #39b315;color:#fff; margin-right:12px">Ajouter un élève</button>
        </div>
        <!--liste des élèves -->
        <div class="row">
                      
            <div class="container">
               
                <div class="row">
                    
                    <div class="col-md-12 col-12 mt-5">
                        <livewire:student-table/><button class="studentclick" wire:model='ide'   data-bs-toggle="modal" data-bs-target="#modalStudentInfos" wire:click="studentInfo()"   style="display:none" ></button>
                                                <button class="multipleCheck" wire:model='idsSelects' wire:click="getIdArray" data-bs-toggle="modal" data-bs-target="#multipleEdit"></button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--fin liste des élèves -->
        <!-- modal formulaire inscription-->
        @include('livewire.modal_form_students')
        <!--fin modal -->
        <!-- modal info student-->
        @include('livewire.modalStudentInfos')
        <!--fin modal -->
        <!-- modal editMultiple-->
        @include('livewire.multipleIdEdit_form')
        <!--fin modal -->

    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('edit', (data) => {
            @this.ide = data.rowId //ce id ce trouve dans le bouton sectionner dans le controlleur de mon powergrid "studentTable"
            
            $('.studentclick').click()
           });

          @this.on('editting',(data)=>{
            @this.idsSelects = data[0].myId; // on fait passer les id selectionner de la propriete $this->showCheckBox()->checkedValues() de la table powergrid studenTable dans le controlleur liveire StudentIndex.php
            $('.multipleCheck').click()
          })
          
        });
    </script>
</div>

<script> 
</script>
