<?php
use app\core\Application;


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">TestForum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>



            </ul>
            <?php if(Application::isGuest()):?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/login">Login</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="/register">Register </a>
                </li>
            </ul>
            <?php else:?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Create a new post</a>
                    </li>


                    <li class="nav-item active">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/logout">Welcome <?php echo Application::$app->user->getDisplayName() ?>
                            (Logout)
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?php if(\app\core\Application::$app->session->getFlash('success')): ?>

    <div class="alert alert-success">
        <?php echo \app\core\Application::$app->session->getFlash('success') ?>
    </div>
    <?php endif; ?>
    {{content}}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

<?php
//echo '<pre>';
//var_dump(Application::$app->contactForm->findPosts(Application::$app->user->id));
//echo '</pre>';
$posts =Application::$app->contactForm->findPosts(Application::$app->user->id);
foreach ($posts as $post){
    echo '<pre>';
    echo $post["subject"].PHP_EOL;
    echo $post["body"].PHP_EOL;
    echo '</pre>';
}

?>



</body>
</html>