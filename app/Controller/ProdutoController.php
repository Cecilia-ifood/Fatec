<?php
namespace App\Controller;

use App\Model\Produto;
use App\Repository\ProdutoRepository;

class ProdutoController {
    private $repository;

    public function __construct(ProdutoRepository $repository) {
        $this->repository = $repository;
    }
   
       public function create($data) {
        if (!isset($data->nome, $data->descricao, $data->preco)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para a criação do usuário."]);
            return;
        }
        
  
        $produto = new Produto();
        $produto->setNome($data->nome)->setDescricao($data->descricao)->setPreco($data->preco);

        if ($this->repository->insertProduto($produto)) {
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar usuário."]);
        }
    }

    public function read($id = null) {
        if ($id) {
            $result = $this->repository->getProdutoById($id);
            unset($result['id']);
            $status = $result ? 200 : 404;
        } else {
            $result = $this->repository->getAllProdutos();
            foreach ($result as &$produto) {
                unset($produto['id']);
            }
            unset($produto);
            $status = !empty($result) ? 200 : 404;
        }

        http_response_code($status);
        echo json_encode($result ?: ["message" => "Nenhum usuário encontrado."]);
    }

    public function update($data) {
        if (!isset($data->produto_id, $data->nome, $data->descricao, $data->preco)) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos para atualização do usuário."]);
            return;
        }

        $produto = new Produto();
        $produto->setProdutoId($data->produto_id)->setNome($data->nome)->setDescricao($data->descricao)->setPreco($data->preco);

        if ($this->repository->updateProduto($produto)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar usuário."]);
        }
    }

    public function delete($id) {
        if ($this->repository->deleteProduto($id)) {
            http_response_code(200);
            echo json_encode(["message" => "Usuário excluído com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir usuário."]);
        }
    }
}


// public function login($data) {
//     if (!isset($data->descricao, $data->preco)) {
//         http_response_code(400);
//         echo json_encode(["error" => "Descricao e preco são necessários para o login."]);
//         return;
//     }

//     $produto = $this->repository->getProdutoByDescricao($data->descricao);
//     if ($produto && password_verify($data->preco, $produto['preco'])) {
//         unset($produto['preco']);
//         http_response_code(200);
//         echo json_encode(["message" => "Login bem-sucedido.", "produto" => $produto]);
//     } else {
//         http_response_code(401); 
//         echo json_encode(["error" => "Descricao ou preco inválidos."]);
//     }
// }