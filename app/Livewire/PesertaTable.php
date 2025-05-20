<?php

namespace App\Livewire;

use App\Models\Peserta;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
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
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-nowrap'),
    
            Column::make('Nama', 'nama')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-nowrap font-medium text-gray-900'),
    
            Column::make('No Induk', 'no_induk')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-nowrap'),
    
            Column::make('NIK', 'nik')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-nowrap'),
    
            Column::make('No Telp', 'no_telp')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-nowrap'),
    
            Column::make('Alamat Asal', 'alamat_asal')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-normal break-words max-w-xs'),
    
            Column::make('Alamat Sekarang', 'alamat_sekarang')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-normal break-words max-w-xs'),
    
            Column::make('Jurusan', 'jurusan')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-normal break-words max-w-xs'),
    
            Column::make('Program Studi', 'program_studi')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-normal break-words max-w-xs'),
    
            Column::make('Kampus', 'kampus')
                ->sortable()
                ->searchable()
                ->bodyAttribute('px-4 py-2 whitespace-normal break-words max-w-xs'),
        ];
    }
    
    public function filters(): array
    {
        return [];
    }
}
