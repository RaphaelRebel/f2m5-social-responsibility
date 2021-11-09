<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );


SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes (alle URL's die je op je website hebt) en welke controller en functie deze pagina afhandelt
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes

	SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );

	//aanmeld routes
	SimpleRouter::get( '/aanmelden', 'RegistrationController@aanmelding' )->name( 'aanmelding' );
	SimpleRouter::post( '/aanmelden/check', 'RegistrationController@checkAanmelding' )->name( 'aanmelding.check' );
	SimpleRouter::get( '/aanmelden/bedankt', 'RegistrationController@bedanktAanmelding' )->name( 'aanmelding.bedankt' );
	SimpleRouter::get( '/aanmelden/bevestigen/{code}', 'RegistrationController@confirmRegistration' )->name( 'register.name' );

	//login routes
	SimpleRouter::get( '/login', 'LoginController@loginForm' )->name( 'login.form' );
	SimpleRouter::get( '/logout', 'LoginController@logout' )->name( 'logout' );
	SimpleRouter::post( '/login/verwerken', 'LoginController@handleLoginForm' )->name( 'login.handle' );
	SimpleRouter::get( '/ingelogd/dashboard', 'LoginController@userDashboard' )->name( 'login.dashboard');

	//wachtwoord vergeten
	SimpleRouter::match(['get', 'post'], '/wachtwoord/vergeten', 'LoginController@passwordforgottenForm' )->name( 'password.form');
	SimpleRouter::match(['get', 'post'], '/wachtwoord-reset/{reset_code}', 'LoginController@passwordresetForm' )->name( 'password.reset');

	//stuur mail
	SimpleRouter::get( '/stuur-test-email', 'EmailController@sendTestEmail' )->name( 'email.test');
	SimpleRouter::get( '/bekijk-test-email', 'EmailController@viewTestEmail' )->name( 'email.view');

	//admin page
	


	// STOP: Tot hier al je eigen URL's zetten, dit stukje laat de 4040 pagina zien als een route/url niet kan worden gevonden.
	SimpleRouter::get( '/not-found', function () {
		http_response_code( 404 );

		return '404 Page not Found';
	} );

} );


// Dit zorgt er voor dat bij een niet bestaande route, de 404 pagina wordt getoond (die hierboven als route staat ingesteld)
SimpleRouter::error( function ( Request $request, \Exception $exception ) {
	if ( $exception instanceof NotFoundHttpException && $exception->getCode() === 404 ) {
		response()->redirect( site_url() . '/not-found' );
	}

} );

