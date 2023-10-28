<?php

namespace App\Livewire;

use App\Models\eleve;
use App\Models\ecole;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class studentTable extends PowerGridComponent
{
    use WithExport;
    public bool $multiSort = true;
    public $globalsIds;
    public int $perPage = 10;
    public array $perPageValues = [1, 5, 10, 20, 50];
    public function setUp(): array
    {
        $this->showCheckBox();
        
        return [
            
            Exportable::make('fiche DOB')
                ->striped('#A6ACCD')
                ->csvSeparator('|') 
                ->csvDelimiter("'")
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                    ->showToggleColumns(),
                                        
            Footer::make()
                //->showPerPage()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

   

    public function datasource(): Builder
    {
        return eleve::query()
        ->leftJoin('ecoles', function($ecole){
            $ecole->on('eleves.ecole_A','=','ecoles.id');  
        })
        
        ->leftJoin('fiches', function($fiche){
            $fiche->on('eleves.fiche_id','=','fiches.id');
        })
        ->select('eleves.*','eleves.classe as eleve_classe','eleves.nom as eleve_nom',
         'ecoles.NOMCOMPLs as ecole_nom', 'fiches.nom as fiche_nom','fiches.fiche_nom',
            'eleves.annee as eleve_annee');
        
    }

    public function relationSearch(): array
    {
        return [] ;
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('matricule')

           /** Example of custom column using a closure **/
            ->addColumn('matricule_lower', fn (eleve $model) => strtolower(e($model->matricule)))
            ->addColumn('prenom')
            ->addColumn('genre')
            ->addColumn('dateNaissance', function(eleve $eleve){
                return Carbon::parse($eleve->dateNaissance)->format('d-m-Y');
            })
            //->addColumn('ecole_id')
            ->addColumn('eleve_classe')
            ->addColumn('serie')
            ->addColumn('annee')
            ->addColumn('fiche',function(eleve $fiche){
                if($fiche->fiche_nom){
                    return(<<<HTML
                <div style="text-align:center">
                    <a href="storage/fiche_orientation/$fiche->fiche_nom" target="_blank">
                        <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                    </a>
                </div>
                HTML);
                }
                })
            
            ->addColumn('ecole_nom', function(eleve $ecole){
                return $ecole->ecole_nom;
            });
            //->addColumn('fiche_id');
            //->addColumn('created_at_formatted', fn (eleve $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            //Column::make('Id', 'id'),
            Column::make('Matricule', 'matricule')
                ->sortable()
                ->searchable(),

            Column::make('Nom', 'eleve_nom')
                ->sortable()
                ->searchable(),

            Column::make('Prenom', 'prenom')
                ->sortable()
                ->searchable(),

            Column::make('Genre', 'genre')
                ->sortable()
                ->searchable(),

            Column::make('Date naissance', 'dateNaissance')
                ->sortable()
                ->searchable(),

            //Column::make('Ecole id', 'ecole_id'),
            Column::make('Classe', 'eleve_classe')
                ->sortable()
                ->searchable(),
            
            Column::make('Serie', 'serie')
                ->sortable()
                ->searchable(),

            Column::make('Année d\'orientation', 'eleve_annee')
                ->sortable()
                ->searchable(),
            Column::make('Fiches d\'orientations', 'fiche'),
                

            Column::make('Ecole D\'accueil', 'ecole_nom')
                ->sortable()
                ->searchable(),
            //Column::make('Fiche id', 'fiche_id'),
            //Column::make('Created at', 'created_at_formatted', 'created_at')
            //    ->sortable(),

            Column::action('Action'),
            
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('matricule')->operators(['contains']),
            Filter::inputText('eleve_nom', ('eleves.nom'))->operators(['contains']),
            //Filter::inputText('ecole_nom', ('ecoles.NOMCOMPLs'))->operators(['contains']),
            Filter::inputText('prenom')->operators(['contains']),
            Filter::inputText('genre')->operators(['contains']),
            Filter::inputText('eleve_classe',('eleves.classe'))->operators(['contains']),
            Filter::inputText('serie')->operators(['contains']),
            Filter::inputText('eleve_annee', ('eleves.annee'))->operators(['contains']),
            Filter::inputText('dateNaissance')->operators(['contains']),
            //Filter::datetimepicker('created_at'),
        ];
        
    }
    public function editting($myId){
        dd("$myId");
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {    
        //$this->js('console.log('.$rowId.')');
    }
    #[\Livewire\Attributes\On('multipleSetting')]
    public function multipleSetting(){
        if(count($this->showCheckBox()->checkboxValues)>=1){
            $this->dispatch('editting',['myId'=>$this->showCheckBox()->checkedValues()]);
        }else{
            $this->js('alert("veillez cocher au moin un élève")');
        }
        
    }
    public function actions(\App\Models\eleve $row): array
    {
        return [
            
            Button::add('edit')
                ->slot('voir +')
                ->id()
                ->class('btn btn-sm  checkinfo')
                ->dispatch('edit', ['rowId' => $row->id]),
               /* Button::add('new-modal')
                ->slot('Edit: '.$row->id)
                ->render(function (eleve $eleve) {
                    return (<<<HTML
            <button class="btn btn-sm checkinfo" id="$eleve->id"  style="background-color: #39b315;color:#fff" >selectionner</button>
            HTML);}),*/
            
        ];
    }

    /*
    ->render(function (eleve $eleve) {
                    return (<<<HTML
            <button class="btn btn-sm checkinfo" id="$eleve->id"  style="background-color: #39b315;color:#fff" >selectionner</button>
            HTML);}),
            */
    public function actionRules($row): array
    {
       return [
        /*
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
                */
        ];
    }

    public function header(): array
    
    {
    return [
        Button::add()
        ->slot('Modification multiple')
        ->id()
        ->class('btn btn-sm  checkinfo')
        ->dispatch('multipleSetting',['ids'=>$this->showCheckBox()->checkedValues()])
    ];    
    }
    
}
