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
		$topics = getAllTopics();
		
		$story = getBlogById($id);

		
		// print_r($story); exit;
		$template_engine = get_template_engine();
		echo $template_engine->render('blog/story', ['story' => $story], ['topics' => $topics], ['user' => request()->user]);
	}
}