<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FICHA DE CADASTRO DE OBREIRO</title>
    
</head>
<body>

<form id="fichaObreiro" action="salvar.php" method="POST" enctype="multipart/form-data">
    
    <div class="no-print" style="position: fixed; top: 10px; right: 10px; display: flex; gap: 10px; z-index: 1000;">
        <button type="submit" style="padding: 15px; cursor: pointer; background: #28a745; color: white; border: none; font-weight: bold;">SALVAR E IMPRIMIR</button>
    </div>

    <div class="folha">
        <div class="foto-container" onclick="document.getElementById('input-foto').click()">
            <span class="instrucao-foto" style="font-size: 8px; font-weight: bold; text-align: center;">
                FOTO 3X4<br>
                <span style="font-size: 7px; font-weight: normal;">Clique para selecionar<br>Irmãos de paletó e gravata</span>
            </span>
            <img id="img-preview" src="" alt="Foto do Obreiro" style="display:none; width: 100%; height: 100%; object-fit: cover;">
            <input type="file" id="input-foto" name="foto_obreiro" accept="image/*" onchange="previewImagem(event)" style="display:none;">
        </div>
        
        <div class="header" style="margin-left: 18mm; min-height: 3cm; display: flex; flex-direction: column; align-items: center;">
            <img src="./img/horizontal _português.png" alt="Logo" width="410" height="210" style="margin-top: -60px; margin-bottom: -40px;">
            <h2 style="margin:0; color:red; font-size: 18px;">FICHA DE CADASTRO DE OBREIRO(A)</h2>
            <p style="margin: 5px 0 0 0; font-size: 7px; color: #000; font-weight: bold; text-align: center; text-transform: uppercase;">
                FORMULÁRIOS INCOMPLETOS, ILEGÍVEIS E RASURADOS SERÃO DESCONSIDERADOS
            </p>
        </div>

        <div class="secao">DADOS PESSOAIS</div>
        <div class="linha"><label>NOME:</label><input type="text" name="nome"></div>
        <div class="linha">
            <label>ENDEREÇO:</label><input type="text" name="endereco">
            <label>Nº:</label><input type="text" name="numero" style="width:40px">
            <label>COMPLEMENTO:</label><input type="text" name="complemento">
        </div>
        <div class="linha">
            <label>BAIRRO:</label><input type="text" name="bairro">
            <label>CIDADE:</label><input type="text" name="cidade">
            <label>UF:</label><input type="text" name="uf" style="width:30px">
        </div>
        <div class="linha">
            <label>RG:</label><input type="text" name="rg">
            <label>CPF:</label><input type="text" name="cpf">
            <label>PASSAPORTE:</label><input type="text" name="passaporte">
        </div>
        <div class="linha">
            <label>CIDADE DE NASC.:</label><input type="text" name="cidade_nasc">
            <label>UF:</label><input type="text" name="uf_nasc" style="width:30px">
            <label>DATA DE NASC.:</label><input type="text" name="data_nasc">
        </div>
        <div class="linha"><label>ESTADO CIVIL:</label><input type="text" name="estado_civil"><label>DATA DE CASAMENTO:</label><input type="text" name="data_casamento"></div>
        
        <div class="secao">DADOS FAMILIARES</div>
        <div class="linha">
            <label>TEM FILHOS?</label>
            <span style="font-size: 10px; color: #000080; margin: 0 10px;">
                SIM <input type="checkbox" name="tem_filhos" value="Sim">  
                NÃO <input type="checkbox" name="tem_filhos" value="Nao"> 
            </span>
            <label>Nº DE DEPENDENTES (</label>
            <input type="text" name="num_dependentes" style="width: 20px; text-align: center;">
            <label>)</label>
            <div class="linha">
        <label>NOME DO FILHO (A):</label><input type="text" name="filho_1_nome">
        <label>DATA DE NASC.:</label><input type="text" name="filho_1_nasc">
    </div>
    <div class="linha">
        <label>NOME DO FILHO (A):</label><input type="text" name="filho_2_nome">
        <label>DATA DE NASC.:</label><input type="text" name="filho_2_nasc">
    </div>
    <div class="linha">
        <label>NOME DO FILHO (A):</label><input type="text" name="filho_3_nome">
        <label>DATA DE NASC.:</label><input type="text" name="filho_3_nasc">
    </div>
    <div class="linha">
        <label>NOME DO CONJUGE:</label><input type="text" name="conjuge_nome">
        <label>DATA DE NASC.:</label><input type="text" name="conjuge_nasc">
    </div>
    
    <div class="linha">
        <label>ELE(A) É CRENTE?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="conjuge_crente" value="Sim">  
            &nbsp;&nbsp; 
            NÃO <input type="radio" name="conjuge_crente" value="Nao">
        </span>
        <label>DE OUTRO MINISTÉRIO? QUAL?</label>
        <input type="text" name="conjuge_outro_ministerio">
    </div>

    <div class="secao">DADOS MINISTERIAIS DO(A) OBREIRO(A)</div>
    
    <div class="linha">
        <label>EM QUAL DENOMINAÇÃO VOCÊ ACEITOU A JESUS?</label>
        <input type="text" name="denominacao_conversao">
    </div>
    <div class="linha">
        <label>DATA DA SUA CONVERSÃO:</label><input type="text" name="data_conversao">
        <label>DATA DO BATISMO NAS ÁGUAS:</label><input type="text" name="data_batismo_aguas">
    </div>
    
    <div class="linha">
        <label>FUNÇÃO:</label>
        <span style="font-size: 9px; color: #000080; margin-left: 5px; font-weight: bold;">
            VOL. FINANCEIRO(A) <input type="radio" name="funcao_atual" value="Voluntário Financeiro">  
            &nbsp;&nbsp;
            COOPERADOR(A) <input type="radio" name="funcao_atual" value="Cooperador">  
            &nbsp;&nbsp;
            DIÁCONO <input type="radio" name="funcao_atual" value="Diácono">  
            &nbsp;&nbsp;
            PRESBÍTERO <input type="radio" name="funcao_atual" value="Presbítero">  
            &nbsp;&nbsp;
            EVANGELISTA <input type="radio" name="funcao_atual" value="Evangelista"> 
        </span>
    </div>

    <div class="linha">
        <label>ORDENAÇÃO À COOPERADOR (A):</label><input type="text" name="ord_cooperador">
        <label>ORDENAÇÃO À DIÁCONO:</label><input type="text" name="ord_diacono">
    </div>
    <div class="linha">
        <label>ORDENAÇÃO À PRESBÍTERO:</label><input type="text" name="ord_presbitero">
        <label>ORDENAÇÃO À VOLUNTÁRIO (A) FINANCEIRO (A):</label><input type="text" name="ord_vol_financeiro">
    </div>
    <div class="linha">
        <label>ORDENAÇÃO À EVANGELISTA:</label><input type="text" name="ord_evangelista">
    </div>

    <div class="linha">
        <label>POSSUI CREDENCIAL?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="possui_credencial" value="Sim"> 
            &nbsp;&nbsp; 
            NÃO <input type="radio" name="possui_credencial" value="Nao"> 
        </span>
    </div>

    <div class="linha">
        <label>RECEBE PREBENDA?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="recebe_prebenda" value="Sim">  
            &nbsp;&nbsp; 
            NÃO <input type="radio" name="recebe_prebenda" value="Nao"> 
        </span>
        <label>HÁ QUANTO TEMPO?:</label><input type="text" name="prebenda_tempo">
        <label>DESDE:</label><input type="text" name="prebenda_desde">
    </div>

    <div class="linha">
        <label>VOCÊ DIRIGE ALGUMA IPDA</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="dirige_ipda" value="Sim">  
            &nbsp;&nbsp; 
            NÃO <input type="radio" name="dirige_ipda" value="Nao"> 
        </span>
        <label>QUAL?:</label><input type="text" name="dirige_qual">
    </div>

    <div class="linha"><label>ENDEREÇO DA ATUAL CONGREGAÇÃO</label><input type="text" name="congregacao_endereco"></div>
    <div class="linha">
        <label>BAIRRO:</label><input type="text" name="congregacao_bairro" style="flex: 1;">
        <label>CIDADE:</label><input type="text" name="congregacao_cidade" style="flex: 1;">
        <label>UF:</label><input type="text" name="congregacao_uf" style="max-width: 40px;">
    </div>

    <div class="linha">
        <label>CEP:</label><input type="text" name="congregacao_cep" style="max-width: 100px;">
        <label>DIRIGENTE:</label><input type="text" name="congregacao_dirigente" style="flex: 1;">
        <label>TEL.: (</label>
        <input type="text" name="congregacao_ddd" style="max-width: 30px; text-align: center;">
        <label>)</label>
        <input type="text" name="congregacao_tel" style="flex: 0.5;">
    </div>

    <div class="linha">
        <label>SEDE SETORIAL:</label><input type="text" name="sede_setorial" style="flex: 1;">
        <label>SUCURSAL:</label><input type="text" name="sucursal" style="flex: 1;">
    </div>
    <div class="secao">CONTINUAÇÃO - DADOS MINISTERIAIS</div>
    
    <div class="linha">
        <label>VOCÊ JÁ DIRIGIU ALGUMA IGREJA NO EXTERIOR?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="dirigiu_exterior" value="Sim">  
            &nbsp; 
            NÃO <input type="radio" name="dirigiu_exterior" value="Nao"> 
        </span>
    </div>
    <div class="linha"><label>EM QUAIS CIDADES?</label><input type="text" name="exterior_cidades"></div>
    <div class="linha"><label>QUAIS PAÍSES?</label><input type="text" name="exterior_paises"></div>
    
    <div class="linha" style="margin-top: 10px;">
        <label>VOCÊ OU ALGUÉM DA SUA FAMÍLIA CONTRAIU ALGUMA DOENÇA NAS CIDADES OU PAÍSES ACIMA?</label>
    </div>
    <div class="linha">
        <span style="font-size: 10px; color: #000080;">
            SIM <input type="radio" name="doenca_exterior" value="Sim">  
            &nbsp;&nbsp; 
            NÃO <input type="radio" name="doenca_exterior" value="Nao"> 
        </span>
        <label style="margin-left: 10px;">QUEM?</label><input type="text" name="doenca_quem">
        <label>QUAIS?</label><input type="text" name="doenca_quais">
    </div>

    <div class="linha"><label>POR QUAL MOTIVO VOLTOU PARA O BRASIL?</label><input type="text" name="motivo_retorno_brasil"></div>
    <div class="linha"><input type="text" name="motivo_retorno_brasil_cont"></div>

    <div class="linha" style="margin-top: 10px;">
        <label>FALA ALGUM IDIOMA FLUENTE?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="idioma_fluente" value="Sim">  
            &nbsp; 
            NÃO <input type="radio" name="idioma_fluente" value="Nao"> 
        </span>
        <label>QUAIS?</label><input type="text" name="idiomas_quais">
    </div>

    <div class="linha"><label>GRAU DE ESCOLARIDADE</label><input type="text" name="escolaridade"></div>

    <div class="linha" style="margin-top: 10px; border:none;">
        <label>EM SUA OPINIÃO, QUAL IPDA VOCÊ OBTEVE UM MAIOR DESEMPENHO EM RELAÇÃO AO SEU MINISTÉRIO PESSOAL? EM QUAL ANO?</label>
    </div>
    <div class="linha"><input type="text" name="melhor_desempenho_obs"></div>

    <div class="linha" style="margin-top: 10px;">
        <label>ALGUÉM VEZ FOI DISCIPLINADO?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="foi_disciplinado" value="Sim">  
            &nbsp; 
            NÃO <input type="radio" name="foi_disciplinado" value="Nao"> 
        </span>
        <label>QUANTAS VEZES?</label><input type="text" name="disciplina_vezes" style="max-width: 80px;">
    </div>
    <div class="linha"><label>DELAS: MOTIVO:</label><input type="text" name="disciplina_motivo"></div>
    <div class="linha" style="margin-top: 10px;">
        <label>JÁ FEZ ALGUM CURSO MINISTERIAL?</label>
        <span style="font-size: 10px; color: #000080; margin: 0 10px;">
            SIM <input type="radio" name="curso_ministerial" value="Sim">  
            &nbsp; 
            NÃO <input type="radio" name="curso_ministerial" value="Nao"> 
        </span>
        <label>QUAL?</label><input type="text" name="curso_ministerial_qual">
    </div>
    <br>
    <h2 style="margin:0; font-size: 11px; color: #000080;">ABAIXO ESCREVA QUAIS IPDAS VOCÊ DIRIGIU, EM QUE ANO E QUANTO TEMPO DUROU SUA GESTÃO EM CADA UMA</h2>
    <br>
    
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_1" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_1"><label>UF:</label><input type="text" name="gestao_uf_1" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_1"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_2" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_2"><label>UF:</label><input type="text" name="gestao_uf_2" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_2"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_3" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_3"><label>UF:</label><input type="text" name="gestao_uf_3" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_3"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_4" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_4"><label>UF:</label><input type="text" name="gestao_uf_4" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_4"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_5" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_5"><label>UF:</label><input type="text" name="gestao_uf_5" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_5"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_6" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_6"><label>UF:</label><input type="text" name="gestao_uf_6" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_6"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_7" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_7"><label>UF:</label><input type="text" name="gestao_uf_7" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_7"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_8" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_8"><label>UF:</label><input type="text" name="gestao_uf_8" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_8"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_9" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_9"><label>UF:</label><input type="text" name="gestao_uf_9" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_9"></div>
    <div class="linha"><label>ANO:</label><input type="text" name="gestao_ano_10" style="max-width: 60px;"><label>IPDA:</label><input type="text" name="gestao_ipda_10"><label>UF:</label><input type="text" name="gestao_uf_10" style="max-width: 40px;"><label>TEMPO:</label><input type="text" name="gestao_tempo_10"></div>
<br>
    <div class="linha"><label>OBS.:</label><input type="text" name="gestao_obs_1"></div>
    <div class="linha"><input type="text" name="gestao_obs_2"></div>

    <div style="margin-top: 30px; display: flex; justify-content: space-around;">
        <div style="text-align: center;">
            <strong>X</strong>______________________________________<br>
            <small>ASSINATURA DO(A) OBREIRO(A)</small>
        </div>
        <div style="text-align: center;">
            <strong>X</strong>______________________________________<br>
            <small>ASSINATURA DO DIRIGENTE</small>
        </div>
    </div>

    <div class="linha" style="border:none; margin-top: 20px;">
        <input type="text" name="data_cidade" style="flex: 0.5; border-bottom: 1px solid #000;">
        <label>,</label>
        <input type="text" name="data_dia" style="width: 40px; border-bottom: 1px solid #000; text-align: center;">
        <label>DE</label>
        <input type="text" name="data_mes" style="flex: 0.3; border-bottom: 1px solid #000; text-align: center;">
        <label>DE 20</label>
        <input type="text" name="data_ano" style="width: 40px; border-bottom: 1px solid #000; text-align: center;">
    </div>
    <
        </div>
        
        </div>
</form>

<script>
    function previewImagem(event) {
        const reader = new FileReader();
        const imagem = document.getElementById('img-preview');
        const instrucao = document.querySelector('.instrucao-foto');

        reader.onload = function() {
            if (reader.readyState === 2) {
                imagem.src = reader.result;
                imagem.style.display = 'block';
                instrucao.style.display = 'none';
            }
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Lógica para imprimir após o envio (opcional, pode ser disparada pelo PHP)
    document.getElementById('fichaObreiro').onsubmit = function() {
        setTimeout(() => { window.print(); }, 1000);
    };
</script>
</body>
</html>