<?php
namespace SpiritSystems\DayByDay\Contacts\Pipes;

use Illuminate\Support\Facades\Auth;

class MenuProviderPipe {

    public function handle($menuItems, $next){
        
        return $next($menuItems);
    }
}