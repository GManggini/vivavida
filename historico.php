<?php
include 'db_connect.php'; // Conexão com o banco de dados

// Definir a tabela atual (users ou hospedes) com base na seleção da barra lateral
$tabela = isset($_GET['tabela']) ? $_GET['tabela'] : 'users';

// SQL para selecionar dados da tabela escolhida
if ($tabela == 'hospedes') {
    $sql = "SELECT * FROM hospedes";
} else {
    $sql = "SELECT * FROM users";
}
$refUser = "historico.php?table=users";
$refHospede = "historico.php?table=hospedes";
$title = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($refUser == true) {
        $title = "Registro Usuarios";
    } else {
        $title = "Registro Hospedes";
    }
    ?>
    <title><?php
        $title
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-ligth sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="historico.php?table=user">
                            Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historico.php?table=hospede">
                            Hóspedes
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2 class="mt-4"><?php echo ucfirst($tabela); ?></h2>

            <table class="table table-bordered mt-3">
                <thead>
                <tr>
                    <!-- Cabeçalhos diferentes para cada tabela -->
                    <?php if ($tabela == 'hospedes'): ?>
                        <th>ID</th><th>Nome</th><th>CPF</th><th>Email</th><th>Ações</th>
                    <?php elseif ($tabela == 'users'): ?>
                        <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php
                // Busca os dados da tabela selecionada
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['email']}</td>
                                    <td>" . ($tabela == 'hospedes' ? $row['cpf'] : $row['telefone']) . "</td>
                                    <td>
                                        <button class='btn btn-sm btn-warning edit-btn' data-id='{$row['id']}' data-tabela='$tabela' data-bs-toggle='modal' data-bs-target='#editModal'>Editar</button>
                                        <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#deleteModal'>Excluir</button>
                                    </td>
                                  </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum dado encontrado.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Campos de edição serão inseridos aqui por AJAX -->
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="edit_nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <!-- Campos dinâmicos com base na tabela -->
                    <div id="edit_extra_fields"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Excluir Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja excluir este registro?</p>
                    <input type="hidden" id="delete_id" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript e AJAX -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Abrir modal de edição e preencher com os dados do registro
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var tabela = $(this).data('tabela');

            // Busca os dados via AJAX
            $.ajax({
                url: 'get_data.php',
                type: 'GET',
                data: { id: id, tabela: tabela },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#edit_id').val(data.id);
                    $('#edit_nome').val(data.nome);
                    $('#edit_email').val(data.email);
                    $('#edit_extra_fields').html(data.extra_fields); // Preencher campos extras
                }
            });
        });

        // Submeter edição via AJAX
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: 'update_data.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Atualizar tabela sem recarregar a página
                    $('#editModal').modal('hide');
                    location.reload(); // Ou atualize a tabela via AJAX
                }
            });
        });

        // Abrir modal de exclusão
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            $('#delete_id').val(id);
        });

        // Submeter exclusão via AJAX
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: 'delete_data.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    location.reload(); // Ou atualize a tabela via AJAX
                }
            });
        });
    });
</script>
</body>
</html>
