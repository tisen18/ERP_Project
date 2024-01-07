<?php

namespace App\Http\Controllers;

use App\Models\tb_customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = tb_customer::all();
        return view ('customer.customer', compact('customer'));
    }

    public function create()
    {
        return view('customer.customer-input');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        tb_customer::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        return redirect('/customer');
    }

    public function edit($id)
    {
        $customer = tb_customer::findorfail($id);
        return view ('customer.customer-edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required'
        ]);

        $customer = tb_customer::find($id);
        $customer->nama = $request->nama;
        $customer->kontak = $request->kontak;
        $customer->alamat = $request->alamat;

        $customer->save();
        return redirect('/customer');
    }

    public function destroy($id)
    {
        $customer = tb_customer::find($id);
        $customer->delete();
        return back();
    }
}
