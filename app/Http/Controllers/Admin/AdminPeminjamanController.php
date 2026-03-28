<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminPeminjamanController extends Controller
{
    /**
     * INDEX (TANPA JOIN - FIX TOTAL)
     */
    public function index()
    {
        $data = DB::table('peminjaman')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.peminjaman.index', compact('data'));
    }

    /**
     * KEMBALIKAN BUKU
     */
    public function kembalikan($id)
    {
        try {
            $data = DB::table('peminjaman')->where('id', $id)->first();

            if (!$data) {
                return response()->json([
                    'error' => 'Data tidak ditemukan'
                ], 404);
            }

            $today = now();

            $batas = $data->batas_kembali
                ? Carbon::parse($data->batas_kembali)
                : null;

            $denda = 0;

            if ($batas && $today->gt($batas)) {
                $hari = $today->diffInDays($batas);
                $denda = $hari * 10000;
            }

            DB::table('peminjaman')
                ->where('id', $id)
                ->update([
                    'tanggal_kembali' => $today->format('Y-m-d'),
                    'denda' => $denda
                ]);

            return response()->json([
                'success' => true
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * BULK DELETE
     */
    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->ids;

            if (!$ids || !is_array($ids)) {
                return redirect()->back()->with('error', 'Tidak ada data dipilih');
            }

            DB::table('peminjaman')
                ->whereIn('id', $ids)
                ->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}