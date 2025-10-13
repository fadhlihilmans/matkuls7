<?php
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelWarga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'nik';
    protected $allowedFields = ['nik', 'nama', 'jeniskelamin', 'alamat'];
	protected $useTimestamps = false;

    public function findById($nik)
    {
        $data = $this->find($nik);
        if($data)
        {
            return $data;
        }
        return false;
    }
}