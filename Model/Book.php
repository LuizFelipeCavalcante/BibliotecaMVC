<?php
class Book {
    protected $id;
    protected $nome;
    protected $autor;
    protected $genero;
    protected $estoque;
    protected $dataEntrada;
    protected $dataSaida;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function getDataEntrada() {
        return $this->dataEntrada;
    }

    public function getDataSaida() {
        return $this->dataSaida;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function setDataEntrada($dataEntrada) {
        $this->dataEntrada = $dataEntrada;
    }

    public function setDataSaida($dataSaida) {
        $this->dataSaida = $dataSaida;
    }
}
