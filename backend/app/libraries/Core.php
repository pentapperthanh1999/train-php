<?php
//core app class
class Core {
    protected $currentController = 'PagesController'; // default controller
    protected $currentMethod = 'index'; // default method
    protected $prefix = 'Controller';
    protected $params = []; 

    public function __construct()
    {
        $url = $this->getUrl();
        // look in 'controller' for first value, ucwords will capitalize first letter
        if (isset($url)) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . $this->prefix . '.php')) {
                //set a new controller
                $this->currentController = ucwords($url[0]) . $this->prefix;
                unset($url[0]);
            }
        }
        //Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
        //check for second part of the URL
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        //get parameters
        $this->params = $url ? array_values($url) : [];
        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            //alow you to filter variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //breaking it into an array
            $url = explode('/', $url);
            return $url;
        }
    }
}
