<?php
namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ModelPegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip', 'nama', 'dinas', 'jabatan'];
	protected $useTimestamps = false;

    public function findById($nip)
    {
        $data = $this->find($nip);
        if($data)
        {
            return $data;
        }
        return false;
    }
}