<?php

namespace Website\Controllers;

use mysqli;

/**
 * Dit handelt het mail
 *
 */
class TopicController
{

	public function index()
	{

		$topics = getAllTopics();

		$template_engine = get_template_engine();
		echo $template_engine->render('blog/topics', ['topics' => $topics], ['user' => request()->user]);
	}

	public function new()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('blog/new');
	}

	public function save()
	{
		$result = validateTopicData($_POST, input()->file('upload'));
		if (count($result['errors']) === 0) {
			//afbeelding opslaan
			$upload = input()->file('upload');
			//File uploaden
			$tmpFileName = $upload->getTmpName();
			//Naam ophalen
			$origFilename = $upload->getFilename();
			$origFileExt = $upload->getExtension();

			//Unique bestandsnaam maken
			$newFilename = sha1_file($tmpFileName) . '.' . $origFileExt;
			$finalPath = get_config('PUBLIC') . '/uploads/' . $newFilename;
			$upload->move($finalPath);



			//Image informatie opslaan in de database
			$image_id = createImage($newFilename, $origFilename);

			$user = loggedInUser();

			//Blog opslaan
			createTopic($result['data']['title'], $result['data']['description'], $user);
			redirect(url('topics.index'));
		}
		$template_engine = get_template_engine();
		echo $template_engine->render('blog/new', ['errors' => $result['errors']]);
	}
	public function details($id)
	{
		$blog = getBlogById($id);
		// print_r($blog); exit;
		$template_engine = get_template_engine();
		echo $template_engine->render('blog/details', ['blog' => $blog]);
	}
}
