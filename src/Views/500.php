<!DOCTYPE html>
<html lang="pt-BR">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box {
                width: 500px;
                height: 300px;
                margin: 0 auto;
                text-align: center;
            }
            .number_error {
                color: red;
                font-size: 7em;
            }
            .error_msg {
                font-size: 2em;
                color: #444;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <p class="number_error"><?php echo $code ?></p>
            <p class="error_msg"><?php echo $message ?></p>
        </div>
    </body>
</html>