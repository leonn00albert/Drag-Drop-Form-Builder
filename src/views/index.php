<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Form Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/public/styles.css" rel="stylesheet">
    <style>
        .draggable {
            cursor: grab;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card m-3">
                    <form method="POST" id="formBuilder">
                        <div class="card-body">
                            <h5 class="card-title">My Form</h5>
                            
                            <div class="card m-3" id="dropTarget">
                                <div class="card-body">
                                    <!-- Your form content goes here -->
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save form</button>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="JSON" name="output" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">JSON</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="output" value="HTML" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">HTML</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="card m-3 draggable" draggable="true" data-type="text" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Text</h5>
                        <div class="m-3">
                            <label class="form-label">Field name </label>
                            <input type="text" class="form-control place_holder" placeholder="Field name....">
                        </div>
                    </div>
                </div>
                <div class="card m-3 draggable" draggable="true" data-type="number" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Number</h5>
                        <div class="m-3">
                            <label class="form-label">Field name </label>
                            <input type="text" class="form-control place_holder" placeholder="Field name....">
                        </div>
                    </div>
                </div>
                <div class="card m-3 draggable" draggable="true" data-type="button" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Button</h5>
                        <div class="m-3">
                            <label class="form-label">Field name </label>
                            <input type="text" class="form-control place_holder" placeholder="Field name....">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="result"></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/public/script.js"></script>
</body>
</html>
