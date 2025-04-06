<?php

header('Content-Type: application/json');

if (isset($_GET['role']) && isset($_GET['prompt']) && $_GET['role'] !== '' && $_GET['prompt'] !== '') {
  $role = $_GET['role'];
  $prompt = $_GET['prompt'];

  $secretKey = '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'; // Replace with your real key
  $endpoint = 'https://api.groq.com/openai/v1/chat/completions';

  $data = [
    'model' => 'llama3-8b-8192',
    'messages' => [
      [
        'role' => 'system',
        'content' => $role
      ],
      [
        'role' => 'user',
        'content' => $prompt
      ]
    ]
  ];

  $ch = curl_init($endpoint);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $secretKey,
    'Content-Type: application/json'
  ]);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

  $response = curl_exec($ch);

  if ($response === false) {
    echo json_encode(["error" => "Curl error: " . curl_error($ch)]);
    curl_close($ch);
    exit;
  }

  curl_close($ch);
  echo $response;
} else {
  echo json_encode(["error" => "Missing required parameters"]);
}
