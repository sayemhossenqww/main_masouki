<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Pusher\PushNotifications\PushNotifications;

class PushNotificationController extends Controller
{

    const DEVICE_INTEREST = "news";

    public function show()
    {
        return view('admin.push-notifications.show');
    }


    public function publishNotification(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:65', 'string'],
            'description' => ['required', 'max:240', 'string'],
        ]);


        $beamsClient = new PushNotifications(array(
            "instanceId" => "011c1c62-4c36-44be-a41e-00f953686b94", //(string) env('PUSHER_INSTANCE_ID'),
            "secretKey" => "E2850FE17F0BA0D04F63F3DBD148C1532FDFA2C851129D82347F6F99830EF3C3" //(string) env('PUSHER_PRIMARY_KEY'),
        ));

        $publishResponse = $beamsClient->publishToInterests(
            array(self::DEVICE_INTEREST),
            array(
                "fcm" => array("notification" => array(
                    "title" => $request->title,
                    "body" => $request->description,
                )),
            )
        );

        return Redirect::back()->with('success', 'Notification has been sent');
    }
}
