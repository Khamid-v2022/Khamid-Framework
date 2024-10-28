<?php
namespace Khamid\Framework\Controllers;
require_once __DIR__ . '/../Core/BaseController.php';

use Khamid\Framework\Models\User;
use Khamid\Framework\Core\BaseController; 

class UserController extends BaseController {
    public function index() {
        $userModel = new User();
        $users = $userModel->get(array('name' => 'Khamid', 'email' => 'khamid.webdev@gmail.com'));

        $header_data['title'] = "User List";

        $this->view('common/header', ['h_data' => $header_data]);
        $this->view('user/index', ['users' => $users]);
        $this->view('common/footer');
    }

    public function create() {
        echo "Create";
    }
}