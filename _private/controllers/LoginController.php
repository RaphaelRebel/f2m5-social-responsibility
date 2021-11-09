<?php

namespace Website\Controllers;

use mysqli;

/**
* Dit handelt het login
 *
 */
class LoginController
{

	public function loginForm()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('login_form');
	}

	public function handleLoginForm(){
		//form valideren: email en wachtwoord ingevuld?
		$result = validateRegistrationData($_POST);

		//checken: bestaat gebruiken met email?
		if(userNotRegistered($result['data']['email'] ) ){
			$result['data']['email'] = 'deze gebruiker is niet bekend';
		} else{
			//controleren wachtwoord klopt (password_verify)
			$user = getUserByEmail($result['data']['email']);

			//Kijken of code NULL is
			if(is_null($user['code'])){

				if(password_verify($result['data']['password'], $user['password'])){

					//gebruiker inloggen
					loginUser($user);

					//gebruiker doorsturen naar ingelogde pagina
					redirect(url('login.dashboard'));

				} else{
					//anders foutmelding tonen
					$result['errors']['password'] = 'wachtwoord is niet correct';
				}

	    	} else{
				$result['errors']['email'] = 'Dit account is nog niet actief';
			}
		}


		$template_engine = get_template_engine();
		echo $template_engine->render('login_form', ['errors' => $result['errors']]);
	}

	public function userDashboard(){
		//checken of je bent ingelogd
		loginCheck();

		$template_engine = get_template_engine();
		echo $template_engine->render('user_dashboard');
	}

	public function logout(){
		logoutUser();
		redirect(url('home'));
	}
	
	public function passwordForgottenForm(){

		$errors = [];
		$mail_sent = false;

		if (request()->getMethod() === 'post'){
			//formulier afhandelen
		
			//email check
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		if($email === false){
			$errors['email'] = 'Geen geldige email adres opgegeven';
		}

		

		if (count($errors) === 0){
			//kijken of email in database staat
			$user = getUserByEmail($email);
			if($user === false){ 
				$errors[$email] = 'Onbekend account';
			}
		}

			//als er geen fouten zijn, reset mail versturen
			if(count($errors) === 0){
				sendPasswordResetEmail($email);
				$mail_sent = true;
			}
		}

		$template_engine = get_template_engine();
		echo $template_engine->render('password_forgotten_form', ['errors' => $errors, 'mail_sent' => $mail_sent]);
	}

	public function passwordResetForm($reset_code){

		$errors = [];

		//gebruiker ophalen die bij de reset form hoort

		$user = getUserByResetCode($reset_code);
		if($user === false){
			echo 'Ongeldige code';
			exit;
		}
		
		//is het formulier opgestuurd met POST?

		if (request()->getMethod() === 'post'){
			
					//formulier checken
					
					$password = $_POST['password'];
					$password_confirm = $_POST['password_confirm'];

					if (empty($password) || strlen($password) < 6) {
						$errors['password'] = "Het wachtwoord moet meer dan 6 tekens hebben!";
					} 

					if(count($errors) === 0){
						if($password !== $password_confirm){
							$errors['password'] = 'De wachtwoorden zijn niet gelijk.';
						}
					}
			
					//nieuwe wachtwoord updaten
					if(count($errors) === 0){
						$result = updatePassword($user['id'], $password);
						if($result === true){
							redirect(url('login.form'));
						}else{
							$errors['wachtwoord'] = 'Er ging iets fout met het opslaan van het wachtwoord';
						}
						//gebruiker door sturen naar de login
					}
			

		}

		$template_engine = get_template_engine();
		echo $template_engine->render('password_reset_form', ['errors' => $errors, 'reset_code' => $reset_code]);
	}
}