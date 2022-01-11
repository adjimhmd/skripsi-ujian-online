<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Mail\LatihanEmail; //import juga LatihanEmail
use Illuminate\Support\Facades\Mail; //jangan lupa import ini
    
class EmailController extends Controller
{
    public function index(){

        //isi Mail::to(...) dengan email tujuan yang kalian inginkan
        // Mail::to($tujuan)->send(new LatihanEmail());
        $data = array('name'=>"Adji");

        Mail::send('AdminLTE/nilai-ujian-email', $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
                ('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";

    }
}