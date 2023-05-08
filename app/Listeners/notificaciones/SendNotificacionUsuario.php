<?php

namespace App\Listeners\notificaciones;

use App\Events\notificaciones\FotoGuardada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificacionUsuario
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FotoGuardada $event)
    {
        $evento = $event->evento;
        $fotografia = $event->fotografia;
        $usuarios = $evento->usuarios;
        /* foreach ($usuarios as $usuario) {
            $usuario->notify(new \App\Notifications\NotificacionFoto($evento, $fotografia));
        } */
        $token = 'eJvRA_7FQfGG4IhJft6OTD:APA91bFJFIJQlS7ZSoXS5Rp75q0E5u3g_fsgo1pYfk455P7kPcBnCWJMoOgv-TOztLcjwHN0q04A70rVLyfXEsAbPyBkXMwkW7fJRrvwMBADiPw9FIxPagXtRGbDIIy3xYNdoHjbYtAW';
            $SERVER_API_KEY = 'AAAA8L747BI:APA91bHI6dlo-QWKo_PdeZFzEecQP_2AdMKQafCBF6DwMOByaqD-L740bRH5jRXuwrhxImcqS1l6xJa4z-0CUcJZBSFgwOmgT-xNUxEb7AKVP95j4haB-aFo0uf1vJRyLghN3w-yLYy8';
            $data = [
                /* "registration_ids" => $firebaseToken, */
                "registration_ids" => [$token],
                "notification" => [
                    "title" => 'Hola puto',
                    "body" => 'Un nuevo putito se ha creado',
                    "content_available" => true,
                    "priority" => "high",
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        
    }
}
