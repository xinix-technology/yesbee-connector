<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Billing Payment</title>
	<script src="js/socket.io-1.2.0.js"></script>
	<script src="js/jquery-1.11.1.js"></script>
</head>
<body>
	<img src="http://chart.apis.google.com/chart?chs=200x200&cht=qr&chld=|1&chl=1234432%3A123mu734fsdf%3Afasiuoewyr" alt="QR Code" />

	<script>

		var TAG = "SOCKETIO:: ";
		$(function() {

			var socket = io('http://localhost:4000');

			socket.on('connect', function() {

				console.log(TAG, "connected");

				console.log(TAG, socket.io.engine.id);
				var param = <?php echo json_encode($parameter); ?>;

				console.log(param);
				socket.emit('checkout-wait-for-payment', param);

				socket.on('udah-bayar', function() {

				});

				socket.on('checkout-paid', function(data) {
					console.log(data);
					alert('hello guys, your payment is paid just now.');
					// console.log(TAG, 'hello guys, your payment is paid just now.');
				});

				socket.on('disconnect', function() {
					console.log(TAG, 'disconnected');
				});

			});

		});

	</script>
</body>
</html>