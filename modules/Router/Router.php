<?php
class Router {

	private $core;
	private $get;
	private $post;

	private function __construct() {}

	public static function getInstance() {
		static $inst = null;
		if($inst === null) {
			$inst = new Router();
		}
		return $inst;
	}

	public function load() {
		$this->core = Core::getInstance();
		$this->loadRouteFile('default');
		return $this;
	}

	public function loadRouteFile($f) {
		if(file_exists('routes/'.$f.'.php')) {
			require 'routes/'.$f.'.php';
		}
	}

	public function match()
    {
        $url = ((isset($_GET['url'])) ? $_GET['url'] : '');

        $urlExplode = explode('/', $url);

        if ($urlExplode[count($urlExplode) - 1] === '') {

            unset($urlExplode[count($urlExplode) - 1]);
            $url = implode('/', $urlExplode);
        }

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
            default:
                $type = $this->get;
                break;
            case 'POST':
                $type = $this->post;
                break;
		}
		
        $retorno = false;
        // Loop em todos os routes
        foreach ($type as $pt => $func) {
            //Identifica os argumentos e substitui por regex
            $pattern = preg_replace('(\{[a-z0-9]{0,}\})', '([a-z0-9]{0,})', $pt);

            // Faz o match de URL
            if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);
                // Pega todos os argumentos para associar
                $itens = array();
                if (preg_match_all('(\{[a-z0-9]{0,}\})', $pt, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }
                // Faz a associação
                $arg = array();
                foreach ($matches as $key => $match) {
                    $arg[$itens[$key]] = $match;
                }

                $retorno = true;
                $func($arg);
                break;
            }
        }
        if (!$retorno) {
            $this->get['404'](null);
        }
    }

	public function get($pattern, $function) {
		$this->get[$pattern] = $function;
	}

	public function post($pattern, $function) {
		$this->post[$pattern] = $function;
	}

}
?>