<!-- i have a secret key : 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

curl -X POST "https://api.groq.com/openai/v1/chat/completions" \
     -H "Authorization: Bearer $GROQ_API_KEY" \
     -H "Content-Type: application/json" \
     -d '{"messages": [{"role": "user", "content": "Explain the importance of fast language models"}], "model": "llama-3.3-70b-versatile"}'


send prompt and get data in JSON format in php -->

<?php

$apiKey = "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";

$url = "https://api.groq.com/openai/v1/chat/completions";

$data = [
    "messages" => [
        [
            "role" => "system",
            "content" => "You are a helpful and knowledgeable doctor. Answer questions with medical insight, using clear and empathetic explanations."
        ],
        [
            "role" => "user",
            "content" => "i have fever and headache. what should i do?"
        ]
    ],
    "model" => "llama3-70b-8192" // ✅ corrected model name
];

$headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo "Curl error: " . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
}

curl_close($ch);

?>


