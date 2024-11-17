<?php

namespace App\Exports;

use App\Models\SuccessSale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = SuccessSale::query();

        if ($this->startDate) {
            $query->where('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->where('created_at', '<=', $this->endDate);
        }

        return $query->with('car')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Марка',
            'Модель',
            'Год',
            'Цена',
            'Дата продажи',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->car->mark,
            $sale->car->model,
            $sale->car->year,
            $sale->car->price,
            $sale->created_at,
        ];
    }
}