<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $router = service('router');
        $controllerName = explode("\\", $router->controllerName());
        $controllerName = $controllerName[count($controllerName) - 1];
        $methodName = $router->methodName();
        if (!session()->get('isLoggedIn') && ($controllerName != "AuthController" && ($methodName != "login" || $methodName != "loginPage"))) {
            return redirect()->to(base_url('/login'));
        }

        if ($controllerName == "AuthController" && ($methodName == "login" || $methodName == "loginPage") && session()->get('isLoggedIn')){
            return redirect()->to(base_url());
        }

        if (session()->get('isLoggedIn')) {
            $userModel = model("UserModel");
            $userID = session()->get('loggedUser')["id"];
            $user = $userModel->find($userID);
            $auths = json_decode($user['auths'], true);
            if ($controllerName == "CategoryController" || $controllerName == "BrandController") {
               if($methodName != "index"){
                    $permissionKey = strtolower($methodName);
                    if (isset($auths[$permissionKey]) && $auths[$permissionKey] == 1) {
                        return true;
                    } else {
                        $currentURL = $_SERVER["HTTP_REFERER"];
                        session()->setFlashdata('permission_failed', 'Üzgünüm, bu isteğiniz gerçekleştirilemedi! Bu işlemi yapmaya yetkiniz bulunmamaktadır.');
                        return redirect()->to($currentURL)->withInput();
                    }
                }

            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}