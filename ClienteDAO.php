<?php

require_once('Cliente.php');

class ClienteDAO {
    private $pdo;

    public function __construct() {
        //conexão com o banco
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databasename = "biblioteca";

        try {
            $this->pdo = new PDO("mysql:host=$servername; dbname=$databasename", $username, $password);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    //INSERIR
    function inserir(Cliente $cliente) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, telefone) VALUES (:nome, :telefone)");
            $stmt->bindValue(':nome', $cliente->getNome());
            $stmt->bindValue(':telefone', $cliente->getTelefone());
            $stmt->execute();
        }
        
        catch(PDOException $e) {
            echo "Statement failed: " . $e->getMessage();
        
        }   
    }


    //LISTAR
    function listar() {
        $listaClientes = array();

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes");
            $stmt->execute();

            $listaClientes = $stmt->fetchAll(
                //fetch_props chama o construtor 1º e depois atribui os valores do banco
                PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
                return $listaClientes;
    }

        catch(PDOException $e) {
        echo "Statement failed: " . $e->getMessage();
        }
    }


    //BUSCAR POR MATRÍCULA
    function buscarMatricula($matricula) {
        $qBuscaMat = "SELECT * FROM clientes WHERE matricula=:matricula";
        $comando = $this->pdo->prepare($qBuscaMat);
        $comando->bindParam(":matricula", $matricula);
        $comando->execute();
        $comando->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
        $obj = $comando->fetch();
        return($obj);
    }


    //DELETAR
    function deletar($matricula) {
        $qDeletar = "DELETE FROM clientes WHERE matricula=:matricula";
        $comando = $this->pdo->prepare($qDeletar);
        $comando->bindParam(':matricula', $matricula);
        $comando->execute();
    }


    //ATUALIZAR
    function atualizar($matricula, Cliente $clienteAlterado) {
        $qAtualizar = "UPDATE clientes SET nome=:nome, telefone=:telefone WHERE matricula=:matricula";
        $comando = $this->pdo->prepare($qAtualizar);
        
        $comando->bindValue(":nome", $clienteAlterado->getNome());
        $comando->bindValue(":telefone", $clienteAlterado->getTelefone());
        $comando->bindParam(":matricula", $matricula);
        $comando->execute();
    }

}

?>