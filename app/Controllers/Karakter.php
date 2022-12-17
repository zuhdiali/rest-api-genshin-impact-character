<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\KarakterModel;

class Karakter extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new KarakterModel();
    }

    public function index()
    {
        // $header = $this->request->getServer('HTTP_AUTHORIZATION');
        // if (!$header) return $this->failUnauthorized('Token Required');

        $data = $this->model->getKarakter();
        return $this->respond($data, 200);
    }

    public function create()
    {
        // $data = [
        //     'nama' => $this->request->getVar('nama'),
        //     'email' => $this->request->getVar('email')
        // ];
        // $this->model->save($data);
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[karakter.nama]',
                'errors' => [
                    // 'required' => '{field} karakter harus diisi',
                    'required' => 'Name character is required',
                    'is_unique' => 'Name character already exist'
                ]
            ],
            'asal' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Origin field is required'
                ]
            ],
            'vision' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Vision field is required'
                ]
            ],
            'senjata' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Weapon field is required'
                ]
            ],
            'rarity' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Rarity field is required'
                ]
            ],
            'deskripsi' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Description field is required'
                ]
            ],
            // 'avatar_url' => 'required',
            // 'card_url' => 'required',
            'avatar_img' => [
                'rules' => 'uploaded[avatar_img]|max_size[avatar_img,1024]|is_image[avatar_img]|mime_in[avatar_img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Avatar image is required',
                    'max_size' => 'Avatar image size it too big',
                    'is_image' => 'Please choose avatar image correctly',
                    'mime_in' => "Please choose avatar image correctly"
                ]
            ],
            'card_img' => [
                'rules' => 'uploaded[card_img]|max_size[card_img,1024]|is_image[card_img]',
                'errors' => [
                    'uploaded' => 'Card image is required',
                    'max_size' => 'Card image size is too big',
                    'is_image' => 'Please choose card image correctly'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return $this->fail($this->validator->getErrors());
        }
        
        // menangkap gambar
        $avatar_img = $this->request->getFile('avatar_img');
        $card_img = $this->request->getFile('card_img');

        // pindah ke folder img
        $avatar_img->move('img/avatar');
        $card_img->move('img/card');

        // ambil nama file sampul
        $nama_file_avatar = $avatar_img->getName();
        $nama_file_card = $card_img->getName();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'slug' => url_title($this->request->getPost('nama'), '-', true),
            'asal' => $this->request->getPost('asal'),
            'vision' => $this->request->getPost('vision'),
            'senjata' => $this->request->getPost('senjata'),
            'rarity' => $this->request->getPost('rarity'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            // 'avatar_url' => $this->request->getPost('avatar_url'),
            // 'card_url' => $this->request->getPost('card_url'),
            'avatar_img' => $nama_file_avatar,
            'card_img' => $nama_file_card
        ];
        // $this->request->getPost();
        $this->model->save($data);
        // if (!$this->model->save($data)) {
        //     return $this->fail($this->model->errors());
        // }
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Berhasil menambahkan karakter baru.'
            ]
        ];
        return $this->respond($response);
    }

    public function show($slug = null)
    {
        $data = $this->model->getKarakter($slug);
        if (!empty($data)) {
            $response = [
                'status' => 200,
                'content' => $data
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound("Karakter dengan nama $slug tidak ditemukan.");
        }
    }

    public function update($id)
    {
        helper(['form']);
        $isExist = $this->model->getKarakterById($id);
        // return $this->respond($isExist['nama']);
        if ($isExist['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[karakter.nama]';
        }

        if($file_avatar = $this->request->getFile('avatar_img')){
            $rule_avatar = 'max_size[avatar_img,1024]|is_image[avatar_img]|mime_in[avatar_img,image/jpg,image/jpeg,image/png]';
        } else{
            $rule_avatar = '';
        }

        if($file_card = $this->request->getFile('card_img')){
            $rule_card = 'max_size[card_img,1024]|is_image[card_img]';
        } else{
            $rule_card = '';
        }

        // MUNGKIN COBA BIKIN BEBERAPA VALIDATE, JANGAN HANYA SATU
        // VALIDATE KETIKA GA ADA GAMBAR YANG DIKIRIM, BAIK SATU GAMBAR MAUPUN DUA GAMBAR
        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} karakter harus diisi',
                    'is_unique' => '{field} karakter sudah ada'
                ]
            ],
            'asal' => 'required',
            'vision' => 'required',
            'senjata' => 'required',
            'rarity' => 'required',
            'deskripsi' => 'required',
            // 'avatar_url' => 'required',
            // 'card_url' => 'required',
            'avatar_img' => [
                'rules' => $rule_avatar,
                'errors' => [
                    'max_size' => 'Avatar image size is too big',
                    'is_image' => 'Please choose avatar image correctly',
                    'mime_in' => "Please choose avatar image correctly"
                ]
            ],
            'card_img' => [
                'rules' => $rule_card,
                'errors' => [
                    'max_size' => 'Card image size is too big',
                    'is_image' => 'Please choose card image correctly'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/edit' . $this->request->getVar('slug')); //->withInput()->with('validation', $validation);
            // if (!$this->model->save($data)) { // kalau ada error saat menyimpan
            
                return $this->fail($this->model->errors());
            // }
        }
        
        $data = $this->model->getKarakterById($id);
        if($rule_avatar==''){
            $nama_file_avatar = $file_avatar->getName();
            unlink('img/avatar/'.$data['avatar_img']);
            $file_avatar->move('img/avatar');
            if ($rule_card!=''){
                $nama_file_card = $file_card->getName();
                unlink('img/card/'.$data['card_img']);
                $file_card->move('img/card');
            }
            else{
                $nama_file_card = $data['card_img'];
            }
        }else{
            $nama_file_avatar = $data['avatar_img'];
            if ($rule_card!=''){
                $nama_file_card = $file_card->getName();
                unlink('img/card/'.$data['card_img']);
                $file_card->move('img/card');
            }
            else{
                $nama_file_card = $data['card_img'];
            }
        }

        // $data = $this->request->getRawInput();
        // $this->model->save($data);
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->model->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            $slug => $slug,
            'asal' => $this->request->getPost('asal'),
            'vision' => $this->request->getPost('vision'),
            'senjata' => $this->request->getPost('senjata'),
            'rarity' => $this->request->getPost('rarity'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            // 'avatar_url' => $this->request->getPost('avatar_url'),
            // 'card_url' => $this->request->getPost('card_url'),
            'avatar_img' => $nama_file_avatar,
            'card_img' => $nama_file_card
        ]);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => "Berhasil mengubah karakter dengan nama $slug."
            ]
        ];
        return $this->respond($response);

        // $data['slug'] = $slug;
        // $isExist = $this->model->where('slug', $slug)->findAll();
        // if (!$isExist) {
        //     return $this->failNotFound("Karakter dengan nama $slug tidak ditemukan.");
        // }

        // if (!$this->model->save($data)) { // kalau ada error saat menyimpan
        //     return $this->fail($this->model->errors());
        // }


    }

    public function delete($id)
    {
        // $this->komikModel->delete($id);
        // session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        // return redirect()->to('/komik');
        
        $data = $this->model->getKarakterById($id);
        if ($data) {
            unlink('img/avatar/'.$data['avatar_img']);
            unlink('img/card/'.$data['card_img']);
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Karakter berhasil dihapus"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Karakter tidak ditemukan.");
        }
    }
}
