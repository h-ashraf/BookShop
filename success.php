<!DOCTYPE html>
<html>
<head>
	<title>Payment Success</title>
</head>
<body>
	<h1>Payment Successful!</h1>
	<p>Your payment has been processed and approved.</p>
	<p>The last four digits of the credit card used for payment are: <?php echo htmlspecialchars($_POST['card_number'], ENT_QUOTES); ?></p>
</body>
</html>
