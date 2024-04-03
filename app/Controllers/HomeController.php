<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Ana Sayfa';
        $data['usersCount'] = $this->userModel->countAll();
        $data['categoriesCount'] = $this->categoryModel->countAll();
        $data['brandsCount'] = $this->brandModel->countAll();
        $data['lastCategories'] = $this->categoryModel->orderBy('id', 'DESC')->limit(5)->findAll();
        $data['lastBrands'] = $this->brandModel->orderBy('id', 'DESC')->limit(5)->findAll();
        return view('pages/home/index', $data);
    }
}
