<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Me extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    function __construct()
    {
        $this->model = new UserModel();
    }
    public function index()
    {
        $key = getenv('TOKEN_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');
        if (!$header) return $this->failUnauthorized('Token Required');
        $token = explode(' ', $header)[1];

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $response = [
                'id' => $decoded->id,
                'email' => $decoded->email,
                'nama_lengkap' => $decoded->nama_lengkap,
                'username' => $decoded->username
            ];
            return $this->respond($response);
        } catch (\Throwable $th) {
            return $this->fail('Invalid Token');
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->model->getUserById($id);
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'content' => $data
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound("Karakter dengan id $id tidak ditemukan.");
        }
    }


    public function update($id = null)
    {
        $data = $this->model->getUserById($id);
        // $isExist = $this->model->getKarakter($this->request->getVar('slug'));
        // return $this->respond($isExist['nama']);
        if ($data['email'] == $this->request->getVar('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[users.email]';
        }
        if ($data['username'] == $this->request->getVar('username')) {
            $rule_username= 'required';
        } else {
            $rule_username = 'required|is_unique[users.username]';
        }
        if (!empty($data)) {
            helper(['form']);
            $rules = [
                'nama_lengkap' => [
                    'rules' =>'required',
                    'errors' => [
                        'required' => 'Full Name field is required'
                    ]
                ],
                'email' => [
                    'rules' => $rule_email,
                    'errors' => [
                        'required' => 'Email field is required',
                        'valid_email' => 'Email is not valid',
                        'is_unique' => 'Email is already used'
                    ]
                ],
                'username' => [
                    'rules' => $rule_username,
                    'errors' => [
                        'required' => 'Username is required',
                        'is_unique' => 'Username is already used'
                    ]
                ],
                'password_lama' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Old Password is Required',
                        'min_length' => 'The old password filed must be at least 6 characters in length'
                    ]
                ],
                'password_baru' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'New Password is Required',
                        'min_length' => 'The new password filed must be at least 6 characters in length'
                    ]
                ],
                'confpassword_baru' => [
                    'rules' => 'matches[password_baru]',
                    'errors' => [
                        'matches' => 'Confirm New Password field is not match with New Password field'
                    ]
                ]
            ];
            if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

            $verify = password_verify($this->request->getVar('password_lama'), $data['password']);
            if (!$verify) return $this->fail('Old Password is Wrong');

            $data = [
                'id'     => $id,
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'password'  => password_hash($this->request->getVar('password_baru'), PASSWORD_BCRYPT),
                'role' => $data['role']
            ];
            $model = new UserModel();
            $registered = $model->save($data);
            if ($registered) {
                $response = [
                    'status' => 200,
                    'messages' => "Akun berhasil diupdate!"
                ];
                return $this->respond($response);
            } else {
                return $this->respondCreated($registered);
            }
        } else {
            return $this->failNotFound("Karakter dengan id $id tidak ditemukan.");
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
