<?php
namespace CodeceptionTesting\MVC;

use CodeceptionTesting\Helper\Session;
use Symfony\Component\HttpFoundation\Request;


class Controller {
    /**
     *
     * @var Request
     */
    private $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    function actionIndex()
    {
        return [];
    }
    
    function actionSignIn()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');
        
        if (empty($username) || empty($password)) {
            return ['error' => 'Username or password invalid.'];
        }
        
        $users = include (FIXTURES_PATH . '/users.php');
        
        if (!in_array($username, array_keys($users))) {
            return ['error' => sprintf('Username %s does not exist.', $username)];
        }
        
        if ($password !== $users[$username]) {
            return ['error' => 'Username or password invalid.'];
        }
        
        $this->signUser($username);
        return [];
    }
    
    function actionSignout()
    {
        $this->logoutUser();
        return [];
    }
    
    private function signUser($user)
    {
        $session = new Session();
        $session->set('user', $user);
    }
    
    private function logoutUser()
    {
        $session = new Session();
        $session->destroy();
    }
}
