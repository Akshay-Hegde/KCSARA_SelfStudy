<?php defined('BASEPATH') or exit('No direct script access allowed');

class SelfStudy_m extends MY_Model {

	public function get_all_published_courses()
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->select('`slug`, `title`');
		$this->db->where('published', 1);
		$this->db->order_by('title');
		return $this->db->get($this->db->dbprefix($_table_prefix . 'courses'))->result_array();
	}

	public function get_course( $course_slug )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->select("c.`slug` AS 'course_slug', l.`slug` AS 'lesson_slug', c.`title` AS 'course_title', l.`title` AS 'lesson_title'");

		$this->db->from($this->db->dbprefix($_table_prefix . 'lessons') . ' AS l');
		$this->db->join($this->db->dbprefix($_table_prefix . 'courses') . ' AS c', 'l.courseid = c.courseid');

		$this->db->where('c.`slug`', $course_slug);
		$this->db->order_by('l.`displayorder`');

		return $this->db->get()->result_array();

	}

	public function get_lesson( $course_slug, $lesson_slug = NULL )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->select("c.`slug` AS 'course_slug', l.`slug` AS 'lesson_slug', c.`title` AS 'course_title', l.`title` AS 'lesson_title', l.`html` AS 'lesson_html'");

		$this->db->from($this->db->dbprefix($_table_prefix . 'lessons') . ' AS l');
		$this->db->join($this->db->dbprefix($_table_prefix . 'courses') . ' AS c', 'l.courseid = c.courseid');

		$this->db->where('c.`slug`', $course_slug);
		if( $lesson_slug )
		{
			$this->db->where('l.slug', $lesson_slug);
		}
		$this->db->order_by('l.`displayorder`');
		$this->db->limit(1);

		$data = $this->db->get()->result_array();

		if( empty($data) )
		{
			return NULL;
		}
		else
		{
			return $data[0];
		}

	}

}