<?php

namespace Website\Controllers;

use mysqli;

/**
* Dit handelt de security
 *
 */
class StoryController
{
	public function story($id)
	{
		
		
		$story = getBlogById($id);
		
		// print_r($story); exit;
		$template_engine = get_template_engine();
		echo $template_engine->render('blog/story', ['story' => $story, 'user' => request()->user]);
	}

	public function storyDelete($id)
	{
		
		$delete = deleteBlogById($id);
		

		redirect(url('login.dashboard'));
		// print_r($story); exit;
		$template_engine = get_template_engine();
		echo $template_engine->render('user/user_dashboard', ['delete ' => $delete]);
	}
}