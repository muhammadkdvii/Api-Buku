<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
   
    public function index()
    {
        // Mengambil semua data buku dan mengurutkan berdasarkan judul
        $data = Buku::orderBy('judul', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tanggal_publikasi' => 'required|date',
        ]);

        // Menyimpan data buku
        $dataBuku = new Buku;
        $dataBuku->judul = $validatedData['judul'];
        $dataBuku->pengarang = $validatedData['pengarang'];
        $dataBuku->tanggal_publikasi = $validatedData['tanggal_publikasi'];

        $dataBuku->save();

        // Mengembalikan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Sukses Memasukan Data',
            'data' => $dataBuku
        ], 201);  // Status code 201: Created
    }

    public function show(string $id)
    {
        // Mencari buku berdasarkan ID
        $data = Buku::find($id);
        
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);  // Status code 404: Not Found
        }
    }

    public function update(Request $request, string $id)
    {
        // Mencari buku berdasarkan ID
        $dataBuku = Buku::find($id);

        if (!$dataBuku) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);  // Status code 404: Not Found
        }

        // Validasi input data
        $validatedData = $request->validate([
            'judul' => 'sometimes|string|max:255',
            'pengarang' => 'sometimes|string|max:255',
            'tanggal_publikasi' => 'sometimes|date',
        ]);

        // Update data buku
        $dataBuku->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $dataBuku
        ], 200);  // Status code 200: OK
    }

    public function destroy(string $id)
    {
        // Mencari buku berdasarkan ID
        $dataBuku = Buku::find($id);

        if (!$dataBuku) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);  // Status code 404: Not Found
        }

        // Menghapus data buku
        $dataBuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);  // Status code 200: OK
    }
}