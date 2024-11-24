<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WismaExport implements FromView, WithStyles, WithHeadings
{
    protected $tenaga;
    protected $clients;

    public function __construct($tenaga, $clients)
    {
        $this->tenaga = $tenaga;
        $this->clients = $clients;
    }

    public function view(): View
    {
        return view('exports.wisma', [
            'tenaga' => $this->tenaga,
            'clients' => $this->clients,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Menambahkan border pada header tabel (baris 1)
        $sheet->getStyle('A1:F1')->applyFromArray([
            'borders' => [
                'top'    => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left'   => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right'  => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Menambahkan border ke seluruh tabel data tenaga
        $sheet->getStyle('A2:F' . (count($this->tenaga) + 1))->applyFromArray([
            'borders' => [
                'top'    => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left'   => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right'  => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);

        // Menetapkan lebar kolom otomatis hanya untuk data utama (A:F)
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Tabel "Wisma" (tanpa auto-size)
        $sheet->getStyle('A7:H11')->applyFromArray([
            'borders' => [
                'top'    => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left'   => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right'  => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Tenaga', 'Pendidikan', 'Kedudukan', 'Tempat Lahir', 'Tanggal Lahir'
        ];
    }
}
