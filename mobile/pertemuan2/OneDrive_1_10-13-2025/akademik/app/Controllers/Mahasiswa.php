<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Mahasiswa extends BaseController
{
    /*model*/
    protected $ModelMahasiswa;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\ModelMahasiswa();
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = $this->mdl->findAll();
        return $this->respond($data, 200);
    }

	// get single show
    public function show($nim = null)
    {
        $data = $this->mdl->findById($nim);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with nim '.$nim);
        }
    }

	// create a data
    public function create()
    {
		$nim = $this->request->getPost('nim');
		$nama = $this->request->getPost('nama');
		$prodi = $this->request->getPost('prodi');
        $data = [
			'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi
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
	public function update($nim = null)
    {
        $data = $this->request->getRawInput();
        $data['nim'] = $nim;
        
        if(!$this->mdl->findById($nim))
        {
            return $this->fail('nim tidak ditemukan');
        }

		$this->mdl->update($nim, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

	// delete a data
    public function delete($nim = null)
    {
        if(!$this->mdl->findById($nim))
        {
            return $this->fail('nim tidak ditemukan');
        }

        if($this->mdl->delete($nim)){
            return $this->respondDeleted(['nim'=>$nim.' Deleted']);
        }
    }
}