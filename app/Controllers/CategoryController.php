<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use Config\Database;
use Exception;

class CategoryController extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Kategoriler';
        $data['categoriesCount'] = $this->categoryModel->countAll();
        $data['categories'] = $this->categoryModel->findAll();
        return view('pages/categories/index', $data);
    }

    public function category_add_page(): string
    {
        $data['title'] = 'Kategori Ekle';
        return view('pages/categories/add', $data);
    }

    public function category_edit_page($id): string
    {
        $data['title'] = 'Kategori Düzenle';
        $data["categoryData"] = $this->categoryModel->where(['id' => $id])->first();
        return view('pages/categories/edit', $data);
    }

    public function category_create()
    {
        try {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori Adı" alanını doldurmanız zorunludur.',
                    ]
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori Açıklaması" alanını doldurmanız zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                return view('pages/categories/add', ['validation' => $this->validator]);
            } else {
                $values = [
                    "name" => $this->request->getPost('name'),
                    "description" => $this->request->getPost('description'),
                ];
                $insertQuery = $this->categoryModel->insert($values);
                if ($insertQuery) {
                    $savePath = FCPATH . "public/images/category/";
                    $image = $this->request->getFile('image');
                    $imageName = uploadMedia($image, $savePath);
                    $insertedID = $this->categoryModel->getInsertID();
                    $this->categoryModel->where('id', $insertedID)->set(["image" => $imageName])->update();
                    session()->setFlashdata('category_add_success', 'Kategori Başarıyla Eklendi.');
                } else {
                    session()->setFlashdata('category_add_failed', 'Kategori Eklenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/category_add')->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function category_update($categoryID)
    {
        try {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori Adı" alanını doldurmanız zorunludur.',
                    ]
                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '"Kategori Açıklaması" alanını doldurmanız zorunludur.',
                    ]
                ]
            ]);
            if (!$validation) {
                $data["categoryData"] = $this->categoryModel->where(['id' => $categoryID])->first();
                $data["validation"] = $this->validator;
                return view('pages/categories/edit', $data);
            } else {
                $categoryData = $this->categoryModel->where('id', $categoryID)->first();
                $savePath = FCPATH . "public/images/category/";
                $image = $this->request->getFile('image');
                $imageName = uploadMedia($image, $savePath, $categoryData["image"]);
                $values = [
                    "name" => $this->request->getPost('name'),
                    "description" => $this->request->getPost('description'),
                    "category_id" => $this->request->getPost('category_id'),
                    "image" => $imageName,
                    "updated_at" => date("Y-m-d H:i:s", time())
                ];
                $updateQuery = $this->categoryModel->where('id', $categoryID)->set($values)->update();
                if ($updateQuery) {
                    session()->setFlashdata('category_edit_success', 'Kategori Başarıyla Güncellendi.');
                } else {
                    session()->setFlashdata('category_edit_failed', 'Kategori Güncellenirken Bir Hata Oluştu.');
                }
                return redirect()->to('/category_edit/' . $categoryID)->withInput();
            }
        } catch (Exception $e) {
            echo 'Hata: ' . $e->getMessage();
        }
    }

    public function category_delete($categoryID): RedirectResponse
    {
        $db = Database::connect();
        $savePath = FCPATH . "public/images/category/";
        $categoryData = $this->categoryModel->where('id', $categoryID)->first();
        $deleteQuery = $this->categoryModel->delete($categoryID);
        if ($deleteQuery) {
            session()->setFlashdata('category_delete_success', 'Kategori Başarıyla Silindi.');
            deleteMedia($savePath, $categoryData["image"]);
            $db->query("DELETE FROM brands WHERE category_id = '$categoryID'");
        } else {
            session()->setFlashdata('category_delete_failed', 'Kategori Silinirken Bir Sorun Oluştu.');
        }
        return redirect()->to('/categories')->withInput();
    }

}
