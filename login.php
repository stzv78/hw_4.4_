<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .colorgraph {
            height: 5px;
            border-top: 0;
            background: #c4e17f;
            border-radius: 5px;
            background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
    </style>
    <title>Вход/Регистрация</title>   
</head>
<body>
    <div class="container">
        <div class="row">
                <div class="col-xs-8 col-md-4 col-sm-offset-3 col-md-offset-4">
                    <form role="form" action="index.php" method="POST">
                        <h2>Вход / регистрация</h2>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <input type="login" name="login" id="login" class="form-control input-lg" placeholder="Введите логин" required>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Введите пароль" required>
                                </div>
                            </div>
                        </div>
                        <hr class="colorgraph">
                        <div class="row" >
                            <div class="col-xs-12 col-md-6">
                                <input type="submit" name="sign_in" class="btn btn-success btn-block btn-lg" value="Вход">
                            </div>
                       
                            <div class="col-xs-12 col-md-6">
                                <input type="submit" name="register" class="btn btn-primary btn-block btn-lg" value="Регистрация">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
         </div>
</body>
</html>

