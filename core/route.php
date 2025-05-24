<?php

class route
{
    public function __construct()
    {
        $url = $_GET['path'];

        $url_array = [
            ['url'=>'/^search$/', 'controller'=>'indexController', 'action'=>'search', 'type'=>'GET'],
            ['url'=>'/^home$/', 'controller'=>'indexController', 'action'=>'home', 'type'=>'GET'],
            ['url'=>'/^products$/', 'controller'=>'productController', 'action'=>'show_products', 'type'=>'GET'],
            ['url'=>'/^product\/(.+)$/', 'controller'=>'productController', 'action'=>'showProduct', 'type'=>'GET'],
            ['url'=>'/^register$/', 'controller'=>'authController', 'action'=>'register', 'type'=>'GET'],
            ['url'=>'/^register$/', 'controller'=>'authController', 'action'=>'storeUser', 'type'=>'POST'],
            ['url'=>'/^login$/', 'controller'=>'authController', 'action'=>'showlogin', 'type'=>'GET'],
            ['url'=>'/^login$/', 'controller'=>'authController', 'action'=>'login', 'type'=>'POST'],
            ['url'=>'/^logout$/', 'controller'=>'authController', 'action'=>'logout', 'type'=>'POST'],
            ['url'=>'/^active-link\/(.+)$/', 'controller'=>'authController', 'action'=>'activate_user', 'type'=>'GET']
        ];

        $route_fail = true;
        foreach($url_array as $item)
        {
            // Following line has been replaced by preg_match() to check if URL matches the given regular expression (in item['url'])
            // $url == $item['url']
            if (preg_match($item['url'], $url, $matches) && $_SERVER['REQUEST_METHOD'] == $item['type'])
            {
                $route_fail = false;
                unset($matches[0]);
                include 'app/controller/'.$item['controller'].'.php';
                $new_obj = new $item['controller'];
                call_user_func_array([$new_obj, $item['action']], array_values($matches));
            }
        }
        if ($route_fail)
        {
            echo "(404) Page not found";
        }
    }
}

function legacy_route()
{
    // echo $_GET['path'].'<br>';

    $url = explode('/', $_GET['path']);
    var_dump($url);
    echo '<br>';
    
    $controller = $url[0].'Controller';
    unset($url[0]);
    $method = $url[1];
    unset($url[1]);
    
    var_dump($url);
    echo '<br>';
    
    // Functions used to check if a file / function exists :
    // file_exists(); / method_exists();
    
    if (file_exists('app/controller/'.$controller.'.php'))
    {
        // Include once includes the following source only one time
        include_once 'app/controller/'.$controller.'.php';
        $object = new $controller();

        if (method_exists($object, $method))
        {
            // $object->$method();
            // Above method has been deprecated for calling an unknown (variable) function from an object.
            // Instead the following method is being used, Also for passing variables to those functions :
            call_user_func_array([$object, $method], array_values($url));
        }
        else
        {
            echo '404 Page unavailable : No such function.';
        }
    }
    else
    {
        echo '404 Page unavailable : File does not exist.';
    }
}

?>
