<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends MY_Model {

	public function get_course( $slug )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->where('slug', $slug);
		$data = $this->db->get($this->db->dbprefix($_table_prefix . 'courses'))->result_array();

		if( empty($data) )
		{
			return NULL;
		}
		else
		{
			return $data[0];
		}
	}

	public function set_course( $id, $title, $slug, $description, $version, $new = FALSE )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$data = array(
				'title' => $title,
				'slug' => $slug,
				'description' => $description,
				'version' => $version,
			);
		if( $new)
		{
			$data['courseid'] = $id;
			$this->db->insert($this->db->dbprefix($_table_prefix . 'courses'), $data); 
		}
		else
		{
			$this->db->where('courseid', $id);
			$this->db->update($this->db->dbprefix($_table_prefix . 'courses'), $data); 
		}
	}

	public function get_lessons( $course_slug )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->select("l.`lessonid`, l.`slug`, l.`title`, l.`displayorder`");

		$this->db->from($this->db->dbprefix($_table_prefix . 'lessons') . ' AS l');
		$this->db->join($this->db->dbprefix($_table_prefix . 'courses') . ' AS c', 'l.courseid = c.courseid');

		$this->db->where('c.`slug`', $course_slug);
		$this->db->order_by('l.`displayorder`');
		return $this->db->get()->result_array();
	}

	public function update_displayorder( $ids )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$i = 0;
		foreach ($ids as $id)
		{
			$this->db->where('lessonid', $id);
			$this->db->update($this->db->dbprefix($_table_prefix . 'lessons'), array( 'displayorder' => $i )); 
			$i++;
		}
	}

	public function get_all_published_courses()
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->where('published', 1);
		return $this->db->get($this->db->dbprefix($_table_prefix . 'courses'))->result_array();
	}

	public function get_all_unpublished_courses()
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->where('published', 0);
		return $this->db->get($this->db->dbprefix($_table_prefix . 'courses'))->result_array();
	}

	public function publish( $slug )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');

		$this->db->where('slug', $slug);
		return $this->db->update($this->db->dbprefix($_table_prefix . 'courses'), array( 'published' => 1 )); 
	}

	public function depublish( $slug )
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');

		$this->db->where('slug', $slug);
		return $this->db->update($this->db->dbprefix($_table_prefix . 'courses'), array( 'published' => 0 )); 
	}

}