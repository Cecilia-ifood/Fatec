<?php
namespace App\Repository;

use App\Database\Database;
use App\Model\Produto;
use PDO;

class ProdutoRepository {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }
           public function insertProduto(Produto $produto) {
        var_dump("Chegou no insert");
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $query = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);

        return $stmt->execute();
    }

    public function getAllProdutos() {
        var_dump("Chegou no allprodutos");
        $query = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($produto_id) {
        var_dump("Chegou no getbyid");
        $query = "SELECT * FROM produtos WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduto(Produto $produto) {
        var_dump("Chegou no update");
        $produto_id = $produto->getProdutoId();
        $nome = $produto->getNome();
        $descricao = $produto->getDescricao();
        $preco = $produto->getPreco();
        $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":produto_id", $produto_id);
    
        return $stmt->execute();
    }
    
    public function deleteProduto($produto_id) {
        var_dump("Chegou no delete");
        $query = "DELETE FROM produtos WHERE produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
}    


// public function getProdutoByDescricao($descricao) {
//     var_dump("Chegou no getbydescricao");
//     $query = "SELECT * FROM produtos WHERE descricao = :descricao";
//     $stmt = $this->conn->prepare($query);
//     $stmt->bindParam(":descricao", $descricao);
//     $stmt->execute();

//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }