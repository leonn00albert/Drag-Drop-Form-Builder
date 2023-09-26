<?php

namespace App\Form\Output;

use App\Form\Interface\OutputStrategy;
use App\Form\Form;
class HtmlOutput implements OutputStrategy
{
    public function generateOutput(Form $data):string
    {
        $bootstrap = (object) [
            "link" => "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css",
            "integrity "=> "sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        ];
        $elements = $data->elements;
        $output = "<html><body><form>";
        $output .= '<div class="card m-3">';
        $output .= '<div class="card-body"><h5 class="card-title">My Form</h5>';

        foreach ($elements as $input) {
            if ($input->type === 'submit') {
                $output .= '
                <div class="m-3">
                    <input type="submit" class="form-control btn btn-primary input-field" value="' . $input->name . '" placeholder="...">
                 </div>
                ';
            } else {
                $output .= '
                <div class="m-3">
                    <label class="form-label">' . $input->name . '</label>
                    <input type="' . $input->type . '" class="form-control place_holder input-field" value="' . $input->name . '" placeholder="...">
                 </div>
                ';
            }
        }
        $output .= '</div></div></form></body></html>';
        return $output;
    }

    public function setOutputType()
    {
        header('Content-Type: text/html');
    }
}
