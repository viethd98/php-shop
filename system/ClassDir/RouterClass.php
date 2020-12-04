<?php


class RouterClass
{
    protected $classDefault;
    protected $methodDefault;
    protected $controller;

   
    public function __construct()
    {
        global $_CONFIG;

        $this->classDefault = toPascalCase($_CONFIG['index']);
        $this->methodDefault = 'index';
        $this->controller = new ControllerClass();

        
        if ( substr(getUrl(), 0, strlen(baseurl())) != baseurl() ) {
            redirect($_SERVER['REQUEST_URI']);
        }
    }

    public function run()
    {
       
        $classDefault = $this->classDefault;
        $methodDefault = $this->methodDefault;
        $selectedClass = $selectedMethod = null;
        $uriSegments = explodeUri();

       
        if ( ! empty($uriSegments) && ! $selectedClass ) {

            $className = toPascalCase($uriSegments[0]);

            if ( file_exists('app/'.$className.'.php') ) {

                array_shift($uriSegments);
                include('app/'.$className.'.php');

                $class = new $className();
                $method = $methodDefault;

                if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

              
                if ( method_exists($class, $method) ) {

                    $selectedClass = $class;
                    $selectedMethod = $method;
                    array_shift($uriSegments);

                } else if ( method_exists($class, $methodDefault) ) {

                    $selectedClass = $class;
                    $selectedMethod = $methodDefault;
                    array_shift($uriSegments);

                }

            }

        }

      
        if ( ! empty($uriSegments) && ! $selectedClass ) {

            $appDirectory = 'app/';

            foreach ($uriSegments as $key => $uri) {

                if ( ! $selectedClass ) {

                    $appDirectory .= $uri.'/';

                    array_shift($uriSegments);

                    if ( ! empty($uriSegments) ) {

                        $className = toPascalCase($uriSegments[0]);

                        if ( file_exists($appDirectory.$className.'.php') ) {

                            array_shift($uriSegments);
                            include($appDirectory.$className.'.php');

                            $class = new $className();
                            $method = $methodDefault;

                            if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

                            
                            if ( method_exists($class, $method) ) {

                                $selectedClass = $class;
                                $selectedMethod = $method;
                                array_shift($uriSegments);

                            } else if ( method_exists($class, $methodDefault) ) {

                                $selectedClass = $class;
                                $selectedMethod = $methodDefault;

                            }

                        }

                    }

                }

            }

        }

       
        if ( ! $selectedClass ) {

            $uriSegments = explodeUri(); 
            $className =  toPascalCase($classDefault);

            if ( file_exists('app/'.$className.'.php') ) {

                include('app/'.$className.'.php');

                $class = new $className();
                $method = toCamelCase($methodDefault);
                if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

                if ( method_exists($class, $method) ) {

                    $selectedClass = $class;
                    $selectedMethod = $method;

                } else if ( method_exists($class, $methodDefault) ) {

                    
                    

                }

            }

        }

       
        if ( $selectedClass && $selectedMethod ) {

            call_user_func_array([$selectedClass, $selectedMethod], $uriSegments);

        } else {

            $this->controller->error404();

        }

    }

}

?>