<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Warga extends BaseController
{
    /*model*/
    protected $ModelWarga;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\ModelWarga();
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
		$nik = $this->request->getPost('nik');
		$nama = $this->request->getPost('nama');
		$jeniskelamin = $this->request->getPost('jeniskelamin');
		$alamat = $this->request->getPost('alamat');
		
        $data = [
			'nik' => $nik,
            'nama' => $nama,
            'jeniskelamin' => $jeniskelamin,
            'alamat' => $alamat
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
	public function update($nik = null)
    {
        $data = $this->request->getRawInput();
        $data['nik'] = $nik;
        
        if(!$this->mdl->findById($nik))
        {
            return $this->fail('kode tidak ditemukan');
        }

		$this->mdl->update($nik, $data);
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