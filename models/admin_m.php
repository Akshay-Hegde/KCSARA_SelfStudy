<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends MY_Model {

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