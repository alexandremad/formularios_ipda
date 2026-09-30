<?php
$host = 'localhost';
$db   = 'reuniao';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome   = $_POST['nome'];
    $setor  = $_POST['setor'];
    
    
    // Atualizado para incluir a coluna 'regiao'
    $stmt = $conn->prepare("INSERT INTO participantes (nome, setor) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $setor);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Participantes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 30px; text-align: center; margin-top: 10px; }
        
        .logo { max-width: 400px; height: auto; margin-bottom: 10px; }
        
        h2 { margin-top: 0; margin-bottom: 15px; }
        form { display: inline-block; text-align: left; }
        
        /* Aplicado a estilização também ao select */
        input, select { 
            display: block; 
            margin-bottom: 10px; 
            width: 520px; /* Ajustado para alinhar perfeitamente com o padding */
            padding: 8px; 
            font-size: 20px;
            box-sizing: border-box;
        }
        
        button { width: 100%; padding: 10px; cursor: pointer; background-color: #2c3e50; color: white; border: none; font-size: 20px; }
        
        .link-footer { display: block; margin-top: 15px; }
    </style>
</head>
<body>

    <img src="img/horizontal_portugues.png" alt="Logo" class="logo">
  
    <h2>Cadastrar Participante</h2>
    
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" required>
         <!-- <input type="text" name="setor" placeholder="IPDA" required>-->
        
        <select name="setor" required>
            
            <option value="" disabled selected>Selecione a Região</option>
            <option value="Aguas Lindas-Santa Coimbra">Aguas Lindas-Santa Coimbra</option>
            <option value="Areal">Areal</option>
            <option value="Brazlandia-Incra 08 Centro">Brazlandia-Incra 08 Centro</option>
            <option value="Brazlandia-Santa Barbara">Brazlandia-Santa Barbara</option>
            <option value="Brazlandia-Setor Tradicional">Brazlandia-Setor Tradicional</option>
            <option value="Brazlandia-Vendinha">Brazlandia-Vendinha</option>
            <option value="Brazlandia-Vila Divineia">Brazlandia-Vila Divineia</option>
            <option value="Brazlandia-Vila Sao Jose">Brazlandia-Vila Sao Jose</option>
            <option value="Candangolandia">Candangolandia</option>
            <option value="Ceilandia-Expansao Setor O">Ceilandia-Expansao Setor O</option>
            <option value="Ceilandia-Norte">Ceilandia-Norte</option>
            <option value="Ceilandia Norte (Guariroba)">Ceilandia Norte (Guariroba)</option>
            <option value="Ceilandia-P Norte">Ceilandia-P Norte</option>
            <option value="Ceilandia-Qnr">Ceilandia-Qnr</option>
            <option value="Ceilandia-Setor O">Ceilandia-Setor O</option>
            <option value="Ceilandia-Setor P.Sul">Ceilandia-Setor P.Sul</option>
            <option value="Ceilandia-Sol Nascente">Ceilandia-Sol Nascente</option>
            <option value="Ceilandia Sul">Ceilandia Sul</option>
            <option value="Conic">Conic</option>
            <option value="Cristalina-Lustosa">Cristalina-Lustosa</option>
            <option value="Cristalina-Marajo">Cristalina-Marajo</option>
            <option value="Del Lago 02">Del Lago 02</option>
            <option value="Df-Aguas Lindas-Parque Aguas Bonitas">Df-Aguas Lindas-Parque Aguas Bonitas</option>
            <option value="Engenho Das Lajes">Engenho Das Lajes</option>
            <option value="Estrutural">Estrutural</option>
            <option value="Fazendinha">Fazendinha</option>
            <option value="Gama Setor Sul-Setor Leste">Gama Setor Sul-Setor Leste</option>
            <option value="Gama-Setor Sul">Gama-Setor Sul</option>
            <option value="Guara">Guara</option>
            <option value="Itapoa">Itapoa</option>
            <option value="Luziania-Cristalina">Luziania-Cristalina</option>
            <option value="Morro Azul">Morro Azul</option>
            <option value="Paranoa">Paranoa</option>
            <option value="Paranoa-Buriti Vermelho">Paranoa-Buriti Vermelho</option>
            <option value="Paranoa-Cafe Sem Troca">Paranoa-Cafe Sem Troca</option>
            <option value="Paranoa-Centro">Paranoa-Centro</option>
            <option value="Paranoa-Jardim Ii">Paranoa-Jardim Ii</option>
            <option value="Planaltina-Arapongas">Planaltina-Arapongas</option>
            <option value="Planaltina-Buriti Iv">Planaltina-Buriti Iv</option>
            <option value="Planaltina-Estancia">Planaltina-Estancia</option>
            <option value="Planaltina-Morro Azul">Planaltina-Morro Azul</option>
            <option value="Planaltina-Recanto Do Sossego">Planaltina-Recanto Do Sossego</option>
            <option value="Planaltina-Vila Buritis">Planaltina-Vila Buritis</option>
            <option value="Recanto Da Emas">Recanto Da Emas</option>
            <option value="Recanto Das Emas-Dom Francisco">Recanto Das Emas-Dom Francisco</option>
            <option value="Recanto-Recanto Da Emas">Recanto-Recanto Da Emas</option>
            <option value="Riacho Fundo Ii">Riacho Fundo II</option>
            <option value="Samambaia Norte">Samambaia Norte</option>
            <option value="Samambaia Sul">Samambaia Sul</option>
            <option value="Samambaia-Samambaia Norte">Samambaia-Samambaia Norte</option>
            <option value="Samambaia-Samambaia Sul">Samambaia-Samambaia Sul</option>
            <option value="Santa Maria">Santa Maria</option>
            <option value="Santa Maria Setor Sul">Santa Maria Setor Sul</option>
            <option value="Santa Maria-Norte">Santa Maria-Norte</option>
            <option value="Santa Maria-Santa Maria Do Sul">Santa Maria-Santa Maria Do Sul</option>
            <option value="Santo Antonio-Jardim Ala">Santo Antonio-Jardim Ala</option>
            <option value="Santo Antonio-Park Estrela Dalva Xi">Santo Antonio-Park Estrela Dalva Xi</option>
            <option value="Sao Domingos-Centro">Sao Domingos-Centro</option>
            <option value="Sao Sebastiao-Sao Jose">Sao Sebastiao-Sao Jose</option>
            <option value="Sao Sebastiao-Setor Tradicional">Sao Sebastiao-Setor Tradicional</option>
            <option value="Setor Industrial">Setor Industrial</option>
            <option value="Sobradinho">Sobradinho</option>
            <option value="Sobradinho-Boa Vista">Sobradinho-Boa Vista</option>
            <option value="Sobradinho-Nova Colina">Sobradinho-Nova Colina</option>
            <option value="Sobradinho-Setor De Mansoes">Sobradinho-Setor De Mansoes</option>
            <option value="Sobradinho-Setor Fercal">Sobradinho-Setor Fercal</option>
            <option value="Sobradinho-Sobradinho Ii">Sobradinho-Sobradinho Ii</option>
            <option value="Taboquinha-Nao Consta">Taboquinha-Nao Consta</option>
            <option value="Taguatinga-Norte">Taguatinga-Norte</option>
            <option value="Taguatinga-Sul">Taguatinga-Sul</option>
            <option value="Valparaiso De Goias-Etapa">Valparaiso De Goias-Etapa</option>
            <option value="Valparaiso-Cruzeiro">Valparaiso-Cruzeiro</option>
            <option value="Varjao">Varjao</option>
            <option value="Vila Madureira">Vila Madureira</option>
                 

            <!-- Adicione ou altere as opções de região conforme a sua necessidade -->
        </select>

        <button type="submit">Salvar</button>
    </form>
    <br><br><br>

    <a href="impressao.php" class="link-footer">Ir para Lista de Impressão</a>

</body>
</html>