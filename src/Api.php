<?php

class Api
{
    public static function index()
    {
        return response('API TEST');
    }


    /**
     * Generate Routes from route files.
     * 
     * Scans sub directories for route.php files and creates an array of Route objects from them.
     * 
     * @return Route[] $routes
     */
    public static function generateRoutes()
    {
        $routes = array();
        $files = self::recursiveScanFile(dirname(__DIR__), 'routes');
        $routeSets = array_map(function ($file) {
            return require $file;
        }, $files);
        array_map(function ($routeSet) use (&$routes) {
            array_map(function ($route) use (&$routes) {
                $routes[] = $route;
            }, $routeSet);
        }, $routeSets);
        return $routes;
    }

    /**
     * Instantiates Controllers found in Controllers sub folders
     * 
     * @return Object[] $controllers
     */
    public static function generateControllers()
    {
        //$controllers = array();
        $files = self::recursiveScanControllers(dirname(__DIR__));
        $controllers = array_map(function ($file) {
            return require_once $file;
        }, $files);
        return $controllers;
    }


    private static function recursiveScanFile($dir, $fileName = null, &$files = array())
    {
        $dirIterator = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            if (!is_dir(($file))) {
                if ($fileName) {
                    if (strpos($file, $fileName) !== false) {
                        $files[] = $file->getRealPath();
                    }
                } else {
                    $files[] = $file;
                }
            }
        }
        return $files;
    }
    

    private static function recursiveScanControllers($dir, &$controllers = array())
    {
        $dirIterator = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            if (is_dir($file)) {
                if (strpos($file, 'controllers') !== false) {
                    $controllerIterator = new RecursiveDirectoryIterator($file, RecursiveDirectoryIterator::SKIP_DOTS);
                    $newIterator = new RecursiveIteratorIterator($controllerIterator, RecursiveIteratorIterator::SELF_FIRST);
                    foreach ($newIterator as $f) {
                        if (!is_dir($f)) {
                            if (strpos($f->getFileName(), '.php') !== false) {
                                $controllers[] = $f;
                            }
                        }
                    }
                }
            }
        }
        return $controllers;
    }
}
