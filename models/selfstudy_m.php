<?php defined('BASEPATH') or exit('No direct script access allowed');

class SelfStudy_m extends MY_Model {

	public function get_all_published_courses()
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');
		$this->db->where('published', 1);
		$this->db->order_by("title");
		return $this->db->get($this->db->dbprefix($_table_prefix . 'courses'))->result_array();
	}

}