<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->get();
        for($i = 0; $i < $mahasiswa->count(); $i++) {
            $mahasiswa->prodi_id = $mahasiswa[$i]->prodi->nama_prodi;
        }
        $response = [
            'message' => 'List mahasiswa ordered by NIM',
            'data' => $mahasiswa
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => ['required', 'numeric'],
            'nama' => ['required'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'prodi' => ['required'],
        ]);
        try {
            $mahasiswa = Mahasiswa::create($request->all());
            $response = [
                'message' => 'Mahasiswa added successfully',
                'data' => $mahasiswa,
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed add mahasiswa" . $e->errorInfo
            ]);
        }
    }
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nama_transaksi' => ['required'],
            'jumlah_transaksi' => ['required', 'numeric'],
            'jenis_transaksi' => ['required', 'in:pengeluaran,pemasukan'],
        ]);
        try {
            $mahasiswa->update($request->all());
            $response = [
                'message' => 'Mahasiswa updated successfully',
                'data' => $mahasiswa,
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed update mahasiswa" . $e->errorInfo
            ]);
        }
    }
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->prodi_id = $mahasiswa->prodi->nama_prodi;
        $response = [
            'message' => 'Detail mahasiswa',
            'data' => $mahasiswa
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function destroy(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        $response = [
            'message' => 'Mahasiswa deleted successfully',
            'data' => $mahasiswa,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
