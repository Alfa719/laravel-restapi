<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::orderBy('tanggal_transaksi', 'DESC')->get();
        $response = [
            'message' => 'List latest transaction',
            'data' => $transaction
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_transaksi' => ['required'],
            'jumlah_transaksi' => ['required', 'numeric'],
            'jenis_transaksi' => ['required', 'in:pengeluaran,pemasukan'],
        ]);
        try {
            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Transaction created successfully',
                'data' => $transaction,
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'nama_transaksi' => ['required'],
            'jumlah_transaksi' => ['required', 'numeric'],
            'jenis_transaksi' => ['required', 'in:pengeluaran,pemasukan'],
        ]);
        try {
            $transaction->update($request->all());
            $response = [
                'message' => 'Transaction updated successfully',
                'data' => $transaction,
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
    public function show(Transaction $transaction)
    {
        $response = [
            'message' => 'Detail transaction',
            'data' => $transaction
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function destroy(Request $request, Transaction $transaction)
    {
        $transaction->delete();
        $response = [
            'message' => 'Transaction deleted successfully',
            'data' => $transaction,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
