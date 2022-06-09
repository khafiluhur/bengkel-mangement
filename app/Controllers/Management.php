<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\BaseController;

class Management extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->db = db_connect();
    }

    public function index()
    {
        //
    }

    public function user()
    {
        $users = $this->userModel->findAll();

        // Name Site
        $builder_name_site = $this->db->table("setting_sites");
        $builder_name_site->select('setting_sites.name_site');
        $name_sites = $builder_name_site->get()->getResult();

        $data = [
            'title' => 'Manajemen User',
            'name_site' => $name_sites[0]->name_site,
            'users' => $users,
            'type' => 'manajemenUser'
        ];
        return view('pages/management', $data);
    }

    public function createUser()
    {
        if (!$this->validate([
            'username' => [
            ],
            'name' => [
            ],
            'email' => [
            ],
            'password' => [
            ],
            'id_level' => [
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to(base_url('management_user'));
        }
        $users = new UsersModel();
        $users->insert([
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'email' => $this->request->getPost('email'),
            'id_level' => $this->request->getPost('id_level'),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => session()->get('username'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil ditambah');
        return redirect()->to(base_url('management_user'));
    }

    public function updateUser($id)
    {
        $items = new UsersModel();
        $items->update($id, [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'email' => $this->request->getPost('email'),
            'id_level' => $this->request->getPost('id_level'),
            'updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => session()->get('username')
        ]);
        session()->setFlashdata('success', 'Berhasil diupdate');
        return redirect()->to(base_url('management_user'));
    }

    public function deleteUser($id)
    {
        $items = new UsersModel();
        $items->delete($id);
        session()->setFlashdata('success', 'Berhasil dihapus');
        return redirect()->to(base_url('management_user'));
    }
}
