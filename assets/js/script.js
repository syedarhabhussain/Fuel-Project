var defaultLogins = [
	{ username: "user", password: "12345678" },
	{ username: "admin", password: "12345678" },
];

function validateLogin() {
	var user = document.forms["loginForm"]["username"].value;
	var pass = document.forms["loginForm"]["password"].value;
	var errorMessage = document.getElementById("error-message");

	if (user.trim() === '' || pass.trim() === '') {
		errorMessage.textContent = 'Please enter both username and password.';
		return false;
	}
	return true;
}

function validateRegister() {
    var user = document.forms["registerForm"]["username"].value;
    var pass = document.forms["registerForm"]["password"].value;
    var errorMessage = document.getElementById("error-message");

    if (user.trim() === '' || pass.trim() === '') {
        errorMessage.textContent = 'Please enter both username and password.';
        return false;
    } 
	return true;
}


function validateProfile() {
	let errors = [];
	let fullName = document.forms["profileForm"]["fullName"].value;
	let address1 = document.forms["profileForm"]["address1"].value;
	let address2 = document.forms["profileForm"]["address2"].value;
	let city = document.forms["profileForm"]["city"].value;
	let state = document.forms["profileForm"]["state"].value;
	let zipCode = document.forms["profileForm"]["zipCode"].value;
	var errorMessage = document.getElementById("error-message");

	if (fullName.length < 1 || fullName.length > 50) {
		errors.push("Full Name must be between 1 and 50 characters.");
	}
	if (address1.length > 100) {
		errors.push("Address 1 must be less than 100 characters.");
	}
	if (address2.length > 100) {
		errors.push("Address 2 must be less than 100 characters.");
	}
	if (city.length > 100) {
		errors.push("City must be less than 100 characters.");
	}
	if (!state) {
		errors.push("State must be selected.");
	}
	if (zipCode.length < 5 || zipCode.length > 9) {
		errors.push("Zip code must be between 5 and 9 characters.");
	}

	if (errors.length > 0) {
		errorMessage.innerHTML = errors.join("<br>");
		errorMessage.style.display = 'block';
		return false;
	} else {
		errorMessage.innerHTML = '';
		errorMessage.style.display = 'none';
	}
	return true;
}


function updateProfile() {
	return true;
}

function storeFuelQuote() {
    var gallonsRequested = document.getElementById('gallonsRequested').value;
    var deliveryAddress = document.getElementById('deliveryAddress').value;
    var deliveryDate = document.getElementById('deliveryDate').value;
    var suggestedPrice = document.getElementById('suggestedPrice').value;
    var totalAmountDue = document.getElementById('totalAmountDue').value;

    var fuelQuote = {
        gallonsRequested: gallonsRequested,
        deliveryAddress: deliveryAddress,
        deliveryDate: deliveryDate,
        suggestedPrice: suggestedPrice,
        totalAmountDue: totalAmountDue
    };

    var fuelQuotes = JSON.parse(localStorage.getItem('fuelQuotes')) || [];
    fuelQuotes.push(fuelQuote);
    localStorage.setItem('fuelQuotes', JSON.stringify(fuelQuotes));
    return true;
}

