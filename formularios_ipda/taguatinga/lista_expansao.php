<?php

// Inclui o arquivo de conexão com o banco de dados
require_once 'includes/db.php';

$funcionarios = []; // Array para armazenar os membros encontrados
$search = $_GET['search'] ?? ''; // Obtém o termo de pesquisa, ou uma string vazia se não houver

// Inicia a construção da query SQL
// Sempre selecionamos todos os campos necessários
$sql = "SELECT id, nome, nascimento, email, tel, ender, tipo_membro, batismo, cargo, setor, foto_path 
        FROM membros 
        WHERE LOWER(setor) = 'expansao'"; // Filtra sempre pelo setor 'Expansão' (em minúsculas)

// Se houver um termo de pesquisa, adiciona a condição de pesquisa por nome
if (!empty($search)) {
    // Adiciona a condição para filtrar por nome, usando LIKE para pesquisa parcial
    $sql .= " AND nome LIKE ?"; 
}

$sql .= " ORDER BY nome ASC"; // Ordena os resultados pelo nome

// Prepara a declaração SQL para execução segura
// Isso evita ataques de injeção de SQL
if ($stmt = $conn->prepare($sql)) {
    // Se houver um termo de pesquisa, 'binda' (liga) o parâmetro
    if (!empty($search)) {
        $searchTerm = '%' . $search . '%'; // Adiciona curingas (%) para pesquisa parcial (ex: "mar" encontra "Maria" e "Marcos")
        $stmt->bind_param("s", $searchTerm); // 's' indica que o parâmetro é uma string
    }

    // Executa a declaração preparada
    $stmt->execute();

    // Obtém o resultado da query
    $result = $stmt->get_result();

    // Verifica se há resultados e os busca
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $funcionarios[] = $row; // Adiciona cada linha (membro) ao array
        }
    }

    // Fecha a declaração
    $stmt->close();
} else {
    // Em caso de erro na preparação da query
    echo "Erro ao preparar a consulta: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Membros - Setor Expansão</title>
    <script>
        // Atualiza a página a cada 30 segundos
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>

    <style>
        body {
            background-color: royalblue;
            background-image: url("../img/logo.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            width: 97%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form {
            background: rgba(255, 255, 255, 0.9);
            width: 100%;
            max-width: 900px;
            padding: 20px;
            text-align: center;
            border: 2px solid #069;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        h1 {
            background: #069;
            color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 870px;
            text-align: center;
            margin-top: 20px;
        }

        .funcionario-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .funcionario-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .funcionario-card h2 {
            margin-top: 10px;
            margin-bottom: 10px;
            color: #555;
            font-size: 1.3em;
        }

        .funcionario-card p {
            margin: 5px 0;
            font-size: 0.95em;
            color: #666;
        }

        .funcionario-foto {
            width: 100px;
            height: 100px;
            border-radius: 15%;
            object-fit: cover;
            border: 2px solid rgb(199, 204, 209);
            background-color: #e0e0e0;
        }

        .no-foto {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.9em;
            text-align: center;
            margin: 0 auto 10px;
            border: 2px dashed #999;
            font-weight: bold;
        }

        a.no-link-style {
            text-decoration: none;
            color: inherit;
        }

        a.no-link-style:visited {
            color: inherit;
        }

        input[type="text"] {
            padding: 8px;
            width: 60%;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="form">
        <img src="./img/expansao.png" width="110" height="110" alt="Logo">
        <h1>Lista de Membros do Setor Expansão</h1>

        <form method="get" action="" class="search-form">
            <input type="text" name="search" placeholder="Pesquisar por nome..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Pesquisar</button>
            <hr>

            <?php if (empty($funcionarios)): ?>
                <p>Nenhum membro do setor Expansão encontrado<?php echo !empty($search) ? " com o nome '{$search}'" : ""; ?>.</p>
            <?php else: ?>
                <div class="funcionario-list">
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <div class="funcionario-card">
                            <?php if (!empty($funcionario['foto_path']) && file_exists($funcionario['foto_path'])): ?>
                                <img src="<?php echo htmlspecialchars($funcionario['foto_path']); ?>" alt="Foto de <?php echo htmlspecialchars($funcionario['nome']); ?>" class="funcionario-foto">
                            <?php else: ?>
                                <div class="no-foto">Sem Foto</div>
                            <?php endif; ?>
                            <h2>
                                <a class="no-link-style" href="visualizar_membro_expansao.php?id=<?php echo htmlspecialchars($funcionario['id']); ?>">
                                    <?php echo htmlspecialchars($funcionario['nome']); ?>
                                </a>
                            </h2>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>
        <hr>
        <div class="form-group">
            
            <button onclick="window.location.href='./home.php'">Home</button>
        </div>
    </div>
</body>

</html>