<?php
namespace Website\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class isAuthenticated implements IMiddleware {

    public function handle(Request $request): void 
    {
    
        // Authenticate user, will be available using request()->user
        $user = loggedInUser();

    

        $request->user = $user;
    }
}

?>