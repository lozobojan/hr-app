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

class EmployeeExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder
{
    use Exportable;


    public function collection()
    {
        return Employee::with('employeeJobStatus')->with('city')->where('id', $this->id)->get();
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
            $employees->employeeJobStatus->date_hired

            // Carbon::parse($registration->event_date)->toFormattedDateString(),
            // Carbon::parse($registration->created_at)->toFormattedDateString()
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




    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function fileName(){
       $employee = Employee::where('id', $this->id)->first();
       return "$employee->name $employee->last_name";
    }


   /* public function query()
    {
        $data2 = Employee::select(
            'name',
            'last_name',
            'jmbg',
            'birth_date',
            'qualifications',
            'home_address',
            'city_id',
            'gender',
            'email',

        )->with('employeeJobStatus:id,date_hired')->where('id',$this->id);
        $data = Employee::query()
        ->where('id', $this->id)
        ->join('employee_job_statuses', 'employee_job_statuses.employee_id', '=',$this->id)
        ->select(
            'name',
            'last_name',
            'jmbg',
            'birth_date',
            'qualifications',
            'home_address',
            'city_id',
            'gender',
            'email',
            'date_hired'
        );
        return $data2;
    }
*/
    public function styles(Worksheet $sheet)
    {
        /*return [
            // Style the first row as bold text.
           1    => ['font' => ['bold' => true],  'fill' => array(
                'type'  => Fill::FILL_SOLID,
                'color' => array('rgb' => '000000')
            )],
        ];*/
       /* $sheet->getStyle('A2:E2')->applyFromArray(
            array(
                'fill' => array(
                    'type' => Fill::FILL_SOLID,
                    'color' => array('rgb' => 'FF0000')
                ),
                'font' => array(
                    'name' => 'Calibri',
                    'size' => 12,
                ),
            )
        );*/

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
        $sheet->getStyle('A1:K2')->applyFromArray($border);
        $sheet->getStyle('A1:K1')->applyFromArray($header);

    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_TEXT,
        ];
    }






}
