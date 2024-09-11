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
$pdf->SetMargins(10, 10, 50);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
// Largura total disponível
$pageWidth = 210; // Largura da página em mm
$leftMargin = 10;
$rightMargin = 10;
$availableWidth = $pageWidth - $leftMargin - $rightMargin;
$spacing = 5; // Espaço entre as caixas 


// Adicionando o logo
$pdf->Image('images/vivavidalogo.png', 10, 10, 50);
$pdf->Ln(20);

// Título do PDF
$pdf->Cell(0, 10, 'FICHA NACIONAL DE REGISTRO DE HOSPEDES', 0, 1, 'C');
$pdf->Ln(10);

/* Etapa 1: Informações Pessoais
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, 'INFORMACOES DA HOSPEDAGEM', 0, 1, 'C');
$pdf->Ln(5);
*/

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 10, 'NOME COMPLETO:', 0, 0);
$pdf->Rect(50, 50, 100, 10);
$pdf->SetXY(50, 50);
$pdf->Cell(100, 10, $name, 0, 0);

$pdf->SetXY(160, 50);
$pdf->Cell(30, 10, 'DATA DE NASCIMENTO:', 0, 0);
$pdf->Rect(190, 50, 30, 10);
$pdf->SetXY(190, 50);
$pdf->Cell(30, 10, $date_of_birth, 0, 1);

$pdf->SetXY(10, 65);
$pdf->Cell(40, 10, 'SEXO:', 0, 0);
$pdf->Rect(50, 65, 20, 10);
$pdf->SetXY(50, 65);
$pdf->Cell(20, 10, $gender, 0, 0);

$pdf->SetXY(160, 65);
$pdf->Cell(30, 10, 'CPF:', 0, 0);
$pdf->Rect(190, 65, 50, 10);
$pdf->SetXY(190, 65);
$pdf->Cell(50, 10, $cpf, 0, 1);

// Etapa 2: Contato e Empresa
$pdf->Ln(10);
$pdf->Cell(40, 10, 'EMAIL:', 0, 0);
$pdf->Rect(50, 85, 100, 10);
$pdf->SetXY(50, 85);
$pdf->Cell(100, 10, $email, 0, 0);

$pdf->SetXY(160, 85);
$pdf->Cell(30, 10, 'TELEFONE:', 0, 0);
$pdf->Rect(190, 85, 50, 10);
$pdf->SetXY(190, 85);
$pdf->Cell(50, 10, $phone, 0, 1);

$pdf->SetXY(10, 100);
$pdf->Cell(40, 10, 'EMPRESA:', 0, 0);
$pdf->Rect(50, 100, 100, 10);
$pdf->SetXY(50, 100);
$pdf->Cell(100, 10, $company, 0, 0);

$pdf->SetXY(160, 100);
$pdf->Cell(30, 10, 'PROFISSAO:', 0, 0);
$pdf->Rect(190, 100, 50, 10);
$pdf->SetXY(190, 100);
$pdf->Cell(50, 10, $profession, 0, 1);

$pdf->SetXY(10, 115);
$pdf->Cell(40, 10, 'CNPJ:', 0, 0);
$pdf->Rect(50, 115, 100, 10);
$pdf->SetXY(50, 115);
$pdf->Cell(100, 10, $cnpj, 0, 1);

// Etapa 3: Documentos e Endereço
$pdf->Ln(10);
$pdf->Cell(40, 10, 'NUMERO DA IDENTIDADE:', 0, 0);
$pdf->Rect(60, 130, 50, 10);
$pdf->SetXY(60, 130);
$pdf->Cell(50, 10, $id_number, 0, 0);

$pdf->SetXY(120, 130);
$pdf->Cell(30, 10, 'TIPO:', 0, 0);
$pdf->Rect(150, 130, 30, 10);
$pdf->SetXY(150, 130);
$pdf->Cell(30, 10, $id_type, 0, 0);

$pdf->SetXY(190, 130);
$pdf->Cell(40, 10, 'ORGAO EXPEDIDOR:', 0, 0);
$pdf->Rect(230, 130, 50, 10);
$pdf->SetXY(230, 130);
$pdf->Cell(50, 10, $issuing_body, 0, 1);

$pdf->SetXY(10, 145);
$pdf->Cell(40, 10, 'PASSAPORTE:', 0, 0);
$pdf->Rect(50, 145, 100, 10);
$pdf->SetXY(50, 145);
$pdf->Cell(100, 10, $passport, 0, 1);

$pdf->Ln(10);
$pdf->Cell(40, 10, 'RUA:', 0, 0);
$pdf->Rect(50, 160, 100, 10);
$pdf->SetXY(50, 160);
$pdf->Cell(100, 10, $street, 0, 0);

$pdf->SetXY(160, 160);
$pdf->Cell(30, 10, 'NUMERO:', 0, 0);
$pdf->Rect(190, 160, 50, 10);
$pdf->SetXY(190, 160);
$pdf->Cell(50, 10, $number, 0, 1);

$pdf->SetXY(10, 175);
$pdf->Cell(40, 10, 'BAIRRO:', 0, 0);
$pdf->Rect(50, 175, 100, 10);
$pdf->SetXY(50, 175);
$pdf->Cell(100, 10, $neighborhood, 0, 1);

$pdf->Ln(10);
$pdf->Cell(40, 10, 'CEP:', 0, 0);
$pdf->Rect(50, 190, 40, 10);
$pdf->SetXY(50, 190);
$pdf->Cell(40, 10, $cep, 0, 0);

$pdf->SetXY(100, 190);
$pdf->Cell(30, 10, 'CIDADE:', 0, 0);
$pdf->Rect(130, 190, 50, 10);
$pdf->SetXY(130, 190);
$pdf->Cell(50, 10, $city, 0, 0);

$pdf->SetXY(190, 190);
$pdf->Cell(30, 10, 'ESTADO:', 0, 0);
$pdf->Rect(220, 190, 40, 10);
$pdf->SetXY(220, 190);
$pdf->Cell(40, 10, $state, 0, 0);

$pdf->SetXY(10, 205);
$pdf->Cell(30, 10, 'PAIS:', 0, 0);
$pdf->Rect(50, 205, 100, 10);
$pdf->SetXY(50, 205);
$pdf->Cell(100, 10, $country, 0, 1);

// Espaço para Assinatura do Hóspede
$pdf->Ln(15);
$pdf->SetXY(160, 240);
$pdf->Cell(40, 10, 'Assinatura do Hospede:', 0, 1);
$pdf->SetXY(200, 250);
$pdf->Cell(40, 10, '_________________________', 0, 1);

// Remover espaços e caracteres especiais do nome
$cleaned_name = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $name));

// Geração do PDF com nome e data
if (!empty($cleaned_name)) {
    $pdf->Output($cleaned_name . '_' . date('d-m-Y') . '.pdf', 'D');
} else {
    $pdf->Output('Hospede_' . date('d-m-Y') . '.pdf', 'D');
}

?>
