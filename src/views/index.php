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
                <form method="POST" id="formBuilder">
                    <div class="card m-3" id="dropTarget" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">My Form</h5>

                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save form</button>
                </form>
            </div>
            <div class="col">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const dragElements = document.getElementsByClassName('draggable');
        const dropTarget = document.getElementById('dropTarget');

        class InputTemplates {
            inputText(fieldName) {
                return `
                <div class="m-3">
                    <label class="form-label">${fieldName}</label>
                    <input type="text" class="form-control place_holder input-field" name="${fieldName}" placeholder="Something here...">
                </div>
                `;
            }
            inputNumber(fieldName) {
                return `
                <div class="m-3">
                    <label class="form-label">${fieldName}</label>
                    <input type="text" class="form-control place_holder input-field" name="${fieldName}" placeholder="Some number here...">
                </div>
                `;
            }
            inputButton(fieldName) {
                return `
                <div class="m-3">
                <input type="submit" class="btn btn-primary input-field" value="${fieldName}" > 
                </div>
                `;
            }
        }

        const templates = new InputTemplates();

        Array.from(dragElements).forEach(e => {
            e.addEventListener('dragstart', (e) => {
                let element = e.target;
                let input = element.querySelector(".form-control");
                console.log(input);
                e.dataTransfer.setData('input', element.getAttribute('data-type'));
                e.dataTransfer.setData('fieldName', input.value);

            });
        })


        dropTarget.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        dropTarget.addEventListener('drop', (e) => {
            e.preventDefault();
            const input = e.dataTransfer.getData('input');
            const fieldName = e.dataTransfer.getData('fieldName');
            const droppedElement = document.createElement('div');
            var inputElement;
            switch (input) {
                case "text":
                    inputElement = templates.inputText(fieldName);
                    break;
                case "number":
                    inputElement = templates.inputNumber(fieldName);
                    break;
                case "button":
                    inputElement = templates.inputButton(fieldName);
                    break;
            }
            droppedElement.innerHTML = inputElement;

            dropTarget.appendChild(droppedElement);
        });

        document.getElementById('formBuilder').addEventListener('submit', function(event) {
            event.preventDefault();

            const inputFields = document.querySelectorAll('.input-field');
            const inputDataArray = [];

            inputFields.forEach(inputField => {
                const type = inputField.getAttribute('type');
                const name = inputField.getAttribute('name');

                const inputData = {
                    type,
                    name
                };

                inputDataArray.push(inputData);
            });
            fetch('/', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(inputDataArray),
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Data submitted successfully.');
                    } else {
                        console.error('Error submitting data.');
                    }
                })
                .catch(error => {
                    console.error('Network error:', error);
                });
        });
    </script>
</body>

</html>