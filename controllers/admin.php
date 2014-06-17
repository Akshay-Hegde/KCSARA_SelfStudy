<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin_m');
		$this->lang->load('selfstudy');

	}

	private function generate_uuid4()
	{
		$a = '0123456789abcdef';
		$str = strrev( floor( microtime(TRUE) ) );

		$i = 0;
		while( strlen( $str ) < 30 )
		{
			$str = substr_replace( $str, substr( $a, rand(0, 15), 1), $i, 0);
			$i = $i + 2;
		}

		$str = substr_replace( $str, '-', 8, 0);
		$str = substr_replace( $str, '-4', 13, 0);
		$str = substr_replace( $str, '-', 18, 0);
		$str = substr_replace( $str, substr( '89ab', rand(0, 3), 1), 19, 0);
		$str = substr_replace( $str, '-', 23, 0);

		return $str;

	}

	public function index()
	{
		$data_published_courses = $this->admin_m->get_all_published_courses();
		$data_unpublished_courses = $this->admin_m->get_all_unpublished_courses();

		$this->template
			->set('data_published_courses', $data_published_courses)
			->set('data_unpublished_courses', $data_unpublished_courses)
			->build('admin/index');
	}

	public function publish()
	{

		$this->admin_m->publish($this->uri->segment(4));
		$this->session->set_flashdata('success', lang('selfstudy:publish_success') );

		redirect('admin/selfstudy');

	}

	public function depublish()
	{

		$this->admin_m->depublish($this->uri->segment(4));
		$this->session->set_flashdata('success', lang('selfstudy:depublish_success') );

		redirect('admin/selfstudy');

	}

}