<?php

namespace App\Services;

use App;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\Request;

class NotificationService extends BaseService
{
    /**
     * @param $request
     * @return bool
     */
    public function sendNotification($request ): bool
    {
        /** @var UserService $userService */
        $userService = App::make( UserService::class );
        $users = $userService->getAll();

        foreach ($users as $user){
            if($user->device_token){

                $data = [
                    "to" => $user->device_token,
                    "notification" =>
                        [
                            "title" => $request['title'],
                            "body" => [
                                $request['type'],
                                $request['body']
                            ],
                        ],
                    "data" =>
                        [
                            "title" => $request['title'],
                            "body" => [
                                $request['type'],
                                $request['body']
                            ],
                        ],
                ];
                $dataString = json_encode( $data );

                $headers = [
                    'Authorization: key=' . config( 'app.firebase_server_key' ),
                    'Content-Type: application/json',
                ];

                $ch = curl_init();

                curl_setopt( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch, CURLOPT_POST, true );
                curl_setopt( $ch, CURLOPT_FAILONERROR, true );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $dataString );

                curl_exec( $ch );
            }
        }

        return true;
    }

}
