<?php
require('fpdf/fpdf.php');

// Obtendo os dados de todas as etapas
$name = $_POST['name'];
$date_of_birth = date('d/m/Y', strtotime($_POST['date_of_birth']));
$gender = $_POST['gender'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$profession = $_POST['profession'];
$cnpj = $_POST['cnpj'];
$id_number = $_POST['id_number'];
$id_type = $_POST['id_type'];
$issuing_body = $_POST['issuing_body'];
$passport = $_POST['passport'];
$street = $_POST['street'];
$number = $_POST['number'];
$neighborhood = $_POST['neighborhood'];
$cep = $_POST['cep'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];

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

/*// Calculando o espaço total
$totalWidth = $nomeWidth + $dataWidth + $sexoWidth + $cpfWidth + 4 * $spacing;
$totalWidth2 = $enderecoWidth + $numeroWidth + $bairroWidth + $cidadeWidth + $estadoWidth + $cepWidth + 6 * $spacing;
*/
/* Ajustando se necessário
if ($totalWidth > $availableWidth) {
    $scale = $availableWidth / $totalWidth;
    $nomeWidth *= $scale;
    $dataWidth *= $scale;
    $sexoWidth *= $scale;
    $cpfWidth *= $scale;
    $spacing *= $scale;
}

if ($totalWidth2 > $availableWidth) {
    $scale = $availableWidth / $totalWidth2;
    $enderecoWidth *= $scale;
    $numeroWidth *= $scale;
    $bairroWidth *= $scale;
    $cidadeWidth *= $scale;
    $estadoWidth *= $scale;
    $cepWidth *= $scale;
    $spacing *= $scale;
}
*/
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
$pdf->Cell($nomeWidth, 10, $name, 1);
$pdf->SetX($leftMargin + $nomeWidth + $spacing);
$pdf->Cell($dataWidth, 10, $date_of_birth, 1);
$pdf->SetX($leftMargin + $nomeWidth + $dataWidth + 2 * $spacing);
$pdf->Cell($sexoWidth, 10, $gender, 1);
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
$pdf->Cell(90, 10, $phone, 1);
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
$pdf->Cell(60, 10, $company, 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(60, 10, $profession, 1);
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
$pdf->Cell(60, 10, $id_number, 1);
$pdf->SetX($leftMargin + 60 + $spacing);
$pdf->Cell(30, 10, $id_type, 1);
$pdf->SetX($leftMargin + 60 + 30 + 2 * $spacing);
$pdf->Cell(35, 10, $issuing_body, 1);
$pdf->SetX($leftMargin + 60 + 30 + 35 + 3 * $spacing);
$pdf->Cell(45, 10, $passport, 1);
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
$pdf->Cell($enderecoWidth, 10, $street, 1);
$pdf->SetX($leftMargin + $enderecoWidth + $spacing);
$pdf->Cell(35, 10, $number, 1);
$pdf->SetX($leftMargin + $enderecoWidth + 35 + 2 * $spacing);
$pdf->Cell($bairroWidth, 10, $neighborhood, 1);
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
$pdf->Cell($cidadeWidth, 10, $city, 1);
$pdf->SetX($leftMargin + $cepWidth+ $cidadeWidth + 2 * $spacing);
$pdf->Cell($estadoWidth, 10, $state, 1);
$pdf->SetX($leftMargin + $cepWidth + $cidadeWidth + $estadoWidth + 3 * $spacing);
$pdf->Cell($estadoWidth, 10, $country, 1);
$pdf->Ln(); // Quebra de linha

// Adicionando a assinatura
$pdf->SetXY($leftMargin, 255);
$pdf->SetX(126.5);
$pdf->Cell(0, 10, 'Assinatura do Hospede', 0, 1);
$pdf->Line(($pageWidth - $rightMargin), 249.7, 90, 249.7,'R'); // Linha para a assinatura

// Salvando o PDF
$pdf->Output('D', $name +    date('d/m/y') . '.pdf');
?>
