<?php

namespace Website\Controllers;

use mysqli;

/**
 * Class WebsiteController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */
class RegistrationController
{

	public function aanmelding()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('user/aanmelding');
	}
	public function checkAanmelding()
	{
	$result = validateRegistrationData($_POST);
	$resultImage = validateImageData($_POST, input()->file('upload'));

		if (count($resultImage['errors']) === 0 || $result['errors'] === 0) {
			//informatie opslaan
			//checken of de gebruiken bestaat
			if (userNotRegistered($result['data']['email'])) {
				// echo 'check'; exit;
				
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
				
				//verificatie code
				$code = md5(uniqid (rand(), true) );
			
				createUser($result['data']['email'], $result['data']['password'], $code, $result['data']['voornaam'], $result['data']['achternaam'], $newFilename, $origFilename);
				
				//bevestigingsmail versturen
				sendConfirmationEmail($result['data']['email'], $code);

			   

			//  $user_id = loggedInUser();

			//Blog opslaan
			

				//stuur user door naar bedankt pagina
				$bedanktUrl = url('aanmelding.bedankt');
				redirect($bedanktUrl);
				
			} else {
				//anders foutmelding tonen
				$errors['email'] = "Dit account bestaat al";
			}
		}
		$template_engine = get_template_engine();
		echo $template_engine->render('user/aanmelding', ['errors' => $result['errors']]);
		
	}

	public function bedanktAanmelding(){
		$template_engine = get_template_engine();
		echo $template_engine->render('user/bedankt');
	}

	public function confirmRegistration($code){
		//Hier code lezen
		//Gebruiker ophalen
		$user = getUserByCode($code);
		if ($user === false){
			echo "Onbekende gebruiker, ben je al bevestigd?";
			exit;
		}

		//Gebruiker activeren: code leegmaken
		confirmAccount($code);

		//Doorsturen naar bevestiging pagina
		$template_engine = get_template_engine();
		echo $template_engine->render('user/register_confirmed');

	}

}
