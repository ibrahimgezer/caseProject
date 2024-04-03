<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    public function loginPage(): string
    {
        $data['title'] = 'Giriş Yap';
        return view('pages/auth/login', $data);
    }

    public function login()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'E-Posta adresi alanını doldurmanız zorunludur.',
                    'valid_email' => 'Girdiğiniz mail adresi e-posta formatında olmalıdır.',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Şifre alanını doldurmanız zorunludur.',
                ]
            ]
        ]);

        if (!$validation) {
            return view('pages/auth/login', ['validation' => $this->validator]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user_info = $this->userModel->where(['email' => $email, 'password' => base64_encode($password),])->first();
            if ($user_info != null) {
                session()->set('loggedUser', $user_info);
                session()->set('isLoggedIn', 1);
                session()->setFlashdata('login_successful', 'Hoşgeldiniz');
                return redirect()->to('/')->withInput();
            } else {
                session()->setFlashdata('login_failed', "E-posta adresinizin veya şifrenizin doğru olduğundan emin olun.");
                return redirect()->to('/login')->withInput();
            }
        }
    }

    public function logout(): RedirectResponse
    {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            session()->remove('isLoggedIn');
            return redirect()->to('/login')->with('login_successful', "Hesabınızdan Güvenli Bir Şekilde Çıkış Yapıldı.");
        } else {
            return redirect()->to('/');
        }
    }
}
