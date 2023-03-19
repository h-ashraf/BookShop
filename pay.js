function validateForm() {
			var cardNum = document.getElementById("cardNum").value;
			var expMonth = document.getElementById("expMonth").value;
			var expYear = document.getElementById("expYear").value;
			var secCode = document.getElementById("secCode").value;
			var cardRegex = /^(5[1-5][0-9]{14})$/; // Regex for Mastercard
			var secCodeRegex = /^[0-9]{3,4}$/; // Regex for 3 or 4 digit security code
			var isValid = true;

			// Validate credit card number
			if (!cardNum.match(cardRegex)) {
				alert("Invalid credit card number. Please enter a valid Mastercard number.");
				isValid = false;
			}

			// Validate expiry date
			var today = new Date();
			var expDate = new Date(expYear, expMonth, 0);
			if (expDate < today) {
				alert("Credit card has expired. Please enter a valid expiry date.");
				isValid = false;
			}

			// Validate security code
			if (!secCode.match(secCodeRegex)) {
				alert("Invalid security code. Please enter a 3 or 4 digit security code.");
				isValid = false;
			}

			return isValid;
		}