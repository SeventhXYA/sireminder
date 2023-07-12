<?php

namespace App\Http\Controllers;

use App\RencanaKerja;
use App\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        // Ambil data dari database berdasarkan rentang tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = SuratMasuk::whereBetween('created_at', [$startDate, $endDate])->get();

        // Cetak PDF menggunakan Dompdf
        $pdf = Pdf::loadView('pdf.suratmasuk.pdf', ['data' => $data]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('data.pdf');
    }

    public function generatePdfSuratMasuk(Request $request)
    {
        // Ambil data dari database berdasarkan rentang tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = SuratMasuk::whereBetween('created_at', [$startDate, $endDate])->get();

        // Cetak PDF menggunakan Dompdf
        $pdf = Pdf::loadView('pdf.suratmasuk.pdf', ['data' => $data]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('data.pdf');
    }

    public function generatePdfRencanaKerja(Request $request)
    {
        // Ambil data dari database berdasarkan rentang tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = RencanaKerja::whereBetween('created_at', [$startDate, $endDate])->get();

        // Cetak PDF menggunakan Dompdf
        $pdf = Pdf::loadView('pdf.rencanakerja.pdf', ['data' => $data]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('data.pdf');
    }
}
