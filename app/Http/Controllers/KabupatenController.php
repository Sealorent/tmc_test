<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::with('provinsi');
        if ($request->id_provinsi != null) {
            $kabupaten = $kabupaten->where('id_provinsi', $request->id_provinsi);
        }
        $kabupaten =  $kabupaten->get();
        return view('kabupaten.index', compact('kabupaten', 'provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kabupaten' => 'required|unique:kabupaten',
            'id_provinsi' => 'required',
            'jumlah_penduduk' => 'required',
        ]);
        try {
            $kabupaten = new Kabupaten();
            $kabupaten->id_provinsi = $request->id_provinsi;
            $kabupaten->nama_kabupaten = $request->nama_kabupaten;
            $kabupaten->jumlah_penduduk = $request->jumlah_penduduk;
            $kabupaten->save();
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
        $kabupaten = Kabupaten::findOrFail($id);
        $provinsi = Provinsi::all();
        return view('kabupaten.edit', compact('kabupaten', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama_kabupaten' => 'required',
            'id_provinsi' => 'required',
            'jumlah_penduduk' => 'required',
        ]);
        try {
            $kabupaten = Kabupaten::findOrFail($id);
            $kabupaten->id_provinsi = $request->id_provinsi;
            $kabupaten->nama_kabupaten = $request->nama_kabupaten;
            $kabupaten->jumlah_penduduk = $request->jumlah_penduduk;
            $kabupaten->update();
            return redirect()->back()->with('success', "Berhasi Edit Data");
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
            $kabupaten = Kabupaten::findOrFail($id);
            $kabupaten->delete();
            return redirect()->route('kabupaten.index')->withSuccess('Data telah dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
