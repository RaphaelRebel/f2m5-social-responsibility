<?php

namespace Website\Controllers;

use mysqli;

/**
* Dit handelt de security
 *
 */
class SecureController
{

	public function index($id)
	{
		// $story = getBlogById($id);
		$topics = getAllTopics();
        $template_engine = get_template_engine();
		echo $template_engine->render('secure/index', ['topics' => $topics]);
	}

}