<?php

namespace App\Livewire;

use App\Models\dren;
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

final class EcoleTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
            ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return ecole::query()
        ->leftJoin('drens', function($drens){
            $drens->on('ecoles.CODE_DREN','=','drens.code_dren');
        })
        ->select('ecoles.*', 'drens.nom_dren', 'drens.code_dren')
        ;

    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('CODSERVs')
            ->addColumn('NOMCOMPLs')
            
           /** Example of custom column using a closure **/
            ->addColumn('NOMCOMPLs_lower', fn (ecole $model) => strtolower(e($model->NOMCOMPLs)))
            ->addColumn('nom_dren',function(ecole $ecole){
                return $ecole->nom_dren;
            })
            ->addColumn('GENREs')
            ->addColumn('CODE_DREN')
            ->addColumn('created_at_formatted', fn (ecole $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            //Column::make('Id', 'id'),
            Column::make('CODE ECOLE', 'CODSERVs')
                ->sortable()
                ->searchable(),
            Column::make('NOM ECOLE', 'NOMCOMPLs')
                ->sortable()
                ->searchable(),

            Column::make('TYPE', 'GENREs')
                ->sortable()
                ->searchable(),

            Column::make('CODE DREN', 'CODE_DREN')
                ->sortable()
                ->searchable(),
            Column::make('NOM DREN', 'nom_dren', 'drens.nom_dren')
                ->sortable()
                ->searchable(),
               
            //Column::make('Created at', 'created_at_formatted', 'created_at')
             //   ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('CODE_DREN', 'ecoles.CODE_DREN')->operators(['contains']),
            Filter::inputText('CODSERVs')->operators(['contains']),
            Filter::inputText('NOMCOMPLs')->operators(['contains']),
            Filter::inputText('GENREs')->operators(['contains']),
            Filter::inputText('nom_dren')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\ecole $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
