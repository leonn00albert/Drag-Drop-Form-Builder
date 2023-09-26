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
            <input type="number" class="form-control place_holder input-field" name="${fieldName}" placeholder="Some number here...">
        </div>
        `;
    }
    inputButton(fieldName) {
        return `
        <div class="m-3">
        <input type="submit" class="btn btn-primary input-field" name="${fieldName}"  value="${fieldName}" > 
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
    document.getElementById('result').innerHTML = "";

    const inputFields = document.querySelectorAll('.input-field');
    const inputDataArray = {};
    inputDataArray.inputs = [];
    const selectedOutput = document.querySelector('input[name="output"]:checked').value;
    inputFields.forEach(inputField => {
        const type = inputField.getAttribute('type');
        const name = inputField.getAttribute('name');

        const inputData = {
            type,
            name
        };

        inputDataArray.inputs.push(inputData);
    });
    inputDataArray.output = selectedOutput;

    fetch('/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(inputDataArray),
        })
        .then(response => {
            if (response.ok) {
                if (response.headers.get('Content-Type').includes('application/json')) {
                    return response.json()
                        .then(data =>  {
                            const prettifiedJson = JSON.stringify(data, null, 2);
                            document.getElementById('result').innerHTML = '<pre>' + prettifiedJson + '</pre>';
                                                })
                        .catch(e => {
                            console.error('Network error:', error);

                        })
                } else {
                    return response.text()
                    .then(content =>  {
                        document.getElementById('result').innerHTML = content;
                    })
                    .catch(e => {
                        console.error('Network error:', error);

                    });
                }
               
            } else {
                console.error('Error submitting data.');
            }
        })

});

