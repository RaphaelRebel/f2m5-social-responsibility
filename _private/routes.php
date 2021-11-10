<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use Website\Middleware\isAuthenticated;
use Website\Middleware\isSuperAdmin;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );


SimpleRouter::group( [ 'prefix' => site_url()], function () {

	// START: Zet hier al eigen routes (alle URL's die je op je website hebt) en welke controller en functie deze pagina afhandelt
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes
	SimpleRouter::group(['prefix' => '/', 'middleware' => isAuthenticated::class], function(){
	SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );
	});
	//aanmeld routes
	SimpleRouter::group(['prefix' => '/aanmelden'], function(){
		SimpleRouter::get( '/', 'RegistrationController@aanmelding' )->name( 'aanmelding' );
		SimpleRouter::post( '/check', 'RegistrationController@checkAanmelding' )->name( 'aanmelding.check' );
		SimpleRouter::get( '/bedankt', 'RegistrationController@bedanktAanmelding' )->name( 'aanmelding.bedankt' );
		SimpleRouter::get( '/bevestigen/{code}', 'RegistrationController@confirmRegistration' )->name( 'register.name' );

	});

	//login routes
	SimpleRouter::group(['prefix' => '/login'], function(){
	SimpleRouter::get( '/', 'LoginController@loginForm' )->name( 'login.form' );
	SimpleRouter::post( '/verwerken', 'LoginController@handleLoginForm' )->name( 'login.handle' );
	});

	SimpleRouter::group(['prefix' => '/logout'], function(){
	SimpleRouter::get( '/', 'LoginController@logout' )->name( 'logout' );
	});

	SimpleRouter::group(['prefix' => '/ingelogd', 'middleware' => isAuthenticated::class], function(){
		SimpleRouter::get( '/', 'Securecontroller@index' )->name( 'secure.index');
		SimpleRouter::get( '/dashboard', 'LoginController@userDashboard' )->name( 'login.dashboard');
	});

	//wachtwoord vergeten
	SimpleRouter::group(['prefix' => '/wachtwoord'], function(){
	SimpleRouter::match(['get', 'post'], '/vergeten', 'LoginController@passwordforgottenForm' )->name( 'password.form');
	SimpleRouter::match(['get', 'post'], '/wachtwoord-reset/{reset_code}', 'LoginController@passwordresetForm' )->name( 'password.reset');
	});	
	//stuur mail
	SimpleRouter::group(['prefix' => '/mail'], function(){
	SimpleRouter::get( '/stuur-test-email', 'EmailController@sendTestEmail' )->name( 'email.test');
	SimpleRouter::get( '/bekijk-test-email', 'EmailController@viewTestEmail' )->name( 'email.view');
	});	
	//admin page
	SimpleRouter::group(['prefix' => '/admin', 'middleware' => isSuperAdmin::class], function(){
	SimpleRouter::get( '/', 'Admincontroller@index' )->name( 'admin.index');
});	
		SimpleRouter::group(['prefix' => '/topics', 'middleware' => isAuthenticated::class], function(){
			SimpleRouter::get( '/', 'Topiccontroller@index' )->name( 'topics.index');
			SimpleRouter::get( '/new', 'Topiccontroller@new' )->name( 'topics.new');
			SimpleRouter::post( '/new', 'Topiccontroller@save' )->name( 'topics.save');
		});
	//secure
	


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

