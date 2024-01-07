<?php

namespace App\Http\Controllers;

use App\Models\tb_vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = tb_vendor::all();
        return view ('vendor.vendor', compact('vendor'));
    }

    public function create()
    {
        return view('vendor.vendor-input');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        tb_vendor::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect('vendor');
    }

    public function edit($id)
    {
        $vendor = tb_vendor::findorfail($id);
        return view ('vendor.vendor-edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        $vendor = tb_vendor::find($id);
        $vendor->nama = $request->nama;
        $vendor->kontak = $request->kontak;
        $vendor->alamat = $request->alamat;

        $vendor->save();
        return redirect('vendor');
    }

    public function destroy($id)
    {
        $vendor = tb_vendor::find($id);
        $vendor->delete();
        return back();
    }
}
