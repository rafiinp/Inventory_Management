<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jumlah', 'kategori', 'lokasi'];
    protected $useTimestamps = true;
    
    public function searchByCategory($kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }
    
    public function searchByLocation($lokasi) 
    {
        return $this->where('lokasi', $lokasi)->findAll();
    }
}