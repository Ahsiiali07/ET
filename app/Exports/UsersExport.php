<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $user = User::select(['firstname',
            'lastname',
            'email',
            'mobile',
            'd_o_b',
            'street',
            'zip',
            'city',
            'country',
            'status'
        ])
            ->where('user_type', 2)
            ->get();
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return ['firstname','lastname','email','mobile','d_o_b','street','zip','city','country','status'];
    }
}
