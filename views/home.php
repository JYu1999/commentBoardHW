<?php
use app\core\Application;
?>

<h1>Main Board</h1>


<!--<h3>Welcome to --><?php //echo $name ?><!--</h3>-->

<?php
//echo '<pre>';
//var_dump(Application::$app->contactForm->findPosts(Application::$app->user->id));
//echo '</pre>';
if(!Application::isGuest() && !Application::isAdmin(Application::$app->user->id)){
    $posts =Application::$app->contactForm->findPosts(Application::$app->user->id);
    foreach ($posts as $post){
        echo '<pre>';
        echo $post["subject"].PHP_EOL;
        echo $post["body"].PHP_EOL;
        echo '</pre>';
    }
}elseif(!Application::isGuest() && Application::isAdmin(Application::$app->user->id)){
    $posts =Application::$app->contactForm->findPosts();
    foreach ($posts as $post){
        echo '<pre>';
        echo $post["subject"].PHP_EOL;
        echo $post["body"].PHP_EOL;
        echo '</pre>';
    }
}


?>