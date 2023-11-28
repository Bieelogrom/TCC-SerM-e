<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="img-head" rel="icon" href="../../img/siteSerMae/bemvinda/serMãe.png">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/ADMIN/login.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="login">
        <div class="mainLogin">
            <div class="left">
                <img src="../../img/ADMIN/login/SerMãe.png" alt="">
            </div><!-- Fim Left -->
            <div class="right">
                <h2>Login Administração</h2>
                <form action="#">
                    <div class="email">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email">
                        <div class="icon">
                            <i class='bx bx-envelope'></i>
                        </div>
                    </div><!-- Fim Email -->
                    <div class="senha">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                        <div class="icon">
                            <i class='bx bx-lock-alt'></i>
                        </div>
                    </div><!-- Fim Senha -->
                    <input type="submit" class="BtnLogin" value="Login">
                </form>
            </div><!-- Fim Right -->
        </div><!-- Fim MainLogin -->
    </div>
</body>
</html>