<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use Config\Database;
use Exception;

class BrandController extends BaseController
{

    public function index(): string
    {
        $db = Database::connect();
        $data['title'] = 'Markalar';
        $data['brandsCount'] = $this->brandModel->countAll();
        $data["brands"] = $db->query("SELECT brands.*, categories.name AS category_name FROM brands INNER JOIN categories ON brands.category_id = categories.id")->getResultArray();
        return view('pages/brands/index', $data);
    }

    public function brand_add_page(): string
    {
        $data['title'] = 'Marka Ekle';
        $data['categories'] = $this->categoryModel->findAll();
        return view('pages/brands/add', $data);
    }

    public function brand_edit_page($brandID): string
    {
        $data['title'] = 'Marka Düzenle';
        $data["brandData"] = $this->brandModel->where(['id' => $brandID])->first();
        $data['categories'] = $this->categoryModel->findAll();
        return view('pages/brands/edit', $data);
    }

    public function brand_create()
    {
        try {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Marka Adı" alanını doldurmanız zorunludur.',
                    ]
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Marka Açıklaması" alanını doldurmanız zorunludur.',
                    ]
                ],
                'category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori" seçilmesi zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                $data['categories'] = $this->categoryModel->findAll();
                $data['validation'] = $this->validator;
                return view('pages/brands/add', $data);
            } else {
                $values = [
                    "name" => $this->request->getPost('name'),
                    "description" => $this->request->getPost('description'),
                    "category_id" => $this->request->getPost('category_id'),
                ];
                $insertQuery = $this->brandModel->insert($values);
                if ($insertQuery) {
                    session()->setFlashdata('brand_add_success', 'Marka Başarıyla Eklendi.');
                } else {
                    session()->setFlashdata('brand_add_failed', 'Marka Eklenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/brand_add')->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function brand_update($brandID)
    {
        try {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Marka Adı" alanını doldurmanız zorunludur.',
                    ]
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Marka Açıklaması" alanını doldurmanız zorunludur.',
                    ]
                ],
                'category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori" seçilmesi zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                $data["brandData"] = $this->brandModel->where(['id' => $brandID])->first();
                $data['categories'] = $this->categoryModel->findAll();
                $data['validation'] = $this->validator;
                return view('pages/brands/edit', $data);
            } else {
                $values = [
                    "name" => $this->request->getPost('name'),
                    "description" => $this->request->getPost('description'),
                    "category_id" => $this->request->getPost('category_id'),
                    "updated_at" => date("Y-m-d H:i:s", time())
                ];
                $updateQuery = $this->brandModel->where('id', $brandID)->set($values)->update();
                if ($updateQuery) {
                    session()->setFlashdata('brand_edit_success', 'Marka Başarıyla Güncellendi.');
                } else {
                    session()->setFlashdata('brand_edit_failed', 'Marka Güncellenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/brand_edit/' . $brandID)->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function brand_delete($brandID): RedirectResponse
    {
        $deleteQuery = $this->brandModel->delete($brandID);
        if ($deleteQuery) {
            session()->setFlashdata('brand_delete_success', 'Marka Başarıyla Silindi.');
        } else {
            session()->setFlashdata('brand_delete_failed', 'Marka Silinirken Bir Sorun Oluştu.');
        }
        return redirect()->to('/brands')->withInput();
    }

}
