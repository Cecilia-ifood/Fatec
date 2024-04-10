<?php
namespace App\Model;
class Usuario {
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $criado;
    private string $datanascimento;
    public $conn;

    public function __construct() {
        $this->conn = new Model();
        $this->conn->createTableFromModel($this);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getCriado() {
        return $this->criado;
    }

    public function setCriado($criado) {
        $this->criado = $criado;
    }

    public function getDataNascimento() {
        return $this->datanascimento;
    }

    public function setDataNascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }    

    public function getType() {
        return 'User';
    }

    public function toArray() {
        return [
            'id' => $this->getId(), 
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'senha' => $this->getSenha(),
            'criado' => $this->getCriado(),
            'datanascimento' => $this->getDataNascimento(),  
            'type' => $this->getType()
        ];
    }
}
