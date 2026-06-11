<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiController extends Controller
{
   public function index(Request $request)
    {
        $siswas = Siswa::all();
        $query = Absensi::with('siswa');
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $absensis = $query->latest()->get();
        return view('absensi.index', compact(
            'siswas',
            'absensis'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        $cekAbsensi = Absensi::where('siswa_id', $request->siswa_id)
            ->where('tanggal', $request->tanggal)
            ->first();

        if ($cekAbsensi) {
            return redirect()
                ->route('absensi.index')
                ->with('error', 'Siswa ini sudah diabsen pada tanggal tersebut.');
        }

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi berhasil disimpan');
    }
    public function edit(Absensi $absensi)
    {
        $siswas = Siswa::all();

        return view('absensi.edit', compact(
            'absensi',
            'siswas'
        ));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $absensi->update([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi berhasil diupdate');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi berhasil dihapus');
    }
    public function rekap(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $siswas = Siswa::with(['absensis' => function ($query) use ($bulan, $tahun) {
        $query->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        }])->get();

        return view('absensi.rekap', compact('siswas', 'bulan', 'tahun'));
    }
    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $siswas = Siswa::with(['absensis' => function ($query) use ($bulan, $tahun) {
        $query->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
    }])->get();

        $pdf = Pdf::loadView('absensi.pdf', compact('siswas', 'bulan', 'tahun'));

        return $pdf->download('rekap-absensi-'.$bulan.'-'.$tahun.'.pdf');
    }
}