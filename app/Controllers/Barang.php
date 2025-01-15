<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\Controller;

class Barang extends Controller
{
    protected $barangModel;
    protected $session;
    
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->session = session();
    }
    
    public function index()
    {
        $data['barang'] = $this->barangModel->findAll();
        return view('barang/index', $data);
    }
    
    public function create()
    {
        return view('barang/create');
    }

    public function store()
    {
        // Validate input data
        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'jumlah' => 'required|integer',
            'kategori' => 'required',
            'lokasi' => 'required',
        ])) {
            // If validation fails, return to the create form with errors
            return redirect()->to('/barang/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get input data
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $this->request->getPost('kategori'),
            'lokasi' => $this->request->getPost('lokasi'),
        ];

        // Insert data into the database
        $this->barangModel->save($data);

        return redirect()->to('/barang')->with('message', 'Barang berhasil ditambahkan!');

    }

    // Menampilkan form untuk mengedit barang
    public function edit($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang dengan ID $id tidak ditemukan.");
        }

        $data = ['barang' => $barang];

        return view('barang/edit', $data);
    }

    // Memperbarui data barang di database
    public function update($id)
    {
        // Validate input data
        if (!$this->validate([
            'nama' => 'required|min_length[3]',
            'jumlah' => 'required|integer',
            'kategori' => 'required',
            'lokasi' => 'required',
        ])) {
            return redirect()->to('/barang/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get input data
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'kategori' => $this->request->getPost('kategori'),
            'lokasi' => $this->request->getPost('lokasi'),
        ];

        // Update the Barang data in the database
        $this->barangModel->update($id, $data);

        // Redirect to the list page with success message
        return redirect()->to('/barang')->with('success', 'Barang updated successfully!');
    }
    
    public function delete($id)
    {
        try {
            $barang = $this->barangModel->find($id);
            
            if (!$barang) {
                return redirect()->to('/barang')
                    ->with('message', 'Barang tidak ditemukan')
                    ->with('type', 'danger');
            }
            
            $this->barangModel->delete($id);
            return redirect()->to('/barang')
                ->with('message', 'Barang berhasil dihapus')
                ->with('type', 'success');
                
        } catch (\Exception $e) {
            return redirect()->to('/barang')
                ->with('message', 'Terjadi kesalahan saat menghapus data')
                ->with('type', 'danger');
        }
    }
    
    public function search()
    {
        $kategori = $this->request->getGet('kategori');
        $lokasi = $this->request->getGet('lokasi');
        
        if (empty($kategori) && empty($lokasi)) {
            return redirect()->to('/barang');
        }
        
        try {
            if ($kategori) {
                $data['barang'] = $this->barangModel->searchByCategory($kategori);
            } elseif ($lokasi) {
                $data['barang'] = $this->barangModel->searchByLocation($lokasi);
            }
            
            if (empty($data['barang'])) {
                $this->session->setFlashdata('message', 'Data tidak ditemukan');
                $this->session->setFlashdata('type', 'warning');
            }
            
            return view('barang/index', $data);
            
        } catch (\Exception $e) {
            return redirect()->to('/barang')
                ->with('message', 'Terjadi kesalahan saat mencari data')
                ->with('type', 'danger');
        }
    }
    
    public function exportCsv()
    {
        try {
            $barang = $this->barangModel->findAll();
            
            if (empty($barang)) {
                return redirect()->to('/barang')
                    ->with('message', 'Tidak ada data untuk di-export')
                    ->with('type', 'warning');
            }
            
            // Bersihkan output buffer untuk menghindari konten tambahan
            ob_clean();
    
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="daftar_barang_' . date('Y-m-d') . '.csv"');
    
            $output = fopen('php://output', 'w');
    
            // Header CSV
            fputcsv($output, ['ID', 'Nama', 'Jumlah', 'Kategori', 'Lokasi', 'Created At', 'Updated At']);
    
            // Data barang
            foreach ($barang as $item) {
                fputcsv($output, $item);
            }
    
            fclose($output);
    
            // Hentikan eksekusi setelah file CSV dibuat
            exit();
        } catch (\Exception $e) {
            return redirect()->to('/barang')
                ->with('message', 'Terjadi kesalahan saat export data')
                ->with('type', 'danger');
        }
    }
    
}