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
        return User::query()->get()->map(function ($q){
            return [
                'id' => $q->id,
                'name' => $q->name ,
                'hours_balance' => $q->hours_balance ,
                'hours' => $q->hours ,
                'created_at' => $q->created_at ,
            ];
        });

    }
    public function headings(): array
    {
        return [
            __('base.id'),
            __('base.name'),
            __('base.hours_balance'),
            __('base.hours'),
            __('base.created_at'),
        ];
    }
}
