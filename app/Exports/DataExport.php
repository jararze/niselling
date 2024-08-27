<?php

namespace App\Exports;

use App\Models\Frontend\Quote;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    protected $dateRange;

    public function __construct($dateRange)
    {
        $this->dateRange = $dateRange;
    }

    public function collection()
    {
//        dd("das");
        // Customize your query based on $this->dateRange
        $query = Quote::whereMonth('created_at', '=', date('m', strtotime($this->dateRange)))
            ->whereYear('created_at', '=', date('Y', strtotime($this->dateRange)))
            ->get();
//            ->toRawSql();

        return ($query);
    }
}
