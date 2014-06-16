<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SelfStudy extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('selfstudy_m');
		$this->lang->load('selfstudy');

	}

	private function uri_segment( $number )
    {
		$segments = explode( "/", str_replace(site_url(), "", current_url()));
		$base = array_search( 'selfstudy', $segments );
    	return $this->uri->segment( $base + $number );
	}

	private function uri_base( $str )
    {
		$segments = explode( "/", str_replace(site_url(), "", current_url()));
		
		$base = array();
		$i = 0;
		while ( $segments[$i] != 'selfstudy' )
		{
			$base[] = $segments[$i]; 
			$i++;
		}
		$base[] = $str;

    	return implode( '/', $base );
	}

	public function index()
	{
		$data_published_courses = $this->selfstudy_m->get_all_published_courses();

		$this->template
			->title( lang('selfstudy:index_title') )
			->set( 'data_published_courses', $data_published_courses )
			->set( 'uri_base', $this->uri_base('selfstudy/') )
			->build( 'index' );
	}

	public function course()
	{
		$data_course = $this->selfstudy_m->get_course( $this->uri_segment(2) );
		$data_lesson = $this->selfstudy_m->get_lesson( $this->uri_segment(2), $this->uri_segment(3) );
		
		$this->template
			->title( lang('selfstudy:index_title') )
			->append_css('module::selfstudy.css')
			->set( 'data_course', $data_course )
			->set( 'data_lesson', $data_lesson )
			->set( 'uri_base', $this->uri_base('selfstudy/') )
			->build( 'course' );
	}
}