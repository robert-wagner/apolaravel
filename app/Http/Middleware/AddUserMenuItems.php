<?php

namespace APOSite\Http\Middleware;

use APOSite\Http\Controllers\AccessController;
use APOSite\Http\Controllers\LoginController;
use Closure;
use Illuminate\Support\Facades\URL;

class AddUserMenuItems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = LoginController::currentUser();
        if($user != null){

            //Add menu items to the user
            $menu_items = [];

            //Exec functionality
            //Membership
            if(AccessController::isMembership($user)){
                $item = new \stdClass();
                $item->isHeader = true;
                $item->text = "Membership Functions";
                array_push($menu_items,$item);

                $item = new \stdClass();
                $item->text = "Manage service reports";
                $item->url = URL::to('/reports/service_reports/manage');
                array_push($menu_items, $item);

                $item = new \stdClass();
                $item->text = "Manage brotherhood reports";
                $item->url = URL::to('/reports/brotherhood_reports/manage');
                array_push($menu_items, $item);
            }

            if(AccessController::isService($user)){

            }

            if(AccessController::isFellowship($user)){

            }

            if(AccessController::isHistorian($user)){

            }

            if(AccessController::isSecretary($user)){

            }

            if(AccessController::isSergentAtArms($user)){

            }

            if(AccessController::isPresident($user)){

            }

            if(AccessController::isExecMember($user)){

            }


            $item = new \stdClass();
            $item->isHeader = true;
            $item->text = "Reports";
            array_push($menu_items,$item);

            //Service report menu item
            $item = new \stdClass();
            $item->text = "Submit a service report";
            $item->url = URL::to('/reports/service_reports/create');
            array_push($menu_items,$item);

            //Service report menu item
            $item = new \stdClass();
            $item->text = "Submit a brotherhood report";
            $item->url = URL::to('/reports/brotherhood_reports/create');
            array_push($menu_items,$item);

            //Service report menu item
            $item = new \stdClass();
            $item->text = "Account";
            $item->isHeader = true;
            array_push($menu_items,$item);

            //Service report menu item
            $item = new \stdClass();
            $item->text = "View Profile and Contract";
            $item->url = URL::to('/users/'.$user->id);
            array_push($menu_items,$item);

            //Service report menu item
            $item = new \stdClass();
            $item->text = "Logout";
            $item->url = URL::to('/logout');
            array_push($menu_items,$item);

            $user->menu_items = $menu_items;
        }
        return $next($request);
    }
}