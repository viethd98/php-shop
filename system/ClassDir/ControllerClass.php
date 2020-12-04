<?php

class ControllerClass
{
 
    protected $db;
    public $forceIndex; 
  
    public function __construct()
    {
        global $db;

        $this->db = $db;
        $this->forceIndex = false;
    }

    public function view($page, ...$params)
    {
    
        $title = $params[0]['title'] ?? config('name');
        $layout = $params[0]['layout'] ?? 'main';
        $data = $params[0]['data'] ?? null;
        if ( ! is_array($data) ) $data = [$data];

        // Setup string layout directory
        if (strpos($layout, '.php') === false) $layout = $layout.'.php';
        $layout = 'view/layout/'.$layout;

        // Set Page File
        if (strpos($page, '.php') === false) $page = $page.'.php';
        $page = 'view/page/'.$page;

        $_VIEW = [
            'title' => $title,
            'layout' => $layout,
            'page' => $page,
            'data' => $data,
        ];

        unset($page, $title, $layout);
        extract($data);
        unset($data);

        include($_VIEW['layout']);
    }

  
    public function error403($title = '403 - Forbidden')
    {
        $this->view('../error/403.php', ['title' => $title]);
        exit();
    }

    
    public function error404($title = '404 - Not Found')
    {
        $this->view('../error/404.php', ['title' => $title]);
        exit();
    }
}

?>