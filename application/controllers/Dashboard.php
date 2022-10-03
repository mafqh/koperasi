<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';

class Dashboard extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'backend/dashboard_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}
		$this->load->view('backend/layouts/page', $this->data);
	}
}