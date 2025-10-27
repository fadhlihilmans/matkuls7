<?php
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelMahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $allowedFields = ['nim', 'nama','prodi', 'kelas'];
	protected $useTimestamps = false;

    public function findById($nim)
    {
        $data = $this->find($nim);
        if($data)
        {
            return $data;
        }
        return false;
    }
}