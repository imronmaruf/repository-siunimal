<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Helpers\DeleteFile;
use App\Helpers\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataDosen = Dosen::all();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // ambil data kp dan tga
        $dataKp = $mahasiswa ? $mahasiswa->kerjaPraktek()->first() : null;
        $dataTga = $mahasiswa ? $mahasiswa->tugasAkhir()->first() : null;

        return view('admin.profile-setting.index', compact('mahasiswa', 'dataDosen', 'user', 'dataKp', 'dataTga'));
    }


    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'nim' => 'required',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:4096',
            'hp' => 'nullable|numeric',
            'email' => 'required|email|unique:users,email,' . Auth::id(), // Validasi email
            'dosen_pembimbing_kp' => 'nullable',
            'dosen_pembimbing_tga_1' => 'nullable',
            'dosen_pembimbing_tga_2' => 'nullable',
            'dosen_penguji_tga_1' => 'nullable',
            'dosen_penguji_tga_2' => 'nullable',
        ]);

        // Mengambil data mahasiswa yang akan diperbarui
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $fotoLama = $mahasiswa->foto;

        try {
            DB::beginTransaction();

            // Update data mahasiswa
            $mahasiswa->fill($data);

            // Jika ada foto baru diunggah
            if ($request->hasFile('foto')) {
                if ($fotoLama) {
                    DeleteFile::delete('admin/img/foto/' . $fotoLama);
                }

                $file_foto = $request->file('foto');
                $file_url = UploadFile::upload('admin/img/foto', $file_foto, $mahasiswa->name);
                $mahasiswa->foto = basename($file_url);
            }

            // Simpan data mahasiswa yang telah diperbarui
            $mahasiswa->save();

            // Update data pada tabel users yang terkait
            $mahasiswa->user()->update([
                'name' => $mahasiswa->name,
                'email' => $data['email'], // Perbarui email
            ]);

            DB::commit();
            return redirect()->route('profile-setting.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();


        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak cocok.');
        }

        try {
            DB::beginTransaction();

            $user->password = Hash::make($request->new_password);
            $user->save(); // Pastikan ini dipanggil pada instance yang benar

            DB::commit();
            return redirect()->route('profile-setting.index')->with('success', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}
