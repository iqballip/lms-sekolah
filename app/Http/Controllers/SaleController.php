<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class SaleController extends Controller
{
    public function index()
    {
        return view('sale.index', [
            'title' => 'Sale',
            'datas' => Sale::all()
        ]);
    }

    public function create()
    {
        return view('sale.create', [
            'title'    => 'Sale',
            'products' => Products::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $no_struk = 'INV-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            Sale::create([
                'no_struk'    => $no_struk,
                'tgl_jual'    => now(),
                'total_bayar' => $request->total_bayar,
            ]);

            return redirect()->route('sale.index')->with('simpan', 'Penjualan dengan struk ' . $no_struk . ' berhasil disimpan');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withInput()->with('error', 'Gagal: No Struk sudah ada.');
            }
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan penjualan: ' . $e->getMessage());
        } catch (Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            return view('sale.edit', [
                'title' => 'Sale',
                'data'  => Sale::findOrFail($id)
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sale.index')->with('error', 'Data penjualan tidak ditemukan.');
        } catch (Throwable $e) {
            return redirect()->route('sale.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->update([
                'tgl_jual'    => now(),
                'total_bayar' => $request->total_bayar,
            ]);

            return redirect()->route('sale.index')->with('ubah', 'Penjualan dengan struk ' . $sale->no_struk . ' berhasil diupdate');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withInput()->with('error', 'Gagal: No Struk sudah ada.');
            }
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate penjualan: ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sale.index')->with('error', 'Data penjualan tidak ditemukan.');
        } catch (Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $sale  = Sale::findOrFail($id);
            $struk = $sale->no_struk;
            $sale->delete();

            return redirect()->route('sale.index')->with('hapus', 'Penjualan dengan struk ' . $struk . ' berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sale.index')->with('error', 'Data penjualan tidak ditemukan atau sudah dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('sale.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        } catch (Throwable $e) {
            return redirect()->route('sale.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}