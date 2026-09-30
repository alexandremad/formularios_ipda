<?php 
require 'config.php'; 
$id = $_GET['editar'] ?? null;
$o = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM obreiros WHERE id = ?");
    $stmt->execute([$id]);
    $o = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Cadastro IPDA</title>
    <style>
        body { background: #555; margin: 0; padding: 0; }
        .folha-a4 { 
            width: 210mm; min-height: 297mm; padding: 15mm; margin: 10mm auto; 
            background: white; border: 8px solid #FFD700; box-sizing: border-box; 
            position: relative; page-break-after: always; font-family: Arial, sans-serif;
        }
        .header { text-align: center; color: #000080; }
        .secao { background: #FFD700; color: #000080; font-weight: bold; text-align: center; padding: 4px; margin: 10px 0; font-size: 13px; border: 1px solid #000080; }
        .linha { display: flex; gap: 8px; margin-bottom: 6px; border-bottom: 1px dotted #000; align-items: flex-end; }
        .linha label { font-size: 10px; font-weight: bold; color: #000080; white-space: nowrap; text-transform: uppercase; }
        .linha input { border: none; outline: none; flex: 1; font-size: 13px; background: transparent; padding: 2px 0; }
        .foto-box { width: 3cm; height: 4cm; border: 2px solid #000080; float: left; text-align: center; font-size: 9px; color: #000080; }
        
        @media print { 
            .no-print { display: none; } 
            body { background: none; } 
            .folha-a4 { margin: 0; border: 8px solid #FFD700 !important; }
        }
    </style>
</head>
<body>

<div class="no-print" style="position:fixed; top:10px; left:10px; z-index:1000; background:rgba(255,255,255,0.9); padding:10px; border-radius:8px; border:1px solid #ccc;">
    <button onclick="window.print()" style="padding:10px; background:#000080; color:white; border:none; cursor:pointer;">🖨️ IMPRIMIR TUDO</button>
    <button type="submit" form="formFicha" style="padding:10px; background:#28a745; color:white; border:none; cursor:pointer;">💾 SALVAR NO BANCO</button>
    <a href="index.php" style="font-size:12px; margin-left:10px;">Sair</a>
</div>

<form id="formFicha" action="processa.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_edit" value="<?= $o['id'] ?? '' ?>">
    <input type="hidden" name="foto_atual" value="<?= $o['foto'] ?? '' ?>">

    <div class="folha-a4">
        <div class="foto-box">
            <?php if(!empty($o['foto'])): ?><img src="<?= $o['foto'] ?>" width="100%"><?php else: ?><br><br><br>FOTO 3X4<?php endif; ?>
            <input type="file" name="foto" class="no-print">
        </div>
        <div class="header">
            <h2 style="margin:0">IGREJA PENTECOSTAL DEUS É AMOR</h2>
            <h3 style="margin:0; color:red;">FICHA DE CADASTRO DE OBREIRO(A)</h3>
            <small>ESTE FORMULÁRIO DEVE SER PREENCHIDO COM LETRA DE FORMA</small>
        </div>

        <div class="secao">DADOS PESSOAIS</div>
        <div class="linha"><label>NOME:</label><input type="text" name="nome" value="<?= $o['nome'] ?? '' ?>"></div>
        <div class="linha">
            <label>ENDEREÇO:</label><input type="text" name="endereco" value="<?= $o['endereco'] ?? '' ?>">
            <label>Nº:</label><input type="text" name="numero" style="width:60px" value="<?= $o['numero'] ?? '' ?>">
        </div>
        <div class="linha">
            <label>BAIRRO:</label><input type="text" name="bairro" value="<?= $o['bairro'] ?? '' ?>">
            <label>CIDADE:</label><input type="text" name="cidade" value="<?= $o['cidade'] ?? '' ?>">
            <label>UF:</label><input type="text" name="uf" style="width:30px" value="<?= $o['uf'] ?? '' ?>">
            <label>CEP:</label><input type="text" name="cep" style="width:80px" value="<?= $o['cep'] ?? '' ?>">
        </div>
        <div class="linha">
            <label>RG:</label><input type="text" name="rg" value="<?= $o['rg'] ?? '' ?>">
            <label>CPF:</label><input type="text" name="cpf" value="<?= $o['cpf'] ?? '' ?>">
            <label>PASSAPORTE:</label><input type="text" name="passaporte" value="<?= $o['passaporte'] ?? '' ?>">
        </div>
        <div class="linha">
            <label>NATURALIDADE:</label><input type="text" name="naturalidade" value="<?= $o['naturalidade'] ?? '' ?>">
            <label>UF:</label><input type="text" name="uf_naturalidade" style="width:30px" value="<?= $o['uf_naturalidade'] ?? '' ?>">
            <label>DATA NASC:</label><input type="date" name="data_nasc" value="<?= $o['data_nasc'] ?? '' ?>">
        </div>

        <div class="secao">DADOS FAMILIARES</div>
        <div class="linha">
            <label>ESTADO CIVIL:</label><input type="text" name="estado_civil" value="<?= $o['estado_civil'] ?? '' ?>">
            <label>DATA CASAMENTO:</label><input type="date" name="data_casamento" value="<?= $o['data_casamento'] ?? '' ?>">
        </div>
        <div class="linha"><label>NOME DO CÔNJUGE:</label><input type="text" name="nome_conjuge" value="<?= $o['nome_conjuge'] ?? '' ?>"></div>
        <div class="linha">
            <label>TEM FILHOS?</label><input type="text" name="tem_filhos" placeholder="SIM/NÃO" value="<?= $o['tem_filhos'] ?? '' ?>">
            <label>Nº FILHOS:</label><input type="number" name="num_filhos" style="width:50px" value="<?= $o['num_filhos'] ?? '' ?>">
        </div>
    </div>

    <div class="folha-a4">
        <div class="secao">DADOS MINISTERIAIS</div>
        <div class="linha"><label>DENOMINAÇÃO ONDE ACEITOU JESUS:</label><input type="text" name="denominacao_jesus" value="<?= $o['denominacao_jesus'] ?? '' ?>"></div>
        <div class="linha">
            <label>DATA CONVERSÃO:</label><input type="date" name="data_conversao" value="<?= $o['data_conversao'] ?? '' ?>">
            <label>DATA BATISMO ÁGUAS:</label><input type="date" name="data_batismo_aguas" value="<?= $o['data_batismo_aguas'] ?? '' ?>">
        </div>
        <div class="linha">
            <label>FUNÇÃO ATUAL:</label><input type="text" name="funcao_atual" value="<?= $o['funcao_atual'] ?? '' ?>">
            <label>BATISMO E. SANTO?</label><input type="text" name="batismo_espirito_santo" style="width:50px" value="<?= $o['batismo_espirito_santo'] ?? '' ?>">
        </div>
        <div class="linha">
            <label>RECEBE PREBENDA?</label><input type="text" name="recebe_prebenda" style="width:50px" value="<?= $o['recebe_prebenda'] ?? '' ?>">
            <label>VALOR:</label><input type="text" name="valor_prebenda" value="<?= $o['valor_prebenda'] ?? '' ?>">
        </div>
        <div class="linha"><label>CONGREGAÇÃO ATUAL:</label><input type="text" name="congregacao_atual" value="<?= $o['congregacao_atual'] ?? '' ?>"></div>
        <div class="linha"><label>NOME DO DIRIGENTE:</label><input type="text" name="dirigente_atual" value="<?= $o['dirigente_atual'] ?? '' ?>"></div>
        
        <div class="secao">OUTRAS INFORMAÇÕES</div>
        <div class="linha"><label>GRAU DE ESCOLARIDADE:</label><input type="text" name="escolaridade" value="<?= $o['escolaridade'] ?? '' ?>"></div>
        <div class="linha"><label>IDIOMAS QUE FALA FLUENTEMENTE:</label><input type="text" name="idiomas" value="<?= $o['idiomas'] ?? '' ?>"></div>
    </div>

    <div class="folha-a4">
        <div class="header"><h3>TERMO DE ADESÃO E COMPROMISSO - PÁG 1</h3></div>
        <p style="text-align:justify; font-size:14px; line-height:1.6;">
            Eu, <strong><?= $o['nome'] ?? '__________________________________' ?></strong>, 
            portador do CPF nº <strong><?= $o['cpf'] ?? '________________' ?></strong>, 
            residente em <strong><?= $o['cidade'] ?? '__________' ?></strong>... 
            [COLE AQUI O TEXTO DA IMAGEM 3]
        </p>
    </div>

    <div class="folha-a4">
        <div class="header"><h3>TERMO DE ADESÃO - PÁG 2</h3></div>
        <p style="text-align:justify; font-size:14px; line-height:1.6;">
            [COLE AQUI O TEXTO DA IMAGEM 4]
        </p>
    </div>

</form>
</body>
</html>