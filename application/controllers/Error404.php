<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this -> load -> view('principal/config');
		$this -> load -> view('principal/start');

		$data_menu = $this -> db
						-> order_by("orden", "asc")
						-> get('menu');

		$data["menu_activo"] = 0;

		$data["menus"] = $data_menu -> result();

		$this -> load -> view('principal/head', $data);
		$this -> load -> view('principal/menu');
		$this -> load -> view('errors/html/error_404');
		$this -> load -> view('principal/footer');
	}
}
