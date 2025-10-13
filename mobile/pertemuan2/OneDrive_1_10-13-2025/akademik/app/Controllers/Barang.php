<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Barang extends BaseController
{
    /*model*/
    protected $ModelBarang;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\ModelBarang();
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
		$kode = $this->request->getPost('kode');
		$nama = $this->request->getPost('nama');
		$harga = $this->request->getPost('harga');
		$spesifikasi = $this->request->getPost('spesifikasi');
		$merk = $this->request->getPost('merk');
		
        $data = [
			'kode' => $kode,
            'nama' => $nama,
            'harga' => $harga,
            'spesifikasi' => $spesifikasi,
            'merk' => $merk
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
	public function update($kode = null)
    {
        $data = $this->request->getRawInput();
        $data['kode'] = $kode;
        
        if(!$this->mdl->findById($kode))
        {
            return $this->fail('kode tidak ditemukan');
        }

		$this->mdl->update($kode, $data);
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