<?php

namespace App\Http\Controllers;

use App\Models\UnitBankSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UnitBankSampahController extends Controller
{
    public function index()
    {
        // Mengambil data unit beserta data admin-nya
        $unit = UnitBankSampah::with('admin')->latest()->get();
        return view('unit_bank_sampah.index', compact('unit'));
    }

    public function create()
    {
        return view('unit_bank_sampah.create');
    }

    public function store(Request $request)
    {
        // Validasi input form (gabungan untuk Unit dan Akun Admin)
        $request->validate([
            'nama_unit'  => 'required|string|max:255',
            'alamat'     => 'required|string',
            'nama_admin' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8',
        ]);

        // Gunakan DB Transaction agar jika salah satu gagal, semua dibatalkan
        DB::transaction(function () use ($request) {
            // 1. Buat akun Admin Unit di tabel users
            $user = User::create([
                'name'     => $request->nama_admin,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'admin_unit',
            ]);

            // 2. Buat profil Unit Bank Sampah
            UnitBankSampah::create([
                'nama_unit' => $request->nama_unit,
                'alamat'    => $request->alamat,
                'admin_id'  => $user->id,
            ]);
        });

        return redirect()->route('unit-bank-sampah.index')
                         ->with('success', 'Unit Bank Sampah dan Akun Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $unitBankSampah = UnitBankSampah::with('admin')->findOrFail($id);
        return view('unit_bank_sampah.edit', compact('unitBankSampah'));
    }

    public function update(Request $request, $id)
    {
        $unitBankSampah = UnitBankSampah::findOrFail($id);
        $user = User::findOrFail($unitBankSampah->admin_id);

        $request->validate([
            'nama_unit'  => 'required|string|max:255',
            'alamat'     => 'required|string',
            'nama_admin' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password'   => 'nullable|string|min:8', // Password boleh kosong jika tidak diubah
        ]);

        DB::transaction(function () use ($request, $unitBankSampah, $user) {
            // Update akun user
            $userData = [
                'name'  => $request->nama_admin,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            // Update unit
            $unitBankSampah->update([
                'nama_unit' => $request->nama_unit,
                'alamat'    => $request->alamat,
            ]);
        });

        return redirect()->route('unit-bank-sampah.index')
                         ->with('success', 'Data Unit Bank Sampah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $unitBankSampah = UnitBankSampah::findOrFail($id);
        
        // Hapus usernya, otomatis unitnya ikut terhapus karena kita pasang onDelete('cascade') di migration
        User::findOrFail($unitBankSampah->admin_id)->delete();

        return redirect()->route('unit-bank-sampah.index')
                         ->with('success', 'Unit Bank Sampah dan Akun Admin berhasil dihapus!');
    }
}