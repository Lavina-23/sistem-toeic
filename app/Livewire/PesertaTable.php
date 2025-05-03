<?php

namespace App\Livewire;

use App\Models\Peserta;
use Ramsey\Collection\Sort;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PesertaTable extends PowerGridComponent
{
    public string $tableName = 'peserta-table-iu5nar-table';
    public string $primaryKey = 'peserta_id';
    public string $sortField = 'peserta_id';

    public string $sortDirection = 'asc';

    public function primaryKey(): string
    {
        return 'peserta_id';
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Peserta::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('peserta_id')
            ->add('nama')
            ->add('no_induk')
            ->add('nik')
            ->add('no_telp')
            ->add('alamat_asal')
            ->add('alamat_sekarang')
            ->add('jurusan')
            ->add('program_studi')
            ->add('kampus');
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'peserta_id')->index()
                ->sortable()
                ->searchable(),
            Column::make('Nama', 'nama')
                ->sortable()
                ->searchable(),
            Column::make('No induk', 'no_induk')
                ->sortable()
                ->searchable(),

            Column::make('Nik', 'nik')
                ->sortable()
                ->searchable(),

            Column::make('No telp', 'no_telp')
                ->sortable()
                ->searchable(),

            Column::make('Alamat asal', 'alamat_asal')
                ->sortable()
                ->searchable(),

            Column::make('Alamat sekarang', 'alamat_sekarang')
                ->sortable()
                ->searchable(),

            Column::make('Jurusan', 'jurusan')
                ->sortable()
                ->searchable(),

            Column::make('Program studi', 'program_studi')
                ->sortable()
                ->searchable(),

            Column::make('Kampus', 'kampus')
                ->sortable()
                ->searchable(),

            Column::action('Action')->sortable(false)
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Peserta $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->peserta_id)
                ->id($row->peserta_id)
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->peserta_id])
        ];
    }

    // public function actionRules($row): array
    // {
    //    return [
    //         // Hide button edit for ID 1
    //         Rule::button('edit')
    //             ->when(fn($row) => $row->id === 1)
    //             ->hide(),
    //     ];
    // }
}
