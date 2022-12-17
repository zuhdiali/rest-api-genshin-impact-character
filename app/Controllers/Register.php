<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Register extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        helper(['form']);
        $rules = [
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid',
                    'is_unique' => 'Email is already used'
                ]
            ],
            'nama_lengkap' => 'required',
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_unique' => 'Username is already used'
                ]
            ],
            'password' => 'required|min_length[6]',
            'confpassword' => 'matches[password]'
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'email'     => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => 'user',
        ];
        $model = new UserModel();
        $registered = $model->save($data);
        if ($registered) {
            $response = [
                'status' => 200,
                'messages' => "Register account success!!"
            ];
            return $this->respond($response);
        } else {
            return $this->respondCreated($registered);
        }
    }

    public function edit($id = null)
    {
        //
    }
}
