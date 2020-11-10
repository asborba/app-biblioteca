<?php

require_once('Livro.php');

class LivroDAO {
    private $pdo;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databasename = "biblioteca";

        try {
            $this->pdo = new PDO("mysql:host=$servername; dbname=$databasename", $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    // INSERIR
    function inserir(Livro $livro) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO livros (isbn, titulo, autor, editora, ano) VALUES (:isbn, :titulo, :autor, :editora, :ano)");
            $stmt->bindValue(':isbn', $livro->getIsbn());
            $stmt->bindValue(':titulo', $livro->getTitulo());
            $stmt->bindValue(':autor', $livro->getAutor());
            $stmt->bindValue(':editora', $livro->getEditora());
            $stmt->bindValue(':ano', $livro->getAno());
            $stmt->execute();
        }
        catch(PDOException $e) {
            echo "Statement failed: " . $e->getMessage();
        }
    }


    // LISTAR
    function listar() {
        $listaLivros = array();

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM livros");
            $stmt->execute();

            $listaLivros = $stmt->fetchAll(
                PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
                return $listaLivros;
        }
        catch(PDOException $e) {
            echo "Statement failed: " . $e->getMessage();
        }
    }


    // BUSCAR POR ID
    function buscarId($id) {
        $qBuscaId = "SELECT * FROM livros WHERE id=:id";
        $comando = $this->pdo->prepare($qBuscaId);
        $comando->bindParam(":id", $id);
        $comando->execute();
        $comando->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE);
        $obj = $comando->fetch();
        return($obj);
    }


    // DELETAR
    function deletar($id) {
        $qDeletar = "DELETE FROM livros WHERE id=:id";
        $comando = $this->pdo->prepare($qDeletar);
        $comando->bindParam(":id", $id);
        $comando->execute();
    }


    // ATUALIZAR
    function atualizar($id, Livro $livroAlterado) {
        $qAtualizar = "UPDATE livros SET isbn=:isbn, titulo=:titulo, autor=:autor, editora=:editora, ano=:ano WHERE id=:id";
        $comando = $this->pdo->prepare($qAtualizar);
        
        $comando->bindValue(":isbn", $livroAlterado->getIsbn());
        $comando->bindValue(":titulo", $livroAlterado->getTitulo());
        $comando->bindValue(":autor", $livroAlterado->getAutor());
        $comando->bindValue(":editora", $livroAlterado->getEditora());
        $comando->bindValue(":ano", $livroAlterado->getAno());
        $comando->bindParam(":id", $id);
        
        $comando->execute();
    }
}

?>