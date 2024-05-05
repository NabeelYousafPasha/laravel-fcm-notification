<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;

class FireBasePushNotificationsController extends Controller
{
    function sendNotificationToSingleUser()
    {
        try {
            $serverKey = env('FCM_SERVER_KEY');
            $url = env('FCM_URL');
            $notification = [
                'to' => 'cBJ0Vg9YF4U-_WctyagdjashgdjhsgdDw6fldZ:APA91bG-lruPybXawiJVZksbqeqda6hAmHGUCONm_EOOSjc9fF5Ga3WapDgRhc-QY6Oau5PjDqmMzZ5jpdPR-HZculTvEcgXFDyDrEgbslr9Sc6fS2xAkfHqezw9V-vHwGAQ5P12-D0z',
                'notification' => [
                    'title' => 'Push Notification',
                    'body' => 'I am a push notification',
                ],
            ];
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ])->post($url, $notification);
            $responseBody = $response->json();
            if ($responseBody['success'] == true) {
                return $responseBody;
            }
        } catch (Exception $e) {
            echo 'unable to send notification, This user might not have allowed notifications.';
        }
    }
}
