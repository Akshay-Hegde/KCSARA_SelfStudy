<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_SelfStudy extends Module {

	public $version = 'a1.0';

    public function __construct()
    {
        parent::__construct();

        $this->config->load('selfstudy/selfstudy');
        $this->template->active_section = 'selfstudy';
    }

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'SelfStudy',
			),
			'description' => array(
				'en' => 'The selfstudy module creates a multi-page self study sub-site from a single HTML-formatted file stored on GitHub.',
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{

		$_table_prefix = $this->config->item('selfstudy._table_prefix');

		$this->dbforge->drop_table($_table_prefix . 'lessons');
		$this->dbforge->drop_table($_table_prefix . 'courses');

		$this->db->delete('settings', array('module' => 'exams'));

		$tables = array(
			$_table_prefix . 'lessons' => array(
				'lessonid' => array('type' => 'CHAR', 'constraint' => 64, 'primary' => true),
				'courseid' => array('type' => 'CHAR', 'constraint' => 64),
				'slug' => array('type' => 'CHAR', 'constraint' => 64),
				'title' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => ''),
				'html' => array('type' => 'LONGTEXT')
			),

			$_table_prefix . 'courses' => array(
				'courseid' => array('type' => 'CHAR', 'constraint' => 64, 'primary' => true),
				'slug' => array('type' => 'CHAR', 'constraint' => 64),
				'published' => array('type' => 'TINYINT', 'constraint' => 4, 'default' => '0'),
				'title' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => ''),
				'description' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => ''),
				'version' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => ''),
				'tochtml' => array('type' => 'LONGTEXT'),
				'rawhtml' => array('type' => 'LONGTEXT')
			),

		);


		$module_settings = array(
			'slug' => 'selfstudy_setting',
			'title' => 'Self Study Setting',
			'description' => 'A Yes or No option for the Self Study module',
			'`default`' => '1',
			'`value`' => '1',
			'type' => 'select',
			'`options`' => '1=Yes|0=No',
			'is_required' => 1,
			'is_gui' => 1,
			'module' => 'selfstudy'
		);

		if( $this->install_tables($tables) AND
		   $this->db->insert('settings', $module_settings) )
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		$_table_prefix = $this->config->item('selfstudy._table_prefix');

		$this->dbforge->drop_table($_table_prefix . 'lessons');
		$this->dbforge->drop_table($_table_prefix . 'courses');

		$this->db->delete('settings', array('module' => 'selfstudy'));
		{
			return TRUE;
		}
	}

	public function upgrade($old_version)
	{
		return TRUE;
	}
}