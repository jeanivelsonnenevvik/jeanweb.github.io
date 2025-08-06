<?php
// Configurações do destinatário
$destinatario = "nevvikoficial@gmail.com"; // <-- Altere para seu e-mail real

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados do formulário
    $nome = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $assunto = strip_tags(trim($_POST["subject"]));
    $mensagem = trim($_POST["message"]);

    // Validação básica
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Cria o conteúdo do e-mail
    $conteudo = "Você recebeu uma nova mensagem do site:\n\n";
    $conteudo .= "Nome: $nome\n";
    $conteudo .= "Email: $email\n";
    $conteudo .= "Assunto: $assunto\n";
    $conteudo .= "Mensagem:\n$mensagem\n";

    // Cabeçalhos do e-mail
    $headers = "From: $nome <$email>";

    // Envia o e-mail
    if (mail($destinatario, $assunto, $conteudo, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }

} else {
    // Acesso inválido
    http_response_code(403);
    echo "Você não pode acessar esse recurso diretamente.";
}
