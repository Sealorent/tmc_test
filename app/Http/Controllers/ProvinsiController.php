<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $provinsi  = Provinsi::all();
        return view('provinsi.index', compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_provinsi' => 'required|unique:provinsi',
        ]);
        try {
            $provinsi = new Provinsi();
            $provinsi->nama_provinsi = $request->nama_provinsi;
            $provinsi->save();
            return redirect()->back()->with('success', "Berhasi Menambahkan Data");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "error");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "error");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('provinsi.edit', compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama_provinsi' => 'required',
        ]);
        try {
            $provinsi = Provinsi::findOrFail($id);
            $provinsi->nama_provinsi = $request->nama_provinsi;
            $provinsi->update();
            return redirect()->back()->with('success', "Berhasil Edit Data");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "error");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "error");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $provinsi = Provinsi::findOrFail($id);
            $provinsi->delete();
            return redirect()->route('provinsi.index')->withSuccess('Data telah dihapus');
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') { // integrity constraint violation
                return back()->withError('Data Digunakan Di Tabel Lain');
            }
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
