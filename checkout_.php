<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <script src="https://www.paypal.com/sdk/js?client-id=AVn2S8pFrPWuBCmwpCJ_xwXfPzcQlIWQHIT9KY0ScOiWbiPKMqRNMMUdt2i4g5_7yOGsX5_Snamk_DGP&currency=USD"></script>

    <div id="paypal-button-container"></div>
    <script>
      paypal.Buttons({
        style:{
            color:'blue',
            shape:'pill',
            label: 'pay'
        },
        createOrder: function(data,actions){
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: '100'
                    }
                }]
            });
        },
        onApprove: function(data, actions){
            actions.order.capture().then(function(detalles){
                window.location.href="completado.html"
                console.log(detalles);
            });
        },
        onCancel: function(data){
            alert("pago cancelado");
            console.log(data)
        }
      }).render('#paypal-button-container');
    </script>
  </body>
</html>