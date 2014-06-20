<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{

	/**
	 * The current active section.
	 *
	 * @var int
	 */
	protected $section = 'courses';

	/**
	 * Constructor method
	 */
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

	/**
	 * List all courses
	 */
	public function index()
	{
		$data_published_courses = $this->admin_m->get_all_published_courses();
		$data_unpublished_courses = $this->admin_m->get_all_unpublished_courses();

		$this->template
			->set('data_published_courses', $data_published_courses)
			->set('data_unpublished_courses', $data_unpublished_courses)
			->build('admin/index');
	}

	public function create()
	{
		$this->template
			->append_js('module::assignments.js')
			->set('title', '')
			->set('slug', '')
			->set('description', '')
			->set('version', '')
			->set('data_lessons', array())
			->build('admin/edit_course');
	}

	public function edit()
	{
		$data_course = $this->admin_m->get_course( $this->uri->segment(4) );
		$data_lessons = $this->admin_m->get_lessons( $this->uri->segment(4) );

		$this->template
			->append_metadata('<script>var fields_offset=0;</script>')
			->append_js('module::assignments.js')
			->set('title', $data_course['title'])
			->set('slug', $data_course['slug'])
			->set('description', $data_course['description'])
			->set('version', $data_course['version'])
			->set('data_lessons', $data_lessons)
			->build('admin/edit_course');
	}

	public function update_lesson_order()
	{
		/**
		 * This function is not safe for paginated lists.
		 */
		$ids = explode(',', $this->input->post('order'));
		$this->admin_m->update_displayorder( $ids );

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