<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminsExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::query()->get([ 'name' , 'email' , 'id' , 'created_at' , 'updated_at' ])->map(function ($q){
            return [
                'id' => $q->id,
                'name' => $q->name ,
                'email' => $q->email ,
                'hours' => $q->hours ,
                'created_at' => $q->created_at ,
                'updated_at' => $q->updated_at ,
            ];
        });

    }
    public function headings(): array
    {
        return [
            __('base.id'),
            __('base.name'),
            __('base.email'),
            __('base.hours'),
            __('base.created_at'),
            __('base.updated_at'),
        ];
    }
}
