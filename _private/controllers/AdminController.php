<?php

namespace Website\Controllers;

use mysqli;

/**
* Dit handelt het mail
 *
 */
class AdminController
{

	public function index()
	{

		//sendConfirmationMessage($code);
		

        $template_engine = get_template_engine();
		echo $template_engine->render('admin/admin', ['user' => request()->user]);
    }
}