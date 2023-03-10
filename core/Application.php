<?php

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;
use app\models\ContactForm;

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?UserModel $user=null;
    public View $view;
    public ContactForm $contactForm;
    //public ?Controller $controller = null;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass']??'';
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db= new Database($config['db']);
        $this->contactForm = new ContactForm();

        $primaryValue = $this->session->get('user');
//        echo '<pre>';
//        var_dump($_SESSION);
//        echo '</pre>';
//        exit;
        if($primaryValue){
            $primaryKey =(new $this->userClass)->primaryKey();
//            echo '<pre>';
//            var_dump($primaryValue);
//            echo '</pre>';
            //exit;
            $this->user = (new $this->userClass)->findOne([$primaryKey=>$primaryValue]);
            
        }
    }

    public function run()
    {
        try {

            echo $this->router->resolve();
        }catch (\Exception $e){
//            var_dump($e);
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
    public static function isAdmin($id){
        return self::$app->user->getAdmin($id);
    }
}