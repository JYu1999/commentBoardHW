<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'contact']));
        //$this->registerMiddleware(new AuthMiddleware(['']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());

            //var_dump($user);

            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'Thanks for registering.');
                Application::$app->response->redirect('/');
                exit;
            }


            return $this->render('register',[
                'model'=>$user
            ]);
        }

        $this->setLayout('auth');

        return $this->render('register',[
            'model'=>$user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
    public function profile()
    {
        return $this->render('profile');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        var_dump($body);
        return 'Handling submitted data.';
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Post created.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}