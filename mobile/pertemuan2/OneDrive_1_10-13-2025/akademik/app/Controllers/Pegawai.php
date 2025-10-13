<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Pegawai extends BaseController
{
    /*model*/
    protected $ModelPegawai;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\ModelPegawai();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = $this->mdl->findAll();
        return $this->respond($data, 200);
    }

	// create a data
    public function create()
    {
		$nip = $this->request->getPost('nip');
		$nama = $this->request->getPost('nama');
		$dinas = $this->request->getPost('dinas');
		$jabatan = $this->request->getPost('jabatan');
		
        $data = [
			'nip' => $nip,
            'nama' => $nama,
            'dinas' => $dinas,
            'jabatan' => $jabatan
        ];
		
        $this->mdl->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($data, 201);
    }

	// update a data
	public function update($nip = null)
    {
        $data = $this->request->getRawInput();
        $data['nip'] = $nip;
        
        if(!$this->mdl->findById($nip))
        {
            return $this->fail('kode tidak ditemukan');
        }

		$this->mdl->update($nip, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

}