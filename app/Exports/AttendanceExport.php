<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromArray, WithStyles, ShouldAutoSize
{
    protected $rows;
    protected $summary;
    protected $employee;
    protected $month;

    public function __construct($rows, $summary, $employee, $month)
    {
        $this->rows = $rows;
        $this->summary = $summary;
        $this->employee = $employee;
        $this->month = $month;
    }

    public function array(): array
    {
        $data = [];

        // ===== HEADER =====
        $data[] = ["LAPORAN ABSENSI BULANAN"];
        $data[] = [];
        $data[] = ["Nama", $this->employee];
        $data[] = ["Bulan", $this->month];
        $data[] = [];

        // ===== TABLE HEADER =====
        $data[] = [
            "Tanggal","Masuk","Pulang","Kerja",
            "Lembur","Terlambat","Jobdesk",
            "Uang Makan","Tambahan","Potongan",
            "Total","Status"
        ];

        foreach ($this->rows as $r) {

            $status = 'Off';

            if ($r->check_in) {
                if ($r->check_in <= '07:05:00') {
                    $status = 'Tepat waktu';
                } elseif ($r->check_in < '07:15:00') {
                    $status = 'Perlu perbaikan';
                } else {
                    $status = 'Terlambat';
                }
            }

            $data[] = [
                $r->date,
                $r->check_in ?? '-',
                $r->check_out ?? '-',
                $r->work_minutes,
                $r->overtime_minutes,
                $r->late_minutes,
                $r->check_in ? $r->extra_job_salary : 0,
                $r->check_in ? $r->meal_allowance : 0,
                ($r->overtime_minutes / 60) * 6000,
                ($r->late_minutes / 60) * 4000,
                $r->daily_total,
                $status
            ];
        }

        // ===== SPASI BESAR (PENTING) =====
        $data[] = [];
        $data[] = [];
        $data[] = [];

        // ===== RINGKASAN =====
        $data[] = ["RINGKASAN BULANAN"];
        $data[] = [];

        $data[] = ["Total Hari Kerja", $this->summary['totalWorkDays']];
        $data[] = ["Total Lembur (menit)", $this->summary['totalOvertime']];
        $data[] = ["Total Terlambat (menit)", $this->summary['totalLate']];
        $data[] = ["Total Jobdesk", $this->summary['totalExtraJob']];
        $data[] = ["Total Uang Makan", $this->summary['totalMealAllowance']];
        $data[] = ["Total Gaji", $this->summary['totalSalary']];
        $data[] = ["Bonus", $this->summary['bonusAmount']];
        $data[] = ["Potongan Kasbon", $this->summary['loanDeduction']];
        $data[] = ["Gaji Diterima", $this->summary['salaryReceived']];

        return $data;
    }

    public function styles(Worksheet $sheet)
{
    // =========================
    // TITLE
    // =========================
    $sheet->mergeCells('A1:L1');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

    $highestRow = $sheet->getHighestRow();

    // =========================
    // DETEKSI HEADER (Tanggal)
    // =========================
    $headerRow = 0;

    for ($i = 1; $i <= $highestRow; $i++) {
        if ($sheet->getCell("A{$i}")->getValue() === "Tanggal") {
            $headerRow = $i;
            break;
        }
    }

    // SAFETY
    if ($headerRow === 0) {
        return [];
    }

    // =========================
    // STYLE HEADER TABEL
    // =========================
    $sheet->getStyle("A{$headerRow}:L{$headerRow}")
        ->getFont()->setBold(true);

    $sheet->getStyle("A{$headerRow}:L{$headerRow}")
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFEFEFEF');

    // =========================
    // DETEKSI AKHIR TABEL
    // =========================
    $tableEndRow = $headerRow;

    for ($i = $headerRow + 1; $i <= $highestRow; $i++) {

        $val = $sheet->getCell("A{$i}")->getValue();

        if ($val === "RINGKASAN BULANAN") {
            break;
        }

        if (!empty($val)) {
            $tableEndRow = $i;
        }
    }

    // =========================
    // BORDER TABEL UTAMA (FIX)
    // =========================
    $sheet->getStyle("A{$headerRow}:L{$tableEndRow}")
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // =========================
    // DETEKSI RINGKASAN
    // =========================
    for ($i = 1; $i <= $highestRow; $i++) {

    if ($sheet->getCell("A{$i}")->getValue() === "RINGKASAN BULANAN") {

        // ===== BOLD TITLE =====
        $sheet->getStyle("A{$i}")
            ->getFont()->setBold(true)->setSize(13);

        // ===== TAMBAH JARAK ATAS (VISUAL) =====
        $sheet->getRowDimension($i)->setRowHeight(25);

        // ===== POSISI DATA =====
        $start = $i + 2;
        $end = $start + 8;

        // ===== BOX RAPI (A:B SAJA) =====
        $sheet->getStyle("A{$start}:B{$end}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // ===== RAPATIN ANGKA KE KANAN =====
        $sheet->getStyle("B{$start}:B{$end}")
            ->getAlignment()->setHorizontal('right');

        // ===== BOLD TOTAL =====
        $sheet->getStyle("A{$end}:B{$end}")
            ->getFont()->setBold(true);

        break;
    }
}

    return [];
}

}