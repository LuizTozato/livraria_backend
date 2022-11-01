<?php

    //2. CRIANDO TABELA
    $sql = "CREATE TABLE IF NOT EXISTS tb_livros (
        id_livro          INTEGER PRIMARY KEY AUTO_INCREMENT,
        nome              TEXT NOT NULL,
        preco             TEXT NOT NULL,
        path_img          TEXT NOT NULL
    )";

    $pdo->exec($sql);

    //ROTA DE REQUISIÇÕES
    switch($_SERVER['REQUEST_METHOD']){
        case "POST":
            requestPost($pdo);
            break;
        
        case "GET":
            requestGet($pdo);
            break;
                    
        // case "PUT":
        //     requestPut($body, $pdo);
        //     break;
        
        // case "DELETE":
        //     requestDelete($body, $pdo);
        //     break;

    
        default:
            resposta(400, false, 'Metodo Invalido.', '');
                    
    }

    //=======================
    //FUNCOES CRUD
    function requestPost($pdo){

        //if($body->id_livro === ''){

            require_once("moverUpload.php");

            $nome_livro = $_POST["nome_livro"];
            $preco_livro = $_POST["preco_livro"];
            $pseudoName = $GLOBALS["pseudoName"];

            //CREATE
            //4. INSERINDO DADOS ANTI SQL INJECTION
            $sql = $pdo->prepare("INSERT INTO tb_livros VALUES (null,?,?,?)");

            $sql->execute(array(
                $nome_livro,
                $preco_livro,
                $pseudoName
            ));
            
            resposta(200, true, "Livro cadastrado com sucesso!", '');
        
        // } else {
            
        //     //OBTENDO OS REGISTROS DE 1 ÚNICO CLIENTE POR ID
        //     //READ
        //     $sql = $pdo->prepare("SELECT * FROM tb_livros WHERE id_livro = ?");
        //     $sql->execute([$body->id_livro]);
        //     $dados = $sql->fetch(PDO::FETCH_OBJ);

        //     resposta(200, true, "Registro de 1 único cliente lido com sucesso!", $dados);
                        
        // }

    }

    function requestGet($pdo){

        //READ
        $sql = $pdo->prepare("SELECT * FROM tb_livros");
        $sql->execute();
        $livros = $sql->fetchAll(PDO::FETCH_OBJ);

        resposta(200, true, "Registros dos clientes lidos com sucesso!", [$livros]);

    }

    // function requestPut($body, $pdo){

    //     //UPDATE
    //     //4. ATUALIZANDO DADOS ANTI SQL INJECTION
    //     $sql = $pdo->prepare("UPDATE tb_clientes SET 
    //         nome = ?,
    //         data_nascimento = ?,
    //         cpf = ?,
    //         celular = ?,
    //         email = ?,
    //         endereco = ?,
    //         observacao = ?
    //         WHERE id_cliente = ?");

    //     $sql->execute(array(
    //         $body->nome,
    //         $body->data_nascimento,
    //         $body->cpf,
    //         $body->celular,
    //         $body->email,
    //         $body->endereco,
    //         $body->observacao,
    //         $body->id_cliente
    //     ));
        
    //     resposta(200, true, "Cliente atualizado com sucesso!", '');
    // }

    // function requestDelete($body, $pdo){

    //     //DELETE
    //     //4. ATUALIZANDO DADOS ANTI SQL INJECTION
    //     $sql = $pdo->prepare("DELETE FROM tb_clientes 
    //         WHERE id_cliente = ?");

    //     $sql->execute([$body->id_cliente]);
        
    //     resposta(200, true, "Cliente excluído com sucesso!", '');        

    // }

?>