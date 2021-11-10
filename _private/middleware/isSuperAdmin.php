<?php
namespace Website\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class isSuperAdmin implements IMiddleware {

    public function handle(Request $request): void 
    {
    
        // Authenticate user, will be available using request()->user
        $user = loggedInUser();

        if($user === false){
            redirect(url('login.form'));
            exit;
        }

        if($user['admin'] == 0){
            redirect(url('home'));
        }

        $request->user = $user;
    }
}

?>