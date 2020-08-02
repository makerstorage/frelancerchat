<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;


class MessageController extends Controller
{
	public function mesajKontrol($message)
    {
       $myMessage = app(Pipeline::class)
                ->send($message)
                ->through([
                    \App\MessageFilters\RemoveIBAN::class
                ])
                ->thenReturn();
               
        return $myMessage;
    }


    public function test(Request $request)
    {   	
    	$message = $this->mesajKontrol($request->message);
    	return $message;
    }
}

