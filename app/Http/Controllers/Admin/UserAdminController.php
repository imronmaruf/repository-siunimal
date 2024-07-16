<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAdminController extends Controller
{
    public  function index()
    {
        $dataUser = User::all();
        $roles = User::select('role')->distinct()->get();
        // $statuses = User::select('status')->distinct()->get();
        $statuses = ['pending', 'aktif', 'non-aktif'];
        return view('admin.data-user.index', compact('dataUser', 'roles', 'statuses'));
    }


    public  function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'role' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'role.required' => 'Role harus dipilih',
                'status.required' => 'Status harus dipilih',
            ]
        );

        // Memisahkan bagian username dari email
        $emailToPass = explode('@', $data['email']);
        $username = $emailToPass[0];

        DB::beginTransaction();
        try {
            $dataUser = new User();
            $dataUser->name = $data['name'];
            $dataUser->email = $data['email'];
            $dataUser->role = $data['role'];
            $dataUser->status = $data['status'];
            $dataUser->password = Hash::make($username);
            $dataUser->save();

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
        $dataUser = User::findOrFail($id);
        $roles = User::select('role')->distinct()->get();
        $statuses = User::select('status')->distinct()->get();
        return response()->json(['dataUser' => $dataUser, 'roles' => $roles, 'statuses' => $statuses], 200);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.unique' => 'Nama sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'role.required' => 'Role harus dipilih',
                'status.required' => 'Status harus dipilih',
            ]
        );

        try {
            DB::beginTransaction();
            $dataUser = User::findOrFail($id);
            $dataUser->name = $data['name'];
            $dataUser->email = $data['email'];
            $dataUser->role = $data['role'];
            $dataUser->status = $data['status'];
            $dataUser->save();
            DB::commit();
            Session::flash('success', 'Data Berhasil Diubah');
            return redirect()->route('data-user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dataUser = User::findOrFail($id);
            $dataUser->delete();
            DB::commit();
            Session::flash('success', 'Data Berhasilsil Dihapus');
            return redirect()->route('data-user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
