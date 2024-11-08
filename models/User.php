<?php
require_once 'inc/Singleton.php';

class User
{

    private $email;
    private $passwd;
    private $id;
    private $mac;
    private $fecha_baja;
    private $rol;

    function __construct($email = null, $passwd = null, $id = null, $mac = null, $fecha_baja = null, $rol = null)
    {
        $this->email = $email;
        $this->passwd = $passwd;
        $this->id = $id;
        $this->mac = $mac;
        $this->fecha_baja = $fecha_baja;
        $this->rol = $rol;
    }


    public function comprobarCredenciales($email, $passwd)
    {
        $pdo = Singleton::getInstance()->getPDO();

        $statement = $pdo->prepare("select * from usuario where correo='$email' and contrasena='$passwd'");
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!isset($data)) {
            session_start();
            $_SESSION["email"] = $data[0]["email"];
        }

        return count($data) > 0;
    }
}
