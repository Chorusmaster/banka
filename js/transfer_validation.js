if (window.isTransfer === 1) {
    document.getElementById("container").addEventListener("submit", validateData);
}

function validateData(event) {
    let number = document.getElementById("to").value;
    let amount = document.getElementById("amount").value;

    if (number.length === 0) {
        event.preventDefault();
        alert("Pole číslo je povinné");
        return;
    }

    if (amount.length === 0) {
        event.preventDefault();
        alert("Pole suma je povinné");
        return;
    }
}