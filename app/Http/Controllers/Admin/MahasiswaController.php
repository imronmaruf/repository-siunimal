<?php

namespace App\Http\Controllers\Admin;

use App\Events\DosenMahasiswaUpdated;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Helpers\DeleteFile;
use App\Helpers\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index()
    {
        $dataMhs = Mahasiswa::all();
        return view('admin.data-mahasiswa.index', compact('dataMhs'));
    }

    public function show($id)
    {
        $dataMhs = Mahasiswa::find($id);
        return view('admin.data-mahasiswa.detail', compact('dataMhs'));
    }

    public function edit($id)
    {
        $dataMhs = Mahasiswa::findOrFail($id);
        $dataDosen = Dosen::all();
        return view('admin.data-mahasiswa.edit', compact('dataMhs', 'dataDosen'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'nim' => 'required',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:4096',
            'hp' => 'nullable|numeric',
            'dosen_pembimbing_kp' => 'nullable',
            'dosen_pembimbing_tga_1' => 'nullable',
            'dosen_pembimbing_tga_2' => 'nullable',
            'dosen_penguji_tga_1' => 'nullable',
            'dosen_penguji_tga_2' => 'nullable',
        ]);

        // Temukan instansi yang akan diperbarui
        $mahasiswa = Mahasiswa::findOrFail($id);
        $fotoLama = $mahasiswa->foto;
        $namaMahasiswa = $mahasiswa->name;

        try {
            DB::beginTransaction();

            // Update data instansi
            $mahasiswa->name = $data['name'];
            $mahasiswa->nim = $data['nim'];
            $mahasiswa->hp = $data['hp'];
            $mahasiswa->dosen_pembimbing_kp = $data['dosen_pembimbing_kp'];
            $mahasiswa->dosen_pembimbing_tga_1 = $data['dosen_pembimbing_tga_1'];
            $mahasiswa->dosen_pembimbing_tga_2 = $data['dosen_pembimbing_tga_2'];
            $mahasiswa->dosen_penguji_tga_1 = $data['dosen_penguji_tga_1'];
            $mahasiswa->dosen_penguji_tga_2 = $data['dosen_penguji_tga_2'];

            // Jika ada foto baru diunggah
            if ($request->hasFile('foto')) {
                if ($fotoLama) {
                    DeleteFile::delete('admin/img/foto/' . $fotoLama);
                }

                $file_foto = $request->file('foto');
                $file_url = UploadFile::upload('admin/img/foto', $file_foto, $namaMahasiswa);
                $mahasiswa->foto = basename($file_url);
            }

            // Simpan data instansi yang telah diperbarui
            $mahasiswa->save();

            // Panggil event MahasiswaUpdated
            event(new DosenMahasiswaUpdated($mahasiswa));

            DB::commit();
            return redirect()->route('data-mahasiswa.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        DB::beginTransaction();
        try {
            if ($mahasiswa->foto) {
                DeleteFile::delete('admin/img/foto/' . $mahasiswa->foto);
            }

            $mahasiswa->delete();
            DB::commit();
            Session::flash('success', 'Berhasil menghapus data');
            return redirect()->route('data-mahasiswa.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
}
