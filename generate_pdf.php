<?php
require('fpdf/fpdf.php');
require('db_connect.php');
set_time_limit(300); // Aumenta o limite de tempo para 5 minutos (300 segundos)
session_start(); // Inicie a sessão para acessar os dados

// Função para obter dados da sessão ou definir um valor padrão
// Função para obter dados da sessão ou POST
function get_data($key, $default = '') {
    return isset($_POST[$key]) ? $_POST[$key] : (isset($_SESSION[$key]) ? $_SESSION[$key] : $default);
}

// Verifique se o usuário está logado e possui um ID
if (!isset($_SESSION['usuario_id'])) {
    echo "Erro: Usuário não está logado.";
    exit;
}

// Obtendo os dados de todas as etapas da sessão
$nome = get_data('nome');
$data_nascimento = get_data('data_nascimento') ? date('d/m/Y', strtotime($_SESSION['data_nascimento'])) : '';
$sexo = get_data('sexo');
$cpf = get_data('cpf');
$email = get_data('email');
$telefone = get_data('telefone');
$empresa = get_data('empresa');
$profissao = get_data('profissao');
$cnpj = get_data('cnpj');
$numero_identidade = get_data('numero_identidade');
$tipo_documento = get_data('tipo_documento');
$orgao_emissor = get_data('orgao_emissor');
$passaporte = get_data('passaporte');
$rua = get_data('rua');
$numero = get_data('numero');
$bairro = get_data('bairro');
$cep = get_data('cep');
$cidade = get_data('cidade');
$estado = get_data('estado');
$pais = get_data('pais');

$conn = new mysqli($servername, $username, $password, $dbname);

$data_nascimento_formatada = DateTime::createFromFormat('d/m/Y', $data_nascimento)->format('Y-m-d');

$usuario_id = $_SESSION['usuario_id']; // Supondo que você tenha o ID do usuário na sessão
$sql = "INSERT INTO hospedes (usuario_id ,nome, nascimento, sexo, cpf, email, telefone, empresa, profissao, cnpj, num_identidade, tipo, orgao_emissor, passaporte, rua, numero, bairro, cep, cidade, estado, pais) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issssssssssssssssssss",
    $usuario_id,// 20 "s" para strings
    $nome,
    $data_nascimento_formatada,
    $sexo,
    $cpf,
    $email,
    $telefone,
    $empresa,
    $profissao,
    $cnpj,
    $numero_identidade,
    $tipo_documento,
    $orgao_emissor,
    $passaporte,
    $rua,
    $numero,
    $bairro,
    $cep,
    $cidade,
    $estado,
    $pais
);

// Executando a inserção
$stmt->execute();

// Criando o PDF
$pdf = new FPDF();
$pdf->SetMargins(10, 20, 10);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Largura total disponível
$pageWidth = 210; // Largura da página em mm
$leftMargin = 10;
$rightMargin = 10;
$availableWidth = $pageWidth - $leftMargin - $rightMargin;
$spacing = 5; // Espaço entre as caixas

// Definindo as larguras para os campos
$nomeWidth = 80;  // Largura para o nome
$dataWidth = 30;  // Largura para a data de nascimento
$sexoWidth = 20;  // Largura para o sexo
$cpfWidth = 40;   // Largura para o CPF
$enderecoWidth = 80;   // Largura para o endereço
$numeroWidth = 20;     // Largura para o número
$bairroWidth = 60;     // Largura para o bairro
$cidadeWidth = 50;     // Largura para a cidade
$estadoWidth = 40;     // Largura para o estado
$cepWidth = 40;        // Largura para o CEP

// Adicionando o logo
$pdf->Image('images/vivavidalogo.png', 10, 10, 50);
$pdf->Ln(15);

// Título do PDF
$pdf->Cell(0, 10, 'FICHA NACIONAL DE REGISTRO DE HOSPEDES', 0, 1, 'C');
$pdf->Ln(-3);

// Etapa 1: Informações Pessoais
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'INFORMACOES DA HOSPEDAGEM', 0, 1, 'C');
$pdf->Ln();

// Desenhando as caixas com títulos e ajustando a posição
$pdf->SetXY($leftMargin, 55); // Início da primeira linha
$pdf->Cell($nomeWidth, 10, 'Nome', 1);
$pdf->SetX($leftMargin + $nomeWidth + $spacing);
$pdf->Cell($dataWidth, 10, 'Data Nasc.', 1);
$pdf->SetX($leftMargin + $nomeWidth + $dataWidth + 2 * $spacing);
$pdf->Cell($sexoWidth, 10, 'Sexo', 1);
$pdf->SetX($leftMargin + $nomeWidth + $dataWidth + $sexoWidth + 3 * $spacing);
$pdf->Cell($cpfWidth, 10, 'CPF', 1);
$pdf->Ln(); // Quebra de linha

// Inserindo os dados dentro das caixas
$pdf->SetXY($leftMargin, 65); // Início da linha de dados
$pdf->Cell($nomeWidth, 10, $nome, 1);
$pdf->SetX($leftMargin + $nomeWidth + $spacing);
$pdf->Cell($dataWidth, 10, $data_nascimento, 1);
$pdf->SetX($leftMargin + $nomeWidth + $dataWidth + 2 * $spacing);
$pdf->Cell($sexoWidth, 10, $sexo, 1);
$pdf->SetX($leftMargin + $nomeWidth + $dataWidth + $sexoWidth + 3 * $spacing);
$pdf->Cell($cpfWidth, 10, $cpf, 1);
$pdf->Ln(); // Quebra de linha

// Etapa 2: Contato e Empresa
$pdf->SetXY($leftMargin, 85); // Início da segunda linha
$pdf->Cell(90, 10, 'Email', 1);
$pdf->SetX($leftMargin + 90 + $spacing);
$pdf->Cell(90, 10, 'Telefone', 1);
$pdf->Ln(); // Quebra de linha

// Inserindo os dados dentro das caixas
$pdf->SetXY($leftMargin, 95); // Início da linha de dados
$pdf->Cell(90, 10, $email, 1);
$pdf->SetX($leftMargin + 90 + $spacing);
$pdf->Cell(90, 10, $telefone, 1);
$pdf->SetX($leftMargin + $cpfWidth + $spacing);
$pdf->Ln(); // Quebra de linha

$pdf->SetXY($leftMargin, 115); // Início da segunda linha
$pdf->Cell(60, 10, 'Empresa', 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(60, 10, 'Profissao', 1);
$pdf->SetX($leftMargin + 125     + $spacing);
$pdf->Cell(55, 10, 'CNPJ', 1);
$pdf->SetX($leftMargin + $cpfWidth + $spacing);
$pdf->Ln(); // Quebra de linha


$pdf->SetXY($leftMargin, 125); // Início da linha de dados
$pdf->Cell(60, 10, $empresa, 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(60, 10, $profissao, 1);
$pdf->SetX($leftMargin + 125 + $spacing);
$pdf->Cell(55, 10, $cnpj, 1);
$pdf->Ln(); // Quebra de linha

// Adicionando os documentos
$pdf->SetXY($leftMargin, 145); // Início da quarta linha
$pdf->Cell(60, 10, 'Numero da Identidade', 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(30, 10, 'Tipo', 1);
$pdf->SetX($leftMargin + 60 + 30 + 2 * $spacing);
$pdf->Cell(35, 10, 'Orgao Expedidor', 1);
$pdf->SetX($leftMargin + 60 + 30 + 35 + 3 * $spacing);
$pdf->Cell(45, 10, 'Passaporte', 1);
$pdf->Ln(); // Quebra de linha

// Inserindo os dados dos documentos
$pdf->SetXY($leftMargin, 155); // Início da linha de dados
$pdf->Cell(60, 10, $numero_identidade, 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(30, 10, $tipo_documento, 1);
$pdf->SetX($leftMargin + 60 + 30 + 2 * $spacing);
$pdf->Cell(35, 10, $orgao_emissor, 1);
$pdf->SetX($leftMargin + 60 + 30 + 35 + 3 * $spacing);
$pdf->Cell(45, 10, $passaporte, 1);
$pdf->Ln(); // Quebra de linha

// Etapa 3: Documentos e Endereço
$pdf->SetXY($leftMargin, 175); // Início da terceira linha
$pdf->Cell($enderecoWidth, 10, 'Endereco', 1);
$pdf->SetX($leftMargin + $enderecoWidth + $spacing);
$pdf->Cell(35, 10, 'N', 1);
$pdf->SetX($leftMargin + $enderecoWidth + 35 + 2 * $spacing);
$pdf->Cell($bairroWidth, 10, 'Bairro', 1);
$pdf->Ln();

// Inserindo os dados dentro das caixas
$pdf->SetXY($leftMargin, 185); // Início da linha de dados
$pdf->Cell($enderecoWidth, 10, $rua, 1);
$pdf->SetX($leftMargin + $enderecoWidth + $spacing);
$pdf->Cell(35, 10, $numero, 1);
$pdf->SetX($leftMargin + $enderecoWidth + 35 + 2 * $spacing);
$pdf->Cell($bairroWidth, 10, $bairro, 1);
$pdf->Ln();

//segunda linha enderco
$pdf->SetXY($leftMargin, 205);
$pdf->SetX($leftMargin);
$pdf->Cell($cepWidth, 10, 'CEP', 1);
$pdf->SetX($leftMargin + $cepWidth + $spacing);
$pdf->Cell($cidadeWidth, 10, 'Cidade', 1);
$pdf->SetX($leftMargin + $cepWidth + $cidadeWidth + 2 * $spacing);
$pdf->Cell($estadoWidth, 10, 'Estado', 1);
$pdf->SetX($leftMargin + $cepWidth + $cidadeWidth + $estadoWidth + 3 * $spacing);
$pdf->Cell($estadoWidth, 10, 'PAIS', 1);
$pdf->Ln(); // Quebra de linha

$pdf->SetXY($leftMargin, 215);
$pdf->SetX($leftMargin);
$pdf->Cell($cepWidth, 10, $cep, 1);
$pdf->SetX($leftMargin + $cepWidth + $spacing);
$pdf->Cell($cidadeWidth, 10, $cidade, 1);
$pdf->SetX($leftMargin + $cepWidth+ $cidadeWidth + 2 * $spacing);
$pdf->Cell($estadoWidth, 10, $estado, 1);
$pdf->SetX($leftMargin + $cepWidth + $cidadeWidth + $estadoWidth + 3 * $spacing);
$pdf->Cell($estadoWidth, 10, $pais, 1);
$pdf->Ln(); // Quebra de linha

// Adicionando a assinatura
$pdf->SetXY($leftMargin, 255);
$pdf->SetX(126.5);
$pdf->Cell(0, 10, 'Assinatura do Hospede', 0, 1);
$pdf->Line(($pageWidth - $rightMargin), 249.7, 90, 249.7,'R'); // Linha para a assinatura

// Salvando o PDF
$pdf->Output('D', $nome . date('d-m-y') . '.pdf');
// Redireciona para a tela principal após gerar o PDF
header('Location: index.php?success=1');
exit;
// Fechando a conexão
//$stmt->close();
//$conn->close();
?>
