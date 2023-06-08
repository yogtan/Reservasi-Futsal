<?php

namespace App\Http\Controllers;

use App\Models\Menyewa;
use App\Http\Requests\StoreMenyewaRequest;
use App\Http\Requests\UpdateMenyewaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menyewa = Menyewa::join('jadwals', 'menyewas.id_jadwal', '=', 'jadwals.id')
            ->where('menyewas.id_user', Auth::id())
            ->get();
        return view('menyewa.index', compact('menyewa'));
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
    public function store(StoreMenyewaRequest $request)
    {
        // if (Gate::denies('create-sewa')) {
        //     abort(403, 'Anda harus login untuk membuat sewa.'); // Tampilkan pesan error jika pengguna belum login
        // }
        $data = $request->validated();
        $data['id_lapangan'] = $request->input('id_lapangan');
        $data['id_user'] = Auth::id(); 
        $data['id_jadwal'] = $request->input('id_jadwal');
        $data['harga'] = $request->input('harga_lapangan');
        $data['tanggal'] = $request->input('tanggal');

        // Check for duplicate order
        $existingOrder = Menyewa::where('id_jadwal', $data['id_jadwal'])
        ->where('tanggal', $data['tanggal'])
        ->first();

        if ($existingOrder) {
        // Handle the duplicate order case
        // For example, you can return an error message or redirect back with an error
        return redirect()->back()->withErrors('Pesanan double pada waktu yang bersamaan.');
        }

        Menyewa::create($data);

        $id_lapangan = $request->input('id_lapangan');
        return redirect("/menyewa")->with('sewaSuccess', 'Penyewaan Success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menyewa $menyewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menyewa $menyewa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenyewaRequest $request, Menyewa $menyewa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menyewa $menyewa)
    {
        //
    }
}
