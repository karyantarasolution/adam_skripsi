<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use App\Models\UnitBankSampah;
use App\Models\SaldoNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    public function index()
    {
        // Cari Admin ini memegang unit yang mana
        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();

        // Tampilkan nasabah yang HANYA terdaftar di unit tersebut
        $nasabah = Nasabah::where('unit_id', $unit->id)->with(['user', 'saldo'])->latest()->get();
        
        return view('nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8',
            'nik'          => 'required|string|max:16|unique:nasabahs',
            'alamat'       => 'required|string',
            'no_telp'      => 'required|string|max:15',
        ]);

        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();

        DB::transaction(function () use ($request, $unit) {
            // 1. Buat Akun Login Warga
            $user = User::create([
                'name'     => $request->nama_lengkap,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'nasabah',
            ]);

            // 2. Buat Data Profil Nasabah
            $nasabah = Nasabah::create([
                'user_id' => $user->id,
                'unit_id' => $unit->id,
                'nik'     => $request->nik,
                'alamat'  => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            // 3. Otomatis buatkan buku tabungan (saldo awal 0)
            SaldoNasabah::create([
                'nasabah_id'   => $nasabah->id,
                'jumlah_saldo' => 0,
            ]);
        });

        return redirect()->route('nasabah.index')->with('success', 'Nasabah baru berhasil didaftarkan dan buku tabungan telah dibuat!');
    }

    public function edit($id)
    {
        $nasabah = Nasabah::with('user')->findOrFail($id);
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $user = User::findOrFail($nasabah->user_id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password'     => 'nullable|string|min:8',
            'nik'          => 'required|string|max:16|unique:nasabahs,nik,'.$nasabah->id,
            'alamat'       => 'required|string',
            'no_telp'      => 'required|string|max:15',
        ]);

        DB::transaction(function () use ($request, $nasabah, $user) {
            // Update User
            $userData = [
                'name'  => $request->nama_lengkap,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $user->update($userData);

            // Update Nasabah
            $nasabah->update([
                'nik'     => $request->nik,
                'alamat'  => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
        });

        return redirect()->route('nasabah.index')->with('success', 'Data Nasabah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        User::findOrFail($nasabah->user_id)->delete(); // Menghapus user akan otomatis menghapus nasabah & saldo (efek cascade)

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus!');
    }
}