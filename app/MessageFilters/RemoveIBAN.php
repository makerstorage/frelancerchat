<?php

namespace App\MessageFilters;

use Closure;
use Illuminate\Pipeline\Pipeline;

class RemoveIBAN 
{
    public function handle($content, Closure $next)
    {
   
        // Here you perform the task and return the updated $content
        $content = str_ireplace('iban','',$content);
        // to the next pipe
        return  $next($content);
    }
}