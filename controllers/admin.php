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
		if( $this->uri->segment(4) != NULL )
		{
			$this->edit_lesson();
		}
		else
		{
			return $this->edit_course();
		}
	}

	public function edit_course()
	{
		$input = $this->input->post();
		$success = FALSE;
		$new = FALSE;

		if(
			isset( $input['courseid'] ) AND
			isset( $input['title'] ) AND
			isset( $input['slug'] ) AND
			isset( $input['description'] ) AND
			isset( $input['version'] )
			)
		{
			$id = $input['courseid'];
			if( $id == "" )
			{
				$id = $this->generate_uuid4();
				$new = TRUE;
			}
			$this->admin_m->set_course(
				$id,
				$input['title'],
				$input['slug'],
				$input['description'],
				$input['version'],
				$new
			);
			$success = lang('selfstudy:courseedit_success');
		}

		/* If exit is indicated, redirect */
		if( $input['btnAction'] == 'save_exit' )
		{
			if( $success !== FALSE ) { $this->session->set_flashdata('success', $success ); }
			redirect('admin/selfstudy');
			return NULL;
		}

		$data_course = $this->admin_m->get_course( $this->uri->segment(4) );
		$data_lessons = $this->admin_m->get_lessons( $this->uri->segment(4) );

		if( $new )
		{
			$this->session->set_flashdata('success', lang('selfstudy:coursenew_success') );
			redirect('admin/selfstudy/edit/' . $input['slug']);
		}
		else
		{
			$this->template
				->append_metadata('<script>var fields_offset=0;</script>')
				->append_js('module::assignments.js')
				->set('success', $success)
				->set('courseid', $data_course['courseid'])
				->set('title', $data_course['title'])
				->set('slug', $data_course['slug'])
				->set('description', $data_course['description'])
				->set('version', $data_course['version'])
				->set('data_lessons', $data_lessons)
				->build('admin/edit_course');
		}
	}

	public function edit_lesson()
	{
		$input = $this->input->post();
		$success = FALSE;
		$new = FALSE;

		/* Handle post-data */
		if(
			isset( $input['lessonid'] ) AND
			isset( $input['title'] ) AND
			isset( $input['slug'] ) AND
			isset( $input['content'] )
			)
		{
			$id = $input['lessonid'];
			if( $id == "" )
			{
				$id = $this->generate_uuid4();
				$new = TRUE;
			}
			$this->admin_m->set_lesson(
				$id,
				$input['title'],
				$input['slug'],
				$input['content'],
				$new
			);
			$success = lang('selfstudy:lessonedit_success');
		}

		$data_lesson = $this->admin_m->get_lesson( $this->uri->segment(4), $this->uri->segment(5) );

		/* If exit is indicated, redirect */
		if( $input['btnAction'] == 'save_exit' )
		{
			if( $success !== FALSE ) { $this->session->set_flashdata('success', $success ); }
			redirect('admin/selfstudy/edit/' . $data_lesson['course_slug'] . '#course-lessons');
			return NULL;
		}

		if( $new )
		{
			$this->session->set_flashdata('success', lang('selfstudy:lessonnew_success') );
			redirect('admin/selfstudy/edit/' . $data_lesson['course_slug'] . '/' . $data_lesson['slug']);
		}
		else
		{
			$this->template
				->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
				->set('success', $success)
				->set('lessonid', $data_lesson['lessonid'])
				->set('course_title', $data_lesson['course_title'])
				->set('title', $data_lesson['title'])
				->set('course_slug', $data_lesson['course_slug'])
				->set('slug', $data_lesson['slug'])
				->set('content', $data_lesson['content'])
				->build('admin/edit_lesson');
		}
	}

	public function edit()
	{

		if( $this->uri->segment(5) != NULL )
		{
			$this->edit_lesson();
		}
		elseif( $this->uri->segment(4) != NULL )
		{
			return $this->edit_course();
		}
		else
		{
			redirect('admin/selfstudy');
		}

	}

	public function delete_course()
	{
		if( $this->admin_m->delete_course( $this->uri->segment(4) ) )
		{
			$this->session->set_flashdata('success', lang('selfstudy:coursedelete_success') );
		}
		else
		{
			$this->session->set_flashdata('success', lang('selfstudy:coursedelete_error') );
		}
		redirect('admin/selfstudy');
	}

	public function delete_lesson()
	{
		$course_slug = $this->admin_m->delete_lesson( $this->uri->segment(4), $this->uri->segment(5) );
		redirect('admin/selfstudy/edit/' . $course_slug . '#course-lessons');
	}

	public function delete()
	{

		if( $this->uri->segment(5) != NULL )
		{
			$this->delete_lesson();
		}
		elseif( $this->uri->segment(4) != NULL )
		{
			return $this->delete_course();
		}
		else
		{
			redirect('admin/selfstudy');
		}

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