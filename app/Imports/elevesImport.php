<?php

namespace App\Imports;

use App\Models\eleve;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class elevesImport implements ToCollection,   WithBatchInserts, WithChunkReading,  WithUpserts, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*
    public function model(array $row)
    {
        
        return new eleve([
            'classe'=>"6eme",
            'matricule'=> $row[1],
            'nom'=>$row[2],
            'prenom'=>$row[3],
            'genre'=>$row[4],
            'dateNaissance'=>$row[5],
            'serie'=>'null',
            'annee'=>"2019",
        ]);        
    }
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            eleve::create([
                'classe'=>"6eme",
                'matricule'=> $row[1],
                'nom'=>$row[2],
                'prenom'=>$row[3],
                'genre'=>$row[4],
                'dateNaissance'=>$row[5],
                'serie'=>'null',
                'annee'=>"2019",
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
        
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function uniqueBy()
    {
        return 'matricule';
    }
}
