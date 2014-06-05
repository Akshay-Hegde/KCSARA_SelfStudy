<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SelfStudy extends Public_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('selfstudy_m');

	}

	public function index()
	{
		$this->template
			->title( 'Self Study' )
        	->build('index');
	}	
}