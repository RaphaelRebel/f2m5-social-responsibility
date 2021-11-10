<?php

namespace Website\Controllers;

use mysqli;

/**
* Dit handelt de security
 *
 */
class SecureController
{

	public function index()
	{
        $template_engine = get_template_engine();
		echo $template_engine->render('secure/index');
    }
}