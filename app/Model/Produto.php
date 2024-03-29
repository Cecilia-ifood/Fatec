<?php
namespace App\Model;
class Produto {
    private $produto_id;
    private $nome;
    private $descricao;
    private $preco;

    public function getProdutoId(){
        return $this->produto_id;
    }

    public function setProdutoId($produto_id): self{
        $this->produto_id = $produto_id;

        return $this;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome): self{
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao): self{
        $this->descricao = $descricao;

        return $this;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco): self {
        $this->preco = $preco;
        return $this;
    }
}
