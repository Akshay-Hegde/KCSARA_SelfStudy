<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin_m');
		$this->lang->load('selfstudy');

	}

	public function index()
	{
		$this->template
			->build('admin/index');
	}

}