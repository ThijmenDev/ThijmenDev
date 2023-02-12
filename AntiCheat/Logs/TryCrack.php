<?php

$webhookurl = "https://discord.com/api/webhooks/1069726720778842142/NcqICuyhQxTcXmPeU0HGeYvoE1if8k4KqKHjl1NOUgmQEaPtVNxz8xMoZKdxwBvzsq4G";


$IP  = $_SERVER['REMOTE_ADDR'];


$ResourceName  = $_GET['Res'];


$License  = $_GET['License'];





$timestamp = date("c", strtotime("now"));

$json_data = json_encode([

    "username" => "Cronox AC",

    "tts" => false,


    "embeds" => [
        [
            // Embed Title
            "title" => "Try To Crack",

            // Embed Type
            "type" => "rich",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "ff0000" ),

            // Author
            "author" => [
                "name" => "✨ Cronox AntiCheat ✨",
                "icon_url" => "https://media.discordapp.net/attachments/1068598400561463317/1069726559046484078/39F15152-DEA6-4F77-AD45-4697646C43E3.png"
            ],

            // Additional Fields array
            "fields" => [
                // Field 1
                [
                    "name" => "Real IP :",
                    "value" => $IP,
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "ResourceName :",
                    "value" => $ResourceName,
                    "inline" => true
                ],
                [
                    "name" => "License :",
                    "value" => $License,
                    "inline" => false
                ],
                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );