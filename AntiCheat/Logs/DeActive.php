<?php

$webhookurl = "https://discord.com/api/webhooks/1069725181213417512/e7eEGtdoysGfLO6lYUw76tkE26g-aTBA8gCNkvd7yZPqmGwx0PL73WlUOdAnWLEVoCP1";


$IP  = $_GET['IP'];
$IP = $conn->real_escape_string($IP);

$ResourceName  = $_GET['ResourceName'];
$ResourceName = $conn->real_escape_string($ResourceName);

$License  = $_GET['License'];
$License = $conn->real_escape_string($License);




$timestamp = date("c", strtotime("now"));

$json_data = json_encode([

    "username" => "Pixel AC",

    "tts" => false,


    "embeds" => [
        [
            // Embed Title
            "title" => "De Active",

            // Embed Type
            "type" => "rich",

            // Timestamp of embed must be formatted as ISO8601
            "timestamp" => $timestamp,

            // Embed left border color in HEX
            "color" => hexdec( "ff0000" ),

            // Author
            "author" => [
                "name" => "✨ PIXEL AntiCheat ✨",
                "icon_url" => "https://media.discordapp.net/attachments/892109712693284905/894977291791269968/pixelanticheatlogo.png"
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