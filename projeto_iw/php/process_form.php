<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPI_2";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


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


$stmt = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Erro: Este e-mail já está cadastrado.'); window.location.href = '../index.html';</script>";
} else {

    $stmt = $conn->prepare("INSERT INTO usuario (nome, nascimento, email, telefone, cep, endereco, cpf, rg, senha, assunto, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nome, $nascimento, $email, $telefone, $cep, $endereco, $cpf, $rg, $senha, $assunto, $mensagem);

    if ($stmt->execute()) {
        echo "<script>
                var myModal = new bootstrap.Modal(document.getElementById('successModal'), {});
                myModal.show();
                setTimeout(function() {
                    window.location.href = '../index.html';
                }, 3000);
              </script>";
    } else {
        echo "Erro: " . $stmt->error;
    }
}


$stmt->close();
$conn->close();
?>
