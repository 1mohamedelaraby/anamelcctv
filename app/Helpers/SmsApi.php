<?php

namespace App\Helpers;

class SmsApi
{
    public static function send($phone, $message)
    {
        $phone = is_array($phone) ? emplode(',', $phone) : $phone;

        $data1 = [
            "Username"     => '0557259988',
            "Password"    => 'AttA7226500',
            "Tagname"    => 'ANAMEL-CCTV',
            "RecepientNumber" => $phone,
            "Message"     => $message,
            "EnableDR"    => false
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.yamamah.com/SendSMS",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);


        $r = curl_close($curl);
    }
}
