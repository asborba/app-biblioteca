<?php

class Livro {
    private $id;
    private $isbn;
    private $titulo;
    private $autor;
    private $editora;
    private $ano;

    public function __construct($id ,$isbn, $titulo, $autor, $editora, $ano) {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editora = $editora;
        $this->ano = $ano;
    }


    // GETS
    public function getId() {
        return $this->id;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function getAno() {
        return $this->ano;
    }


    // SETS
    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }
}

?>