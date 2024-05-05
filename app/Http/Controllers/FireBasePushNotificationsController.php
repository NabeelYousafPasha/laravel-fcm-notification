<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;

class FireBasePushNotificationsController extends Controller
{
    function sendNotificationToSingleUser()
    {
        try {
            $serverKey = 'AAAA1xEyLFE:APA91bF-ZbHcLu5mUZ1hz13hD-RC0dXk7UAz7JuPeHG43OYD05mge5S17Ko5-FXux1HSkapG_SJPleYQMy91-cLvEPoxG9ITDrELjlagbdPjZOMpcvVpJ2DjBL_o9jW-L1pfYuBwLtlb';
            $url = 'https://fcm.googleapis.com/fcm/send';
            $notification = [
                'to' => 'ceqINY-SznZl50IEk0AQD8:APA91bF5Oyuazb4jzs3xd2CqGlRyFlalGwmWSREVqvdfweU4Gy9JcMI9UFaxlcRVxiHEhk-7sLVa1_4u-7Bitum2R45SVrC31_kNpHi6zCYD2E9rl13V7AeabT_dTI52P68zPqYcAHnw',
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
