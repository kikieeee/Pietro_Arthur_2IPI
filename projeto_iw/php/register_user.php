<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "IPI_2";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO usuario (nome, nascimento, email, telefone, cep, endereco, cpf, rg, senha, assunto, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nome, $nascimento, $email, $telefone, $cep, $endereco, $cpf, $rg, $senha, $assunto, $mensagem);


    if ($stmt->execute()) {
        echo "<script>
                var myModal = new bootstrap.Modal(document.getElementById('successModal'), {});
                myModal.show();
              </script>";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
