<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected RequestInterface $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected array $helpers = [
        "icons", "form", "url", "admin", "frontend", "date", "text", "cookie", "html"
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $userInfo;
    protected $controllerName;
    protected $methodName;
    /**
     * @var array
     */

    protected array $getSiteSettings;
    protected array $cartData;
    protected array $getFooterContents;
    protected array $getFooterFastAccess;
    protected array $getAllCategories;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function __construct()
    {
        parent::__construct();
        // Check if user is logged in
        if (session()->has('LoggedUser')) {
            $loggedUserID = session()->get('LoggedUser');
            $usersModel = model("UserModel");
            $this->userInfo = $usersModel->find($loggedUserID);
        }
        $categoriesModel = model("CategoriesModel");
        $this->getAllCategories = $categoriesModel->getAllCategories();
        $pagesModel = model("PagesModel");
        $this->getFooterContents = $pagesModel->getFooterContents();
        $this->getFooterFastAccess = $pagesModel->getFooterFastAccess();
        $GeneralSettingsModel = model("GeneralSettingsModel");
        $this->getSiteSettings = $GeneralSettingsModel->where('id', 1)->first();
        $this->controllerName = service('router')->controllerName();
        $this->methodName = service('router')->methodName();
        $this->cartData = session()->get('cartData') ?: [];

    }

    /**
     * Render a view file.
     *
     * @param string $view
     * @param array $data
     */

    protected function header_render(string $view, array $data = [])
    {
        $data['userInfo'] = $this->userInfo;
        $data['getAllCategories'] = $this->getAllCategories;
        $data['getSiteSettings'] = $this->getSiteSettings;
        echo view($view, $data);
    }

    protected function footer_render(string $view, array $data = [])
    {
        $data['getSiteSettings'] = $this->getSiteSettings;
        $data['getFooterContents'] = $this->getFooterContents;
        $data['getFooterFastAccess'] = $this->getFooterFastAccess;
        echo view($view, $data);
    }
}
