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
			'frontend' => true,
			'backend' => true,
			'menu' => 'content'
		);
	}

	public function install()
	{
		return true;
	}

	public function uninstall()
	{
		return true;
	}

	public function upgrade($old_version)
	{
		return true;
	}
}