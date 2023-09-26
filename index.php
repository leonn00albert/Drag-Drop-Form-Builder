<?php
require 'vendor/autoload.php';
use App\Form\FormBuilder;
use App\Form\Output\HtmlOutput;
use App\Form\Output\JsonOutput;
use App\Form\OutputContext;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents("php://input");
    $inputDataArray = json_decode($json_data, true);
    if ($inputDataArray !== null) {
        $formBuilder = new FormBuilder();
        foreach ($inputDataArray['inputs'] as $inputData) {
            match ($inputData['type']) {
                "text" => $formBuilder->buildText(htmlspecialchars($inputData['name'])),
                "number" => $formBuilder->buildNumber(htmlspecialchars($inputData['name'])),
                "submit" => $formBuilder->buildSubmit(htmlspecialchars($inputData['name'])),
            };
        
        }
        $outputType = match ($inputDataArray['output']) {
            "JSON" => new JsonOutput(),
            "HTML" => new HtmlOutput(),
        };
        $output = new  OutputContext();
        $output->setOutputStrategy($outputType);
        $output->setOutputType();
        $response = $output->generateOutput($formBuilder->getResult());
        print $response;
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
