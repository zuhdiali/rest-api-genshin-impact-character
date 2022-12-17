<?php

namespace App\Models;

use CodeIgniter\Model;

class KarakterModel extends Model
{
    protected $table = "karakter";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'slug', 'asal', 'vision', 'senjata', 'rarity', 'deskripsi', 'avatar_url', 'card_url', 'avatar_img', 'card_img'];

    public function getKarakter($slug = false)
    {
        if ($slug) {
            return $this->where(['slug' => $slug])->first();
        } else {
            return $this->orderBy('nama', 'asc')->findAll();
        }
    }

    public function getKarakterById($id)
    {
        return $this->where(['id' => $id])->first();
    }
    // protected $validationRules = [
    //     'nama' => 'required|is_unique[karakter.nama]',
    //     'asal' => 'required',
    //     'vision' => 'required',
    //     'deskripsi' => 'required'
    // ];

    // protected $validationMessages = [
    //     'nama' => [
    //         'required' => 'Silahkan masukkan nama karakter.',
    //         'is_unique' => 'Karakter {field} sudah ada.'
    //     ],
    //     'asal' => [
    //         'required' => 'Silahkan pilih asal karakter.',
    //     ],
    //     'vision' => [
    //         'required' => 'Silahkan pilih vision karakter.'
    //     ],
    //     'deskripsi' => [
    //         'required' => 'Silahkan masukkan deskirpsi karakter'
    //     ]
    // ];
}
