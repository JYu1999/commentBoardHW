<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
          'name' => "JYu"
        ];
        return $this->render('home', $params);
    }

    public function handleContact(Request $request)
    {
        $body = request->getBody();
        var_dump($body);
        return 'Handling submitted data.';
    }

    public function contact()
    {
       return $this->render('contact');
    }
}