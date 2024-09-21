<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IPI_2";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


function getPostValue($key) {
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

$nome = getPostValue('nome');
$nascimento = getPostValue('nascimento');
$email = getPostValue('email');
$telefone = getPostValue('telefone');
$cep = getPostValue('cep');
$endereco = getPostValue('endereco');
$cpf = getPostValue('cpf');
$rg = getPostValue('rg');
$senha = getPostValue('senha') ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;
$assunto = getPostValue('assunto');
$mensagem = getPostValue('mensagem');




$stmt = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


    $stmt = $conn->prepare("INSERT INTO usuario (nome, nascimento, email, telefone, cep, endereco, cpf, rg, senha, assunto, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nome, $nascimento, $email, $telefone, $cep, $endereco, $cpf, $rg, $senha, $assunto, $mensagem);




$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pietro Henrique e Arthur Faguette">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Mostrar informações cadastradas</title>
</head>

<body>
    <section class="form-wrapper">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Parabéns, o cadastro foi concluído com sucesso!</h1>

            <h3>Aqui estão suas informações cadastradas:</h3>

            <ul style="list-style-type: none;">
                <li><strong>Nome:</strong> <?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?></li>
                <li><strong>E-mail:</strong> <?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></li>
                <li><strong>Data de Nascimento:</strong> <?php echo isset($_POST['nascimento']) ? htmlspecialchars($_POST['nascimento']) : ''; ?></li>
                <li><strong>Telefone:</strong> <?php echo isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : ''; ?></li>
                <li><strong>CEP:</strong> <?php echo isset($_POST['cep']) ? htmlspecialchars($_POST['cep']) : ''; ?></li>
                <li><strong>Endereço:</strong> <?php echo isset($_POST['endereco']) ? htmlspecialchars($_POST['endereco']) : ''; ?></li>
                <li><strong>Bairro:</strong> <?php echo isset($_POST['bairro']) ? htmlspecialchars($_POST['bairro']) : ''; ?></li>
                <li><strong>Cidade:</strong> <?php echo isset($_POST['cidade']) ? htmlspecialchars($_POST['cidade']) : ''; ?></li>
                <li><strong>Estado:</strong> <?php echo isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : ''; ?></li>
                <li><strong>CPF:</strong> <?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : ''; ?></li>
                <li><strong>RG:</strong> <?php echo isset($_POST['rg']) ? htmlspecialchars($_POST['rg']) : ''; ?></li>
                <li><strong>Assunto:</strong> <?php echo isset($_POST['assunto']) ? htmlspecialchars($_POST['assunto']) : ''; ?></li>
                <li><strong>Mensagem:</strong> <?php echo isset($_POST['mensagem']) ? htmlspecialchars($_POST['mensagem']) : ''; ?></li>
            </ul>
            


            <a href="../cadastrar.html" class="btn btn-primary btn-custom">Voltar</a>
        </div>
    </section>
</body>

</html>