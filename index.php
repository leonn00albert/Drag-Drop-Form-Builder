<?php


?>
<!doctype html>
<html lang="en">

<head>

    <style>
        .draggable {

            cursor: grab;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container text-center">
        <div class="row">

            <div class="col">
                <form>
                    <div class="card m-3" id="dropTarget" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">My Form</h5>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="card m-3 draggable" draggable="true" data-type="text" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Text</h5>

                    </div>
                </div>
                <div class="card m-3 draggable" draggable="true" data-type="number" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Number</h5>

                    </div>
                </div>
                <div class="card m-3 draggable" draggable="true" data-type="dropdown" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const dragElements = document.getElementsByClassName('draggable');
        const dropTarget = document.getElementById('dropTarget');

        class InputTemplates {
            inputText() {
                return `
                <div class="m-3">
                    <label class="form-label">Text </label>
                    <input type="text" class="form-control place_holder" name="input" placeholder="Field name....">
                </div>
                `;
            }
            input() {
                return `
                <div class="m-3">
                    <label class="form-label">Text </label>
                    <input type="number" class="form-control place_holder" name="input" placeholder="Field name....">
                </div>
                `;
            }
        }

        const templates = new InputTemplates();

        Array.from(dragElements).forEach(e => {
            e.addEventListener('dragstart', (e) => {
                console.log(e);
                e.dataTransfer.setData('input', e.target.getAttribute('data-type'));
            });
        })


        dropTarget.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        dropTarget.addEventListener('drop', (e) => {
            e.preventDefault();
            const data = e.dataTransfer.getData('input');

            const droppedElement = document.createElement('div');
            var inputElement;
            switch (data) {
                case "text":
                    inputElement = templates.inputText();
                    break;
                case "text":
                    inputElement = templates.inputText();
                    break;
            }
            droppedElement.innerHTML = inputElement;

            dropTarget.appendChild(droppedElement);
        });
    </script>
</body>

</html>