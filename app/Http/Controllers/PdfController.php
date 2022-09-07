<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
class PdfController extends Controller
{
    //
    public function pdf()
    {
        $data["email"] = Auth::user()->email;
        $data["name"] = Auth::user()->name;
        $data["body"] = "This is demo project ... ";
  
        $pdf = PDF::loadView('print.email', $data);
        Mail::send('print.email', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["name"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  
        dd('Mail sent successfully');
    }
}
