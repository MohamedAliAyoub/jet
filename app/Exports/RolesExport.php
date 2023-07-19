<?php

namespace App\Exports;

use App\Models\Role;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Role::query()->get([ 'name' , 'title' ,  'id' , 'created_at' , 'updated_at' ])->map(function ($q){
            return [
                'id' => $q->id ,
                'name' => $q->name ,
                'title' => $q->title ,
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
            __('base.title'),
            __('base.created_at'),
            __('base.updated_at'),
        ];
    }
}
