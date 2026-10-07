<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('users', $data);
    }

    public function new()
    {
        return view('user_form');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required',
            'password'  => 'required|min_length[6]'
        ];

        if (! $this->validate($rules)) {
            return view('user_form', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        return view('user_form', [
            'user' => $userModel->find($id)
        ]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        $file = $this->request->getFile('avatar');

        if ($file && $file->isValid()) {
            $rules = [
                'avatar' => [
                    'uploaded[avatar]',
                    'max_size[avatar,2048]',
                    'mime_in[avatar,image/png,image/jpeg]'
                ]
            ];
        }

        $avatarName = $user['avatar'];

        if ($file->isValid()) {
            $avatarName = $file->getRandomName();

            $file->move(
                ROOTPATH . 'public/uploads',
                $avatarName
            );

            service('image')
                ->withFile(ROOTPATH . 'public/uploads/' . $avatarName)
                ->fit(150, 150, 'center')
                ->save(ROOTPATH . 'public/uploads/thumbs/' . $avatarName);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'avatar' => $avatarName
        ];

        $password = $this->request->getPost('password');

        if (!empty($password)) {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }
}
