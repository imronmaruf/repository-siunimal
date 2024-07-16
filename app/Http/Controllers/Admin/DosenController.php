<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function index()
    {
        $dataDosen = Dosen::all();
        return view('admin.data-dosen.index', compact('dataDosen'));
    }
    public  function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3|unique:dosen',
                'nip' => 'required|numeric|unique:dosen',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.unique' => 'Nama dosen sudah ada',
                'nip.required' => 'NIP harus diisi',
                'nip.unique' => 'NIP sudah digunakan oleh dosen lain',
            ]
        );

        try {
            DB::beginTransaction();
            $dataDosen = new Dosen();
            $dataDosen->name = $data['name'];
            $dataDosen->nip = $data['nip'];

            $dataDosen->save();

            DB::commit();
            Session::flash('success', 'Data berhasil disimpan');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function edit($id)
    {
        $dataDosen = Dosen::findOrFail($id);
        return response()->json(['dataUser' => $dataDosen], 200);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3|unique:dosen,name,' . $id,
                'nip' => 'required|numeric|unique:dosen,nip,' . $id,
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.unique' => 'Nama dosen sudah ada',
                'nip.required' => 'NIP harus diisi',
                'nip.unique' => 'NIP sudah digunakan oleh dosen lain',
            ]
        );

        try {
            DB::beginTransaction();
            $dataDosen = Dosen::findOrFail($id);
            $dataDosen->name = $data['name'];
            $dataDosen->nip = $data['nip'];
            $dataDosen->save();
            DB::commit();
            Session::flash('success', 'Data Berhasil Diubah');
            return redirect()->route('data-dosen.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataDosen = Dosen::findOrFail($id);
            $dataDosen->delete();
            DB::commit();
            Session::flash('success', 'Data Berhasil Dihapus');
            return redirect()->route('data-dosen.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
