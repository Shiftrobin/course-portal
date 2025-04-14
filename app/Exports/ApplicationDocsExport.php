<?php

namespace App\Exports;

use App\Models\ApplicationModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ApplicationDocsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [

            'Application Date And Time',
            'Name',
            'Nationality',
            'Phone',
            'Email',
            'Qualification',
            'Message',
            'Course',
            'University',

        ];
    }

    public function collection()
    {
        $data = ApplicationModel::select(

            'created_at',
            'name',
            'nationality',
            'phone',
            'email',
            'qualification',
            'msg',
            'course',
            'university',

            )->get();
        return $data;
    }
}
