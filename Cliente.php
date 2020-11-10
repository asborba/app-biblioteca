<?php

class Cliente {
    private $matricula;
    private $nome;
    private $telefone;

    // pra inicializar a classe, precisa de um construtor
    public function __construct($matricula, $nome, $telefone) {
        
        //atribuir a matrícula da classe a matrícula do construct (e demais variáveis)
        $this->matricula = $matricula;
        $this->nome = $nome;
        $this->telefone = $telefone;
    }

    // GETS
    public function getMatricula() {
        return $this->matricula;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }


    // SETS - permite alteração depois do objeto
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    
}

?>