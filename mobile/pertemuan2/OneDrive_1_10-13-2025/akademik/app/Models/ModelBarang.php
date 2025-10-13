<?php
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelBarang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode';
    protected $allowedFields = ['kode', 'nama', 'harga', 'spesifikasi', 'merk'];
	protected $useTimestamps = false;

    public function findById($kode)
    {
        $data = $this->find($kode);
        if($data)
        {
            return $data;
        }
        return false;
    }
}