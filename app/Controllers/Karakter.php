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
        $data = $this->model->getKarakter();
        return $this->respond($data, 200);
    }

    public function create()
    {
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
                'rules' => 'required',
                'errors' => [
                    'required' => 'Origin field is required'
                ]
            ],
            'vision' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vision field is required'
                ]
            ],
            'senjata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Weapon field is required'
                ]
            ],
            'rarity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rarity field is required'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description field is required'
                ]
            ],
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
            'avatar_img' => $nama_file_avatar,
            'card_img' => $nama_file_card
        ];

        $this->model->save($data);

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
        if ($isExist['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[karakter.nama]';
        }
        $rules = [];

        if ($file_avatar = $this->request->getFile('avatar_img')) {
            if ($file_card = $this->request->getFile('card_img')) { // rule jika ada avatar dan card yang dikirim
                $rule_card = 'max_size[card_img,1024]|is_image[card_img]';
                $rules = [
                    'nama' => [
                        'rules' => $rule_nama,
                        'errors' => [
                            'required' => 'Name character is required',
                            'is_unique' => 'Name character already exist'
                        ]
                    ],
                    'asal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Origin field is required'
                        ]
                    ],
                    'vision' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Vision field is required'
                        ]
                    ],
                    'senjata' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Weapon field is required'
                        ]
                    ],
                    'rarity' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Rarity field is required'
                        ]
                    ],
                    'deskripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Description field is required'
                        ]
                    ],
                    'avatar_img' => [
                        'rules' => 'max_size[avatar_img,1024]|is_image[avatar_img]|mime_in[avatar_img,image/jpg,image/jpeg,image/png]',
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
                ];
            } else { // rule jika hanya avatar yang dikirim
                $rules = [
                    'nama' => [
                        'rules' => $rule_nama,
                        'errors' => [
                            'required' => 'Name character is required',
                            'is_unique' => 'Name character already exist'
                        ]
                    ],
                    'asal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Origin field is required'
                        ]
                    ],
                    'vision' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Vision field is required'
                        ]
                    ],
                    'senjata' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Weapon field is required'
                        ]
                    ],
                    'rarity' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Rarity field is required'
                        ]
                    ],
                    'deskripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Description field is required'
                        ]
                    ],
                    'avatar_img' => [
                        'rules' => 'max_size[avatar_img,1024]|is_image[avatar_img]|mime_in[avatar_img,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Avatar image size is too big',
                            'is_image' => 'Please choose avatar image correctly',
                            'mime_in' => "Please choose avatar image correctly"
                        ]
                    ]
                ];
            }
        } else {
            if ($file_card = $this->request->getFile('card_img')) { // rule jika hanya card yang dikirim
                $rule_card = 'max_size[card_img,1024]|is_image[card_img]';
                $rules = [
                    'nama' => [
                        'rules' => $rule_nama,
                        'errors' => [
                            'required' => 'Name character is required',
                            'is_unique' => 'Name character already exist'
                        ]
                    ],
                    'asal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Origin field is required'
                        ]
                    ],
                    'vision' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Vision field is required'
                        ]
                    ],
                    'senjata' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Weapon field is required'
                        ]
                    ],
                    'rarity' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Rarity field is required'
                        ]
                    ],
                    'deskripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Description field is required'
                        ]
                    ],
                    'card_img' => [
                        'rules' => $rule_card,
                        'errors' => [
                            'max_size' => 'Card image size is too big',
                            'is_image' => 'Please choose card image correctly'
                        ]
                    ]
                ];
            } else { // rule jika ga ada gambar yang dikirim
                $rules = [
                    'nama' => [
                        'rules' => $rule_nama,
                        'errors' => [
                            'required' => 'Name character is required',
                            'is_unique' => 'Name character already exist'
                        ]
                    ],
                    'asal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Origin field is required'
                        ]
                    ],
                    'vision' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Vision field is required'
                        ]
                    ],
                    'senjata' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Weapon field is required'
                        ]
                    ],
                    'rarity' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Rarity field is required'
                        ]
                    ],
                    'deskripsi' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Description field is required'
                        ]
                    ],
                ];
            }
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = $this->model->getKarakterById($id);
        if ($file_avatar) {
            $nama_file_avatar = $file_avatar->getName();
            unlink('img/avatar/' . $data['avatar_img']);
            $file_avatar->move('img/avatar');
            if ($file_card) {
                unlink('img/card/' . $data['card_img']);
                $file_card->move('img/card');
                $nama_file_card = $file_card->getName();
            } else {
                $nama_file_card = $data['card_img'];
            }
        } else {
            $nama_file_avatar = $data['avatar_img'];
            if ($file_card) {
                unlink('img/card/' . $data['card_img']);
                $file_card->move('img/card');
                $nama_file_card = $file_card->getName();
            } else {
                $nama_file_card = $data['card_img'];
            }
        }

        $nama_baru = $this->request->getVar('nama');
        $slug = url_title($nama_baru, '-', true);
        $this->model->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'asal' => $this->request->getPost('asal'),
            'vision' => $this->request->getPost('vision'),
            'senjata' => $this->request->getPost('senjata'),
            'rarity' => $this->request->getPost('rarity'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'avatar_img' => $nama_file_avatar,
            'card_img' => $nama_file_card
        ]);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => "Success editing character: $nama_baru."
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id)
    {
        $data = $this->model->getKarakterById($id);
        if ($data) {
            unlink('img/avatar/' . $data['avatar_img']);
            unlink('img/card/' . $data['card_img']);
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
