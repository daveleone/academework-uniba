<?php

/* Non serve più perchè ho integrato in quizzescontroller


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClassEmail;

class EmailController extends Controller
{
    public function ClassEmail(){
        $toEmail = 'pepperdanilo@gmail.com';
        $message = 'È stata assegnato il quiz: alla tua classe:';
        $response = Mail::to($toEmail)->send(new ClassEmail($message));
        dd($response);
    }
}
*/