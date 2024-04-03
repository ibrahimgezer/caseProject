<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class UserController extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Kullanıcılar';
        $data['usersCount'] = $this->userModel->countAll();
        $data['users'] = $this->userModel->findAll();
        return view('pages/users/index', $data);
    }

    public function user_add_page(): string
    {
        $data['title'] = 'Kullanıcı Ekle';
        return view('pages/users/add', $data);
    }

    public function user_edit_page($id): string
    {
        $data['title'] = 'Kullanıcı Düzenle';
        $data["userData"] = $this->userModel->where(['id' => $id])->first();
        return view('pages/users/edit', $data);
    }

    public function user_create()
    {
        try {
            $validation = $this->validate([
                'name_surname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Ad Soyad" alanını doldurmanız zorunludur.',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '"E-Posta" adresi alanını doldurmanız zorunludur.',
                        'valid_email' => 'Girdiğiniz "E-Posta" adresi e-posta formatında olmalıdır.',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Şifre" alanını doldurmanız zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                $data['title'] = 'Kullanıcı Ekle';
                $data['validation'] = $this->validator;
                return view('pages/users/add', $data);
            } else {
                $auths = $this->authsArray();
                $values = [
                    "name_surname" => $this->request->getPost('name_surname'),
                    "email" => $this->request->getPost('email'),
                    "password" => base64_encode($this->request->getPost('password')),
                    "auths" => json_encode($auths),
                ];
                $insertQuery = $this->userModel->insert($values);
                if ($insertQuery) {
                    session()->setFlashdata('user_add_success', 'Kullanıcı Başarıyla Eklendi.');
                } else {
                    session()->setFlashdata('user_add_failed', 'Kullanıcı Eklenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/user_add')->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function user_update($userID)
    {
        try {
            $validation = $this->validate([
                'name_surname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Ad Soyad" alanını doldurmanız zorunludur.',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '"E-Posta" adresi alanını doldurmanız zorunludur.',
                        'valid_email' => 'Girdiğiniz "E-Posta" adresi e-posta formatında olmalıdır.',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Şifre" alanını doldurmanız zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                $data['title'] = 'Kullanıcı Düzenle';
                $data["userData"] = $this->userModel->where(['id' => $userID])->first();
                $data['validation'] = $this->validator;
                return view('pages/users/edit', $data);
            } else {
                $auths = $this->authsArray();
                $values = [
                    "name_surname" => $this->request->getPost('name_surname'),
                    "email" => $this->request->getPost('email'),
                    "password" => base64_encode($this->request->getPost('password')),
                    "auths" => json_encode($auths),
                    "updated_at" => date("Y-m-d H:i:s", time())
                ];
                $updateQuery = $this->userModel->where('id', $userID)->set($values)->update();
                if ($updateQuery) {
                    session()->setFlashdata('user_edit_success', 'Kullanıcı Başarıyla Güncellendi.');
                } else {
                    session()->setFlashdata('user_edit_failed', 'Kullanıcı Güncellenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/user_edit/' . $userID)->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function user_delete($userID): RedirectResponse
    {
        $deleteQuery = $this->userModel->delete($userID);
        if ($deleteQuery) {
            session()->setFlashdata('user_delete_success', 'Kullanıcı Başarıyla Silindi.');
        } else {
            session()->setFlashdata('user_delete_failed', 'Kullanıcı Silinirken Bir Sorun Oluştu.');
        }
        return redirect()->to('/users')->withInput();
    }

    public function authsArray(): array
    {
        return [
            "category_add_page" => $this->request->getPost("category_add"),
            "category_create" => $this->request->getPost("category_add"),
            "category_edit_page" => $this->request->getPost("category_edit"),
            "category_update" => $this->request->getPost("category_edit"),
            "category_delete" => $this->request->getPost("category_delete"),
            "brand_add_page" => $this->request->getPost("brand_add"),
            "brand_create" => $this->request->getPost("brand_add"),
            "brand_edit_page" => $this->request->getPost("brand_edit"),
            "brand_update" => $this->request->getPost("brand_edit"),
            "brand_delete" => $this->request->getPost("brand_delete"),
        ];
    }
}
