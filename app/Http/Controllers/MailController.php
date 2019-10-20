<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function correo(){
        $file = \Excel::create("Waiting unvalidated Accounts -".Carbon::now()->getTimestamp(),
            function (LaravelExcelWriter $excel) use ($summary) {
                $excel->sheet('bookings', function (LaravelExcelWorksheet $sheet) use ($summary) {
                    $sheet->fromArray($summary);
                });
            });

        \Mail::send('email.prueba',["data"=>"Report unvalidated Accounts"],function($m) use($file){
            $m->to('josueperezf@gmail.com')->subject('Report unvalidated Accounts');
            $m->attach($file->store("xls",false,true)['full']);
        });

        /*
        Mail::send('email.prueba',[],function($msj){
            $msj->subject('correo de contacto');
            $msj->to('josueperezf@gmail.com');
            $msj->cc(['josueperezf@hotmail.com','contraremalparido@gmail.com']);
            //$message->to('josueperezf@gmail.com', 'Josue Perez')->from('josueperezf@hotmail.com')->subject('Envio');
        });
        */
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
