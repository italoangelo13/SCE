<?php

class SceCldUsu
{
    public $cod;
    public $nome;
    public $usuario;
    public $senha;
    public $user;
    public $token;

    private $chaveAdmin = '0admin2021';
    private $tokenAdmin = '28abcbf82eb191228f8550f28a574ecc';

    public function __construct()
    {
        // tratado como construtor no PHP 5.3.0-5.3.2
        // tratado como método comum a partir do PHP 5.3.3
        $cod = null;
        $nome = null;
        $usuario = null;
        $senha = null;
        $user = null;
        $token = null;
    }



    public function geraTokenUsuario($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT USUCOD,USUDATCADASTRO,USUUSUARIO FROM scetblusu WHERE USUCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            $usu = null;
            $id = null;
            $datacad = null;

            foreach ($result as $r) {
                $usu = $r->USUUSUARIO;
                $id = $r->USUCOD;
                $datacad = $r->USUDATCADASTRO;
            }

            $datacad = date('Ymd', $datacad);

            $chave = $id . $usu . $datacad;

            $tok = md5($chave);

            return $tok;
        }
    }

    public function ValidaTokenUsuario($tokenUser)
    {
        if ($tokenUser == $this->tokenAdmin) {
            return true;
        } else {
            try {
                $pdo = new PDO(server, user, senha);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $smtp = $pdo->prepare("SELECT USUUSUARIO FROM scetblusu where USUTOKEN = '$tokenUser'");
                $smtp->execute();
                $result = null;
                if ($smtp->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
    }


    public function SelecionarUsuarioPorCod($cod)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT USUNOME, USUUSUARIO FROM scetblusu WHERE USUCOD = $cod");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }

    public function DeletaUsuarioPorCod($cod)
    {
        session_start();
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT USUUSUARIO FROM scetblusu where usucod = $cod");
            $smtp->execute();
            $result = null;
            if ($smtp->rowCount() > 0) {
                $result = $smtp->fetchAll(PDO::FETCH_CLASS);
                $usuarioLogado = $_SESSION['Usuario'];
                $usuarioDel = $result[0]->USUUSUARIO;
                if ($usuarioDel == $usuarioLogado) {
                    throw new Exception('Nao e possivel deletar o usuario Logado!');
                }
            }

            $smtp = $pdo->prepare("delete from scetblusu where usucod = $cod");


            $smtp->execute();

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Verifica se Existe o Usuario
     *
     * Este Método Vai verificar se o usuário informado ja foi cadastrado anteriormente.
     * Caso Exista, Retornará true.
     *
     * @access   public
     * @return   bool
     */
    public function VerificaExisteUsuario($Usu)
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT USUUSUARIO FROM scetblusu where USUUSUARIO = '$Usu'");
            $smtp->execute();
            $result = null;
            if ($smtp->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Verifica Senha Anterior
     *
     * Este Método Vai verificar se a senha informada é a cadastrada anteriormente.
     * Caso seja, Retornará False.
     *
     * @access   public
     * @return   bool
     */
    public function VerificaSenhaAnterior($senha, $codUsu)
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT USUSENHA FROM scetblusu where USUCOD = '$codUsu'");
            $smtp->execute();
            $result = null;
            if ($smtp->rowCount() > 0) {
                $result = $smtp->fetchAll(PDO::FETCH_CLASS);
                $novaSenha = $senha;
                $senhaAnt = $result[0]->USUSENHA;
                if ($novaSenha === $senhaAnt) {
                    return false;
                }
            } else {
                return true;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function SelecionarNumUsuarios($sql)
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare($sql);
        $smtp->execute();


        return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
    }

    public function AutenticarUsuario()
    {
        $autenticacao = array();

        if (strtoupper($this->usuario) == "ADMIN" && $this->senha == "afs2021") {
            $autenticacao = [
                "Autenticado" => true,
                "Usuario" => "ADMIN",
                "Nome" => "ADMIN",
                "Id" => 0,
                "Token" => "28abcbf82eb191228f8550f28a574ecc"
            ];
        } else {

            $this->senha = md5($this->senha);
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $smtp = $pdo->prepare("SELECT USUNOME,USUUSUARIO,USUCOD,USUTOKEN FROM scetblusu WHERE USUUSUARIO = '$this->usuario' AND USUSENHA = '$this->senha'");
            $smtp->execute();
            if ($smtp->rowCount() > 0) {
                $result = $smtp->fetchAll(PDO::FETCH_CLASS);
                $usu = null;
                $nome = null;
                $id = null;
                $tokenUsuario = null;

                foreach ($result as $r) {
                    $usu = $r->USUUSUARIO;
                    $nome = $r->USUNOME;
                    $id = $r->USUCOD;
                    $tokenUsuario = $r->USUTOKEN;
                }

                $autenticacao = [
                    "Autenticado" => true,
                    "Usuario" => $usu,
                    "Nome" => $nome,
                    "Id" => $id,
                    "Token" => $tokenUsuario
                ];
            } else {
                $autenticacao = [
                    "Autenticado" => false
                ];
            }
        }

        return $autenticacao;
    }


    public function VerificaAutenticacao()
    {
        if (!isset($_SESSION['User'])) {
            echo "<script> alert('Sua Sessão Expirou, Faça o Login Novamente.');</script>";
            header("Location: login.php");
            return false;
        } else {
            return true;
        }
    }

    public function Logout()
    {
        unset($_SESSION['User']);
        header("location:login.php");
    }


    public function SelecionarUsuarios()
    {
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT
                                USUCOD,
                                USUNOME,
                                USUUSUARIO,
                                USUDATCADASTRO
                                FROM scetblusu");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }




    /**
     * Insere Usuario
     *
     * Este Método Cadastra um novo usuario.
     *
     * @access   public
     */
    public function InsereUsuario()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("INSERT INTO scetblusu
            (USUNOME
            ,USUUSUARIO
            ,USUSENHA
            ,USUDATCADASTRO
            ,USUUSER)
            VALUES('$this->nome','$this->usuario','$this->senha',CURRENT_TIMESTAMP,'$this->user')");
            $smtp->execute();
            return $result = $smtp->rowCount();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function BuscaUltimoCodPorUser()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("SELECT MAX(USUCOD) AS ULTIMO FROM scetblusu WHERE USUUSER = '$this->user'");
            $smtp->execute();
            $result = $smtp->fetchAll(PDO::FETCH_CLASS);
            return $result[0]->ULTIMO;
        } catch (Exception $e) {
            throw $e;
        }
    }



    /**
     * Atualiza Usuario
     *
     * Este Método Cadastra um novo usuario.
     *
     * @access   public
     */
    public function AtualizaUsuario()
    {
        try {
            $pdo = new PDO(server, user, senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $smtp = $pdo->prepare("UPDATE scetblusu SET
            USUNOME = '$this->nome'
            ,USUUSUARIO = '$this->usuario'
            ,USUSENHA = '$this->senha'
            WHERE USUCOD = $this->cod");
            $smtp->execute();
            return $result = $smtp->rowCount();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
