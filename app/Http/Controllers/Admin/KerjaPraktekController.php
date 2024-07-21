<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use App\Helpers\DeleteFile;
use App\Helpers\UploadFile;
use App\Models\KerjaPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class KerjaPraktekController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin-only')) {
            $dataKp = KerjaPraktek::with(['mahasiswa', 'dosenPembimbing'])->get();
        } else {
            $mahasiswaId = Mahasiswa::where('user_id', Auth::id())->pluck('id')->first();
            $mahasiswa = Mahasiswa::find($mahasiswaId);

            $dataKp = KerjaPraktek::where('mahasiswa_id', $mahasiswaId)
                ->with(['mahasiswa', 'dosenPembimbing'])
                ->get();
        }

        return view('admin.data-kp.index', compact('dataKp'));
    }


    public function show($id)
    {
        $dataKp = KerjaPraktek::find($id);

        if (Gate::denies('admin-only') && $dataKp->mahasiswa->user_id !== Auth::id()) {
            abort(403);
        }

        $dataKp = KerjaPraktek::with(['mahasiswa', 'dosenPembimbing'])->findOrFail($id);
        return view('admin.data-kp.detail', compact('dataKp'));
    }

    public function create()
    {
        if (Gate::allows('admin-only')) {
            $mahasiswas = Mahasiswa::with('dosenPembimbingKp')->get();
            $nim = null;
        } else {
            $mahasiswas = Mahasiswa::with('dosenPembimbingKp')
                ->where('user_id', Auth::id())
                ->get();
            $nim = Mahasiswa::where('user_id', Auth::id())->pluck('nim')->first();

            // cek jika mahasiswa sudah menambahkan data
            $existingData = KerjaPraktek::where('mahasiswa_id', $mahasiswas->first()->id)->first();
            if ($existingData) {
                return redirect()->route('data-kp.index')->with('warning', 'Anda sudah menambahkan data kerja praktek. Jika ada kesalahan, silahkan edit dan update data Anda.');
            }
        }

        return view('admin.data-kp.create', compact('mahasiswas', 'nim'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'mahasiswa_id' => 'required',
                'judul_kp' => 'required|string',
                'dosen_pembimbing' => 'required|string',
                'latar_belakang' => 'required|string',
                'nilai' => 'nullable|numeric',
                'link_github' => 'nullable|url',
                'link_gdrive' => 'nullable|url',
                'laporan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'bukti_distribusi' => 'nullable|file|mimes:pdf|max:2048',
                'bukti_nilai' => 'nullable|file|mimes:pdf|max:2048',
            ],

            [
                'mahasiswa_id.required' => 'Mohon pilih mahasiswa',
                'dosen_pembimbing.required' => 'Dosen pembimbing tidak ditemukan, silahkan update data profil anda terlebih dahulu',
                'laporan.max' => 'File laporan melebihi batas ukuran 2 MB',
                'bukti_distribusi.max' => 'File bukti distribusi melebihi batas ukuran 2 MB',
                'bukti_nilai.max' => 'File bukti nilai melebihi batas ukuran 2 MB',
                'link_github.url' => 'Link Github harus berupa URL',
                'link_gdrive.url' => 'Link Google Drive harus berupa URL',
                'bukti_distribusi.mimes' => 'File bukti distribusi harus berupa PDF',
                'bukti_nilai.mimes' => 'File bukti nilai harus berupa PDF',
                'laporan.mimes' => 'File laporan harus berupa PDF, DOC, atau DOCX',
                'mahasiswa_id.exists' => 'Mahasiswa tidak ditemukan',
                'dosen_pembimbing.exists' => 'Dosen pembimbing tidak ditemukan',
            ]

        );

        $mahasiswaId = $data['mahasiswa_id'];
        $existingData = KerjaPraktek::where('mahasiswa_id', $mahasiswaId)->first();

        if ($existingData) {
            return redirect()->route('data-kp.index')->with('warning', 'Anda sudah menambahkan data kerja praktek. Jika ada kesalahan, silahkan edit dan update data Anda.');
        }

        try {
            DB::beginTransaction();

            $mahasiswa = Mahasiswa::find($mahasiswaId);
            $dosen_pembimbing = $mahasiswa->dosen_pembimbing_kp;

            if ($request->hasFile('laporan')) {
                $file_url = UploadFile::upload('admin/repo/kp/laporan', $request->file('laporan'), $mahasiswa->name);
                $data['laporan'] = basename($file_url);
            }

            if ($request->hasFile('bukti_distribusi')) {
                $file_url = UploadFile::upload('admin/repo/kp/bukti-distribusi', $request->file('bukti_distribusi'), $mahasiswa->name);
                $data['bukti_distribusi'] = basename($file_url);
            }

            if ($request->hasFile('bukti_nilai')) {
                $file_url = UploadFile::upload('admin/repo/kp/bukti-nilai', $request->file('bukti_nilai'), $mahasiswa->name);
                $data['bukti_nilai'] = basename($file_url);
            }

            $dataKp = new KerjaPraktek();
            $dataKp->mahasiswa_id = $data['mahasiswa_id'];
            $dataKp->judul_kp = $data['judul_kp'];
            $dataKp->latar_belakang = $data['latar_belakang'];
            $dataKp->dosen_pembimbing = $dosen_pembimbing;
            $dataKp->nilai = $data['nilai'];
            $dataKp->link_github = $data['link_github'];
            $dataKp->link_gdrive = $data['link_gdrive'];
            $dataKp->bukti_distribusi = $data['bukti_distribusi'];
            $dataKp->bukti_nilai = $data['bukti_nilai'];
            $dataKp->laporan = $data['laporan'];
            $dataKp->save();

            DB::commit();
            Session::flash('success', 'Data Kerja Praktek berhasil ditambahkan');
            return redirect()->route('data-kp.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit($id)
    {
        if (Gate::allows('admin-only')) {
            $mahasiswas = Mahasiswa::with('dosenPembimbingKp')->get();
            $dataKp = KerjaPraktek::findOrFail($id);
            $nim = null;
        } else {
            $mahasiswas = Mahasiswa::with('dosenPembimbingKp')
                ->where('user_id', Auth::id())
                ->get();
            $dataKp = KerjaPraktek::where('mahasiswa_id', Mahasiswa::where('user_id', Auth::id())->pluck('id')->first())->firstOrFail();
            $nim = Mahasiswa::where('user_id', Auth::id())->pluck('nim')->first();
        }
        return view('admin.data-kp.edit', compact('mahasiswas', 'nim', 'dataKp'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'mahasiswa_id' => 'required',
                'judul_kp' => 'required|string',
                'latar_belakang' => 'required|string',
                'dosen_pembimbing' => 'required',
                'nilai' => 'nullable|numeric',
                'link_github' => 'nullable|url',
                'link_gdrive' => 'nullable|url',
                'bukti_distribusi' => 'nullable|file|mimes:pdf|max:2048',
                'bukti_nilai' => 'nullable|file|mimes:pdf|max:2048',
                'laporan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ]
        );

        $dataKp = KerjaPraktek::findOrFail($id);
        $mahasiswaId = $data['mahasiswa_id'];

        try {
            DB::beginTransaction();

            $mahasiswa = Mahasiswa::find($data['mahasiswa_id']);
            $dosen_pembimbing = $mahasiswa->dosen_pembimbing_kp;
            $namaMahasiswa = $mahasiswa->name;

            if ($request->hasFile('laporan')) {
                $file_url = UploadFile::upload('admin/repo/kp/laporan', $request->file('laporan'), $namaMahasiswa);
                $data['laporan'] = basename($file_url);
            }

            if ($request->hasFile('bukti_distribusi')) {
                $file_url = UploadFile::upload('admin/repo/kp/bukti-distribusi', $request->file('bukti_distribusi'), $namaMahasiswa);
                $data['bukti_distribusi'] = basename($file_url);
            }

            if ($request->hasFile('bukti_nilai')) {
                $file_url = UploadFile::upload('admin/repo/kp/bukti-nilai', $request->file('bukti_nilai'), $namaMahasiswa);
                $data['bukti_nilai'] = basename($file_url);
            }

            $dataKp = KerjaPraktek::find($id);
            $dataKp->mahasiswa_id = $mahasiswaId;
            $dataKp->dosen_pembimbing = $dosen_pembimbing;
            $dataKp->judul_kp = $data['judul_kp'];
            $dataKp->latar_belakang = $data['latar_belakang'];
            $dataKp->link_github = $data['link_github'];
            $dataKp->link_gdrive = $data['link_gdrive'];
            $dataKp->bukti_distribusi = $data['bukti_distribusi'];
            $dataKp->bukti_nilai = $data['bukti_nilai'];
            $dataKp->laporan = $data['laporan'];

            $dataKp->save();
            DB::commit();
            Session::flash('success', 'Data Kerja Praktek berhasil diupdate');
            return redirect()->route('data-kp.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataKp = KerjaPraktek::findOrFail($id);
            if ($dataKp->laporan) {
                DeleteFile::delete('admin/repo/kp/laporan', $dataKp->laporan);
            }
            if ($dataKp->bukti_distribusi) {
                DeleteFile::delete('admin/repo/kp/bukti-distribusi', $dataKp->bukti_distribusi);
            }
            if ($dataKp->bukti_nilai) {
                DeleteFile::delete('admin/repo/kp/bukti-nilai', $dataKp->bukti_nilai);
            }
            $dataKp->delete();
            DB::commit();
            Session::flash('success', 'Data Kerja Praktek berhasil dihapus');
            return redirect()->route('data-kp.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
