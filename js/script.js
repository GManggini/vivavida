document.addEventListener('DOMContentLoaded', function() {
    // Verifica se o formulário está sendo submetido corretamente
    var form = document.getElementById('pdfForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            var name = document.getElementById('name').value;
            var cpf = document.getElementById('cpf').value;

            if (!name || !cpf) {
                alert('Por favor, preencha todos os campos.');
                event.preventDefault(); // Impede o envio do formulário se campos vazios
            }
        });
    }

    // Formatação do CPF
    var cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value;

            // Remove tudo que não seja número
            value = value.replace(/\D/g, '');

            // Formata o CPF conforme vai digitando
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }

            cpfInput.value = value;
        });
    }
});
