<?php
require 'vendor/autoload.php';
use App\Form\FormBuilder;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");
    $inputDataArray = json_decode($json_data, true);
    if ($inputDataArray !== null) {
        $formBuilder = new FormBuilder();
        foreach ($inputDataArray as $inputData) {
            match ($inputData['type']) {
                "text" => $formBuilder->buildText(htmlspecialchars($inputData['name'])),
                "number" => $formBuilder->buildText(htmlspecialchars($inputData['name'])),
            };
            $formBuilder->getResult()->writeJson();
            header("location: /");
        }
    } else {

        http_response_code(400);
        echo "Invalid JSON data";
    }
} else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require_once("src/views/index.php");
} else {
    http_response_code(405);
    echo "Only POST and GET requests are allowed";
}
