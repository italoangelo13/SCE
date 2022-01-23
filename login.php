<?php
header("Content-type:text/html; charset=utf8");

include_once 'Config/ConexaoBD.php';
require_once 'Models/SceCldUsu.php';
session_start();

if (isset($_SESSION['Usuario'])) {
    header('location: PainelAdm/admin.php');
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SCE - Aninha Faria Semijoias</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontello/css/fontello.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/fariamodas.css">
    <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.min.css">
    <link rel="stylesheet" href="assets/chartjs/Chart.min.css">
    <link rel="stylesheet" href="assets/jQueryte.1.4.0/jquery-te-1.4.0.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css">
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/fontawesome/js/all.min.js"></script>
    <script src="assets/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="assets/Loader/jquery.loading.min.js"></script>
    <script src="assets/Mascaras.js"></script>
    <script src="assets/chartjs/Chart.min.js"></script>
    <script src="assets/jQueryte.1.4.0/jquery-te-1.4.0.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/fariamodas.js"></script>
</head>

<body style="background: url('assets/img/bg-index.jpg');">

    <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="row text-center" style="height: 100vh;">
            <div class="col-lg-8 d-none d-sm-block text-fariamodas-gold" style="padding-top: 50px;">
                <h2 class="display-4 text-center">Transforme o dia a dia do seu Negócio!</h2>
                <h4 class="display-5 text-center">Este Produto está licenciado para:</h4>
                <br>
                <img src="assets/img/logo.png" width="100px" class="img-thumbnail img-rounded" />
                <br>
                <br>
                <h6 class="display-6 text-center">Aninha Faria Semijoias</h6>
            </div>
            <div class="col-lg-4 card">
                <div class="card-body text-center" style="border: 0px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="assets/img/Logo_Rotina_sem_Fundo.png" alt="Logo" width="100%">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>SCE - Sistema de Controle Empresarial</h5>
                            </div>
                        </div>
                        <form action="login.php" method="post">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icone-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="_edUsuario" name="_edUsuario" placeholder="Usuario">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icone-lock"></i></div>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" id="_edSenha" name="_edSenha" placeholder="Senha">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-lg-12">
                                    <button type="submit" name="login" class="btn btn-success btn-lg btn-block"><i class="icone-login-1"></i> Acessar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-footer bg-white text-center">
                    Versão <?php echo versao; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
    if (isset($_POST["login"])) {
        echo "<script>showLoad('Autenticando Usuario.');</script>";
        echo "<script>console.log('Inicio - Autenticando Usuario');</script>";

        echo "<script>console.log('Inicio - Instanciando Objeto');</script>";
        $u = new SceCldUsu();
        echo "<script>console.log('Fim - Instanciando Objeto');</script>";

        try {
            echo "<script>console.log('Inicio - Recebendo Usuario e Senha');</script>";
            $u->usuario = strtoupper($_POST["_edUsuario"]);
            $u->senha = $_POST["_edSenha"];
            echo "<script>console.log('Fim - Recebendo Usuario e Senha');</script>";

            echo "<script>console.log('Inicio - Autenticando Usuario');</script>";
            $ret = $u->AutenticarUsuario();
            echo "<script>console.log('Fim - Autenticando Usuario');</script>";

            echo "<script>console.log('Inicio - Validando Autenticação');</script>";
            if ($ret["Autenticado"]) {
                echo "<script>console.log('Usuario Autenticado com Sucesso');</script>";
                $_SESSION["User"] = $ret["Usuario"];
                $_SESSION["NomeUsuario"] = $ret["Nome"];
                $_SESSION["CodUsuario"] = $ret["Id"];
                echo "<script>console.log('Redirecionando Usuario.');</script>";
                echo "<script>setTimeout(() => {window.location.href = 'index.php'}, 5000);</script>";
              //  echo "<script>window.location.href = 'index.php';</script>";
            } else {
                echo "<script>hideLoad();</script>";
                echo "<script>WarningBox('Não foi possivel autenticar este usuario.');</script>";
            }
            echo "<script>console.log('Fim - Validando Autenticação');</script>";
        } catch (Exception $e) {
            echo "<script>hideLoad();</script>";
            echo "<script>ErrorBox('" . $e->getMessage() . "');</script>";
        }
        echo "<script>console.log('Fim - Autenticando Usuario);</script>";
    }
?>