<?php

namespace App\Exports;

use App\Models\Employee;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExportAll extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithCustomValueBinder
{
    use Exportable;

    public function collection()
    {
        return Employee::with('employeeJobStatus')->with('city')->with('employeeJobDescription')->get();
    }

    public function map($employees) : array {
        $gender = $employees->gender;
        if($gender == 0)$gender = "Muško"; else $gender = "Žensko";
        return [
            $employees->id,
            $employees->name,
            $employees->last_name,
            $employees->jmbg,
            $employees->birth_date,
            $employees->qualifications,
            $employees->home_address,
            $employees->city->name,
            $gender,
            $employees->email,
            $employees->employeeJobStatus->date_hired,
            $employees->employeeJobDescription->skills,
        ] ;
    }

    public function headings(): array
    {
        return [
            '#',
            'Ime',
            'Prezime',
            'JMBG',
            'Datum rođenja',
            'Kvalifikacije',
            'Adresa',
            'Grad',
            'Pol',
            'Email',
            'Datum zaposlenja',
            'Skills',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        $header = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => 'FFA0A0A0'],
            ],
        ];
        $border = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $count = Employee::all()->count();
        $count = $count + 1;
        $cell = "L$count";
        $sheet->getStyle("A1:$cell")->applyFromArray($border);
        $sheet->getStyle('A1:L1')->applyFromArray($header);

    }


}
