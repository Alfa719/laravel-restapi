<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    public function index()
    {
        $response = [
            'message' => 'List Prodi ordered by ID',
            'data' => Prodi::orderBy('id', 'ASC')->get()
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required'
        ]);
        try {
            $response = [
                'message' => 'Prodi added successfully',
                'data' => Prodi::create($request->all())
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed add prodi" . $e->errorInfo
            ]);
        }
    }
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required'
        ]);
        try {
            $response = [
                'message' => 'Mahasiswa updated successfully',
                'data' => $prodi->update($request->all())
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed update prodi" . $e->errorInfo
            ]);
        }
    }
    public function show(Prodi $prodi)
    {
        $response = [
            'message' => 'Detail prodi',
            'data' => $prodi
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function destroy(Request $request,Prodi $prodi)
    {
        $response = [
            'message' => 'Prodi deleted successfully',
            'data' => $prodi->delete(),
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
