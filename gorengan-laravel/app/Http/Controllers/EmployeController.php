<?php

namespace App\Http\Controllers;

use App\Models\tb_employe;
use Illuminate\Http\Request;

class employeController extends Controller
{
    public function index()
    {
        $employe = tb_employe::all();
        return view ('employe.employe', compact('employe'));
    }

    public function create()
    {
        return view('employe.employe-input');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'departemen' => 'required'
        ]);

        tb_employe::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'departemen' => $request->departemen
        ]);

        return redirect('/employe');
    }

    public function edit($id)
    {
        $employe = tb_employe::findorfail($id);
        return view ('employe.employe-edit', compact('employe'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'departemen' => 'required'
        ]);

        $employe = tb_employe::find($id);
        $employe->nama = $request->nama;
        $employe->kontak = $request->kontak;
        $employe->alamat = $request->alamat;
        $employe->jabatan = $request->jabatan;
        $employe->departemen = $request->departemen;

        $employe->save();
        return redirect('/employe');
    }

    public function destroy($id)
    {
        $employe = tb_employe::find($id);
        $employe->delete();
        return back();
    }
}
