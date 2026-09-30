    <?php
    session_start(); 


    if (!isset($_SESSION['usuario_id'])) {

        $_SESSION['mensagem_login'] = ['tipo' => 'error', 'texto' => "Você precisa estar logado para acessar esta página."];
        header("Location: login.php");
        exit();
    }


    $nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Editar Membro</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="form">
            <img src="./img/expansao.png" width="110" height="110">
            <h1>Editar Dados do Membro</h1>

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cadastro_de_membros";


            $conn = new mysqli($servername, $username, $password, $dbname);


            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }


            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id_para_editar = $_GET['id'];


                $sql = "SELECT id, nome, nascimento, email, tel, ender, tipo_membro, batismo, cargo, setor, foto_path FROM membros WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_para_editar);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $membro = $result->fetch_assoc();
            ?>

                    <div class="form">
                        <form action="atualizar_membro_expansao.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $membro['id']; ?>">

                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($membro['nome']); ?>" required><br><br>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($membro['email']); ?>" required><br><br>

                            <label for="nascimento">Data de Nascimento:</label>
                            <input type="nascimento" name="nascimento" id="nascimento" value="<?php echo htmlspecialchars($membro['nascimento']); ?>" required><br><br>

                            <label for="tel">Telefone:</label>
                            <input type="text" name="tel" id="tel" value="<?php echo htmlspecialchars($membro['tel']); ?>"><br><br>

                            <label for="ender">Endereço:</label>
                            <input type="text" name="ender" id="ender" value="<?php echo htmlspecialchars($membro['ender']); ?>"><br><br>

                            <label for="tipo_membro">Tipo de membro:</label>
                            <input type="text" name="tipo_membro" id="tipo_membro" value="<?php echo htmlspecialchars($membro['tipo_membro']); ?>"><br><br>

                            <label for="batismo">Data de Batismo:</label>
                            <input type="text" name="batismo" id="batismo" value="<?php echo htmlspecialchars($membro['batismo']); ?>"><br><br>

                            <label for="cargo">Cargo/Função:</label>
                            <input type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($membro['cargo']); ?>"><br><br>
                            
                            <label for="setor">Departamento:</label>
                            <input type="text" name="setor" id="setor" value="<?php echo htmlspecialchars($membro['setor']); ?>"><br><br>

                            <label for="foto">Foto:</label>
                            <img src="<?php echo $membro['foto_path']; ?>" alt="<?php echo htmlspecialchars($membro['nome']); ?>" width="100"><br>
                            <label for="nova_foto">Alterar Foto (opcional):</label>
                            <input type="file" name="nova_foto" id="nova_foto" accept="image/*"><br><br>

                            <input type="submit" value="Salvar Alterações">
                        </form>
                    </div>
            <?php
                } else {
                    echo "Membro não encontrado.";
                }
                $stmt->close();
            } else {
                echo "ID do membro não fornecido.";
            }

            $conn->close();
            ?>
            <button onclick="window.location.href='./lista_expansao.php'">lista de membros Expansão</button>

    </body>

    </html>