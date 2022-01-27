<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	/**
	 * App Core Class
	 * Creates URL & loads core controller
	 * URL FORMAT - /controller/method/params
	 */
	class Core {
		protected $currentController = 'Index';
		protected $currentMethod = 'index';
		protected $params = [];
		
		public function __construct(){
			$url = $this->getUrl();

			if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]). '.class.php')){
				// Jeśli istnieje, ustaw jako kontroler
				$this->currentController = ucwords($url[0]);
				// Nieustawiony indeks 0
				unset($url[0]);
			} else if(isset($url[0])) {
                $data = ['headTitle' => 'Not found', 'cssFile' => 'errors', "errorCode" => 404 ];
                die(require_once("../app/views/errors.php"));
            }
			
			// Wymaga kontrolera
			require_once '../app/controllers/'. $this->currentController . '.class.php';
			
			// Utwórz wystąpienie kontrolera
			$this->currentController = new $this->currentController;
			
			// Sprawdź drugą część adresu URL
			if(isset($url[1])){
				// Sprawdź, czy metoda istnieje w kontrolerze
				if(method_exists($this->currentController, $url[1])){
					$this->currentMethod = $url[1];
					// Unset l'index 1
					unset($url[1]);
				}
			}
			
			// Pobierz ustawienia
			$this->params = $url ? array_values($url) : [];
			
			// Wywołaj wywołanie zwrotne z tablicą parametrów
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}
		
		public function getUrl(){
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
			
			return false;
		}
	}