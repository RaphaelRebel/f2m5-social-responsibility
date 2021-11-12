<?php
// Dit bestand hoort bij de router, en bevat nog een aantal extra functies je kunt gebruiken
// Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions

use Pecee\Http\Input\InputFile;

require_once __DIR__ . '/route_helpers.php';

// Hieronder kun je al je eigen functies toevoegen die je nodig hebt
// Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand

/**
 * Verbinding maken met de database
 * @return \PDO
 */
function dbConnect() {

	$config = get_config( 'DB' );

	try {
		$dsn = 'mysql:host=' . $config['HOSTNAME'] . ';dbname=' . $config['DATABASE'] . ';charset=utf8';

		$connection = new PDO( $dsn, $config['USER'], $config['PASSWORD'] );
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

		return $connection;

	} catch ( \PDOException $e ) {
		echo 'Fout bij maken van database verbinding: ' . $e->getMessage();
		exit;
	}

}

/**
 * Geeft de juiste URL terug: relatief aan de website root url
 * Bijvoorbeeld voor de homepage: echo url('/');
 *
 * @param $path
 *
 * @return string
 */
function site_url( $path = '' ) {
	return get_config( 'BASE_URL' ) . $path;
}

function absolute_url( $path = '' ) {
	return get_config( 'BASE_HOST' ) . $path;
}



function get_config( $name ) {
	$config = require __DIR__ . '/config.php';
	$name   = strtoupper( $name );

	if ( isset( $config[ $name ] ) ) {
		return $config[ $name ];
	}

	throw new \InvalidArgumentException( 'Er bestaat geen instelling met de key: ' . $name );
}

/**
 * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
 * @return \League\Plates\Engine
 */
function get_template_engine() {

	$templates_path = get_config( 'PRIVATE' ) . '/views';

	$template_engine = new League\Plates\Engine( $templates_path );
	$template_engine->addFolder('layouts', $templates_path . '/layouts');

	return $template_engine;

}

/**
 * Geef de naam (name) van de route aan deze functie, en de functie geeft
 * terug of dat de route is waar je nu bent
 *
 * @param $name
 *
 * @return bool
 */
function current_route_is( $name ) {
	$route = request()->getLoadedRoute();

	if ( $route ) {
		return $route->hasName( $name );
	}

	return false;

}

function validateRegistrationData($data){
	$errors = [];
	$voornaam = $data['voornaam'];
	$achternaam = $data['achternaam'];
	$email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
	$password = trim($data['password']);
	// $voornaam = $_POST['voornaam'];
	// $achternaam = $_POST['achternaam'];

	//check of het email dat is ingevoerd geldig is
	if ($email === false) {
		$errors['email'] = "Dit is een valse e-mail!";
	}

	//check of het wachtwoord minimaal 6 tekens heeft
	if (empty($password) || strlen($password) < 6) {
		$errors['password'] = "Het wachtwoord moet meer dan 6 tekens hebben!";
	} 

	// resultaat array
	$data = [
		'email' => $_POST['email'],
		'password' => $password,
		'voornaam' => $voornaam,
		'achternaam' => $achternaam
	];

	return [
		'data' => $data,
		'errors' => $errors
	];

}

// Blog 
function validateTopicData($data, Pecee\Http\Input\InputFile $upload){
	$errors = [];
	//Benoem alle waarden
	$title = $data['title'];
	$description = $data['description'];

	//check of de titel en description ingevuld zijn
	if (empty($title)) {
		$errors['title'] = "Vul een titel in.";
	}
	if (empty($description)) {
		$errors['description'] = "Vul een description in";
	}
	if($upload->hasError()){
		$errors['upload'] = 'Er is geen afbeelding geupload';
	}else{
		if($upload->getMime() !== 'image/jpg' && $upload->getMime() !== 'image/png' && $upload->getMime() !== 'image/jpeg'){
			$errors['upload'] = 'Je mag alleen JPG of png uploaden';
		}
	}
	// resultaat array
	$data = [
		'title' => $title,
		'description' => $description,
		'upload' => $upload
	];

	return [
		'data' => $data,
		'errors' => $errors
	];

}

function userNotRegistered($email){
	$connection = dbConnect();
	$sql = "SELECT * FROM `user` WHERE `email` = :email";
	$statement = $connection->prepare($sql);
	$statement->execute(['email' => $email]);

	return ($statement->rowCount() === 0);
}

function createUser($email, $password, $code, $voornaam, $achternaam){
		
		$connection = dbConnect();

		//zo niet, door met opslaan
		$sql = "INSERT INTO `user` (`email`, `password`, `code`, `voornaam`, `achternaam`) VALUES (:email, :password, :code, :voornaam, :achternaam)";
		$statement = $connection->prepare($sql);
		$safe_password = password_hash($password, PASSWORD_DEFAULT);
		$params = [
			'email' => $email,
			'password' => $safe_password,
			'code' => $code,
			'voornaam' => $voornaam,
			'achternaam' => $achternaam
			// 'voornaam' => $voornaam,
			// 'achternaam' => $achternaam
		];
		$statement->execute($params);
}

function loginUser($user){
	$_SESSION['user_id'] = $user['id'];
}

function logoutUser(){
	unset($_SESSION['user_id']);
}

function loggedInUser(){
	if(!isLoggedIn()){
		return false;
	};
	return getUserById($_SESSION['user_id']);
}

function isLoggedIn(){
	return ! empty($_SESSION['user_id']);
}

function loginCheck(){
	if ( ! isLoggedIn()){
		$login_url = url('login.form');
		redirect($login_url);
	}
}

function ConfirmedUser(){
	return $_SESSION['user_id'];
}

function getLoggedInUserEmail(){
	$email = "NIET INGELOGD";

	if(!isLoggedIn()){
		return $email;
	}

	
	$user_id = $_SESSION['user_id'];
	$user = getUserById($user_id);

	if($user){
		$email = $user['email'];
	}

	return $email;
}


// Voeg deze code toe onderaan in je private/includes/functions.php
// ZONDER de eerste PHP tag want die staat al bovenaan je functions.php ;-)

/**
 * Maak de SwiftMailer aan en stet hem op de juiste manier in
 *
 */
function getSwiftMailer() {
	$mail_config = get_config( 'MAIL' );
	$transport   = new \Swift_SmtpTransport( $mail_config['SMTP_HOST'], $mail_config['SMTP_PORT'] );
	$transport->setUsername($mail_config['SMTP_USER'] );
	$transport->setPassword($mail_config['SMTP_PASSWORD']);

	$mailer = new \Swift_Mailer( $transport );

	return $mailer;
}


function createEmailMessage( $to, $subject, $from_name, $from_email ) {

	// Create a message
	$message = new \Swift_Message( $subject );
	$message->setFrom( [ $from_email => $from_email ] );
	$message->setTo( $to );

	// Send the message
	return $message;
}

/**
 *
 * @param $message \Swift_Message De Swift Message waarin de afbeelding ge-embed moet worden
 * @param $filename string Bestandsnaam van de afbeelding (wordt automatisch uit juiste folder gehaald)
 *
 * @return mixed
 */
function embedImage( $message, $filename ) {
	$image_path = get_config( 'WEBROOT' ) . '/images/email/' . $filename;
	if ( ! file_exists( $image_path ) ) {
		throw new \RuntimeException( 'Afbeelding bestaat niet: ' . $image_path );
	}

	$cid = $message->embed( \Swift_Image::fromPath( $image_path ) );

	return $cid;
}

function confirmAccount($code){
	$connection = dbConnect();
	$sql = 'UPDATE `user` SET `code` = NULL WHERE `code` = :code';
	$statement = $connection->prepare($sql);
	$params = [
		'code' => $code
	];
	$statement->execute($params);
}

function sendConfirmationEmail($email, $code){



	$url = url('register.name', ['code' => $code]);
	$absolute_url = absolute_url($url);

	$mailer = getSwiftMailer();
	$message = createEmailMessage($email, 'Bevestig je account', 'Transformers', 'raphaelrebel@live.com');
	$email_text = 'Hoi, bevestig hier je account: <a href="' . $absolute_url . '">Klik hier</a>';
	$message->setBody($email_text, 'text/html');

	$mailer->send($message);

}
function sendConfirmationMessage($voornaam, $code){



	$url = url('register.name', ['code' => $code]);
	$absolute_url = absolute_url($url);
	$input = 'Bevestig hier de account van '.$voornaam.': <a href="' . $absolute_url . '">Klik hier</a>';

}


function getConfirmationInfo($user){
	//vind code
	while ($row = mysqli_fetch_array($user)) {
		echo '<p>' . $row['code'] . '</p>';
	  };
	// Kijk of accounts een code hebben


	//zo wel, stop het account in een lijst
	//plaats lijst in html
}


// function updateText(){
// 	$newText = $_POST['text'];

//     // Op deze plek sla je de bestandsnaam en andere gegevens op in je database, dat mag je zelf doen.
//     try {
//         $mysqli = new mysqli("localhost", "root", "root", "transformers"); // aanpassen voor MA-cloud

//         if ($mysqli->connect_errno) {
//             echo "Failed to connect to MySQL: " . $mysqli->connect_error;
//             exit();
//         }

//         // $data = [
//         //     'image' => $file_name,
//         //     'title' => $title,
//         //     'prize' => $prize
//         // ];


//         //UPDATE DE FOTO'S HIER
//         //////////////////////////////////////
//         $updateText = "UPDATE `text` SET text= '$newText' WHERE id = 1";

        

//         $result = $mysqli->query($updateText);
//         $mysqli->close();
//     } catch (PDOException $e) {
//         echo "ERROR IN INSERTING DATA! : " . $e->getMessage();
//     }
    


//     // Stuur de gebruiker door naar een andere pagina
//     header('Location: paste.php');
//     exit();
// }


function sendPasswordResetEmail($email){


	$reset_code = md5(uniqid(rand(), true));
	$connection = dbConnect();
	$sql = 'UPDATE `user` SET `password_reset` = :code WHERE `email` = :email ';
	$statement = $connection->prepare($sql);
	$params = [
		'code' => $reset_code,
		'email' => $email
	];
	$statement->execute($params);

	$url = url('wachtwoord/wachtwoord-reset', ['reset_code' => $reset_code]);

	$absolute_url = absolute_url($url);

	$mailer = getSwiftMailer();
	$message = createEmailMessage($email, 'Bevestig je account', 'Transformers', 'raphaelrebel@live.com');

	$email_text = 'Hoi, Klik hier om je wachtwoord te resetten: <a href="' . $absolute_url . '">Wachtwoord reset</a>';

	$message->setBody($email_text, 'text/html');
	$mailer->send($message);

}









