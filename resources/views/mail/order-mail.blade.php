<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Placed Order Successfully!</h2>
    <h3>Thank you {{$mail_order['user_name']}} for shopping at Ogani!</h3>
    <h4>Your order detail is listed below, if you have any questions please contact our customer service at ogani.customerservice@gmail.com</h4>
    <div>
        <h4>Billing Details:</h4>
        <p>Phone Number: {{$mail_order['phone']}}</p>
        <p>Address: {{$mail_order['address']}}</p>
        <p>Note: {{$mail_order['note']}}</p>
    </div>

    <div>
        <h4>Order Detail:</h4>
        <p>Order ID: {{$mail_order['order_id']}}</p>
        <table border="1">
            <tr>
                <th>Products</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            <tr>
                <td>{{$mail_order['products']}}</td>
                <td>{{$mail_order['quantity']}}</td>
                <td>{{$mail_order['price']}}</td>
            </tr>
        </table>
        <p>Subtotal: {{$mail_order['subtotal']}}</p>
        <p>Total: {{$mail_order['total']}}</p>
    </div>
</body>
</html>
