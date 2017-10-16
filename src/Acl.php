<?php

namespace Laraturka\Acl;

class Acl {

    static public function getConfigControllerMethods(){
        $all_controllers = config('acl.controllers');

        foreach ($all_controllers as $controller=>&$method){

            if($method == null){
                $takenMethods = Acl::getControllerMethodsByName($controller);

                if(count($takenMethods)>0)
                    $method = $takenMethods[0]['method'];
            }

            $method = array_combine($method, $method);
        }

        return $all_controllers;
    }

    static public function getControllerMethodsByName($controller){

        $controllerNamespace = 'App\Http\Controllers\\';

        //clear if has namespace
        if (0 === strpos($controller, $controllerNamespace)) {
            $controller = substr($controller, strlen($controllerNamespace));
        }

        //replace slashes with directory seperator slash
        $controller = str_replace('/',DIRECTORY_SEPARATOR,$controller);
        $controller = str_replace('\\',DIRECTORY_SEPARATOR,$controller);


        $controllerPath = app_path(). DIRECTORY_SEPARATOR .'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR;

        $classes = self::getClassesByFileName($controllerPath.$controller.'.php');

        $result = [];
        foreach($classes['methods'] as $class=>$method) {
            $result[]=[
                'class'=>$class,
                'namespace'=>$classes['namespace'],
                'method'=>$method
            ];
        }

        return $result;
    }

    static public function getControllerMethods($controller_path = null){

        //check if its recursively called?
        if($controller_path==null){
            $controller_path = app_path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR;
        }

        //open controller path
        $dh = opendir($controller_path);

        $result = [];

        while(($file = readdir($dh)) !== false){

            //pass if dot files
            if (substr($file,0,1)=='.') continue;

            //parse class if file
            if (filetype($controller_path.$file)=='file') {
                $classes = self::getClassesByFileName($controller_path.$file);

                foreach($classes['methods'] as $class=>$method) {
                    $result[]=[
                        'class'=>$class,
                        'namespace'=>$classes['namespace'],
                        'method'=>$method
                    ];
                }

            }
            //look inside if directory
            elseif(filetype($controller_path.$file)=='dir') {
                $result = array_merge($result, self::getControllerMethods($controller_path.$file.DIRECTORY_SEPARATOR));
            }
        }

        closedir($dh);

        return $result;
    }

    static public function getClassesByFileName( $file_name ){
        return self::getClasses( file_get_contents($file_name) );
    }


    static public function getClasses($code){

        $methods=[];
        $namespace = '';
        $tokens = token_get_all($code);
        $count = count($tokens);
        $onlypublic = true;

        for ($i = 2; $i < $count; $i++) {

            //namespace found
            if ($tokens[$i-2][0] === T_NAMESPACE) {
                for ($j=$i+1;$j<count($tokens); $j++) {
                    if ($tokens[$j][0] === T_STRING) $namespace .= '\\'.$tokens[$j][1];
                    else if ($tokens[$j] === '{' || $tokens[$j] === ';') break;
                }
                $namespace = str_replace('\Http\Controllers','',$namespace);
                $namespace = ltrim($namespace,'\\');
            }

            //new class found
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class = $tokens[$i][1];
                $methods[$class] = [];
            }

            //is private ?
            if ($tokens[$i - 2][0] == T_FUNCTION && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                if ($onlypublic) {
                    if ( !in_array($tokens[$i-4][0],array(T_PROTECTED, T_PRIVATE))) {
                        $method = $tokens[$i][1];
                        $methods[$class][] = $method;
                    }
                } else {
                    $method = $tokens[$i][1];
                    $methods[$class][] = $method;
                }
            }
        }

        return ['namespace'=>$namespace,'methods'=>$methods];

    }

}