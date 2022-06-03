<?php
    session_start();

//---  Conversão dos arquivos do correio
//
    set_time_limit(0);
    include_once("../../third/adodb/adodb.inc.php");

    $root = "../arquivos";
    
    $Db = ADOnewConnection('pdo');
    $Db->Connect('mysql:host=localhost;dbname=cep','root','root');
    if (FALSE !== $Db->_connectionID)
    {  }
    else
    {
        die("Erro ao estabelecer uma conexão com o banco de dados = " . $Db->ErrorMsg());
        exit;
    }
	
    echo "** Convertendo Localidades **";flush();
    conv_localidades();

    echo "<br>** Convertendo Faixas de CEP dos Estados **";flush();
    conv_fx_estados();

    echo "<br>** Convertendo Faixas de CEP das Localidades **";flush();
    conv_fx_localidades();

    echo "<br>** Convertendo Grandes Usuários **";flush();
    conv_especiais();

    echo "<br>** Convertendo Logradouros **";flush();
    conv_logradouros();

    $Db->Close();
    echo "<br>** Conversão Concluida com Sucesso **";
    exit;


//--- Localidades e faixas de CEP das localidades e dos estados
function conv_localidades()
{
    global $root, $Db;

    $dados = array();
    $estado = "";
    $comando = "SELECT id_uf, nome, cep FROM cidade order by id_uf, nome";
    $rs_local = $Db->Execute($comando);
    if ($rs_local === false && !$rs_local->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de localidades: " . $Db->ErrorMsg();
        exit ;
    }
    $arr_ceps = array();
    while (!$rs_local->EOF)
    {
        $dados[0] = trim($rs_local->fields[0]);   // UF
        $dados[1] = trim($rs_local->fields[1]);   // Cidade
        $dados[2] = trim($rs_local->fields[2]);   // CEP
        if(isset($arr_ceps[$dados[2]]))
        {
        	$dados[2] = "";
        }
        $dados[3] = 'M';   // Tipo
        $dados_saida = implode("@nm@", $dados);
        if ($dados[0] != $estado)
        {
            if (!empty($estado))
            {
                fclose($arq_saida);
            }
            $estado    = $dados[0];
            $arq_saida = fopen ($root . "/cep_localidades_" . strtolower($estado) . ".txt", 'w');
        }
        fwrite($arq_saida, $dados_saida . "@nm@\r\n") ;
        $arr_ceps[$dados[2]] = "";
        $rs_local->MoveNext();
    }
    fclose($arq_saida);
    $rs_local->Close();
}
//--- Faixas de CEP dos Estados
function conv_fx_estados()
{
    global $root, $Db;

    $dados = array();
    $arq_saida = fopen ($root . "/cep_faixas_estados.txt", 'w');

    $comando = "SELECT id_uf, faixa_cep1_ini, faixa_cep1_fim, faixa_cep2_ini, faixa_cep2_fim  FROM estado order by id_uf";
    $rs_fx_est = $Db->Execute($comando);
    if ($rs_fx_est === false && !$rs_fx_est->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Faixas dos Estados: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_fx_est->EOF)
    {
        $dados[0] = trim($rs_fx_est->fields[0]); // UF
        $dados[1] = trim($rs_fx_est->fields[1]); // CEP inicial
        $dados[2] = trim($rs_fx_est->fields[2]); // CEP final
        $dados_saida = implode("@nm@", $dados);
        fwrite($arq_saida, $dados_saida . "@nm@\r\n");
        if (!empty($rs_fx_est->fields[3]))
        {
            $dados[1] = trim($rs_fx_est->fields[3]); // CEP inicial
            $dados[2] = trim($rs_fx_est->fields[4]); // CEP final
            $dados_saida = implode("@nm@", $dados);
            fwrite($arq_saida, $dados_saida . "@nm@\r\n");
        }
        $rs_fx_est->MoveNext();
    }
    fclose($arq_saida);
    $rs_fx_est->Close();
}

//--- Faixas de CEP das Localidades
function conv_fx_localidades()
{
    global $root, $Db;

    $dados = array();
    $arq_saida = fopen ($root . "/cep_faixas_localidades.txt", 'w');
    $comando = "SELECT cid.id_uf, cid.nome, cid.id_cidade FROM cidade cid ORDER BY cid.id_uf, cid.nome";
    $rs_fx_loc = $Db->Execute($comando);
    if ($rs_fx_loc === false && !$rs_fx_loc->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Faixas das localidades: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_fx_loc->EOF)
    {
        $rs_min_loc = $Db->Execute("SELECT MIN(cep) FROM endereco end where end.id_cidade=" . $rs_fx_loc->fields[2]);
        $rs_max_loc = $Db->Execute("SELECT MAX(cep) FROM endereco end where end.id_cidade=" . $rs_fx_loc->fields[2]);

        $dados[0] = trim($rs_fx_loc->fields[0]); // UF
        $dados[1] = trim($rs_fx_loc->fields[1]); // Cidade
        $dados[2] = trim($rs_min_loc->fields[0]); // CEP inicial
        $dados[3] = trim($rs_max_loc->fields[0]); // CEP final
        $dados_saida = implode("@nm@", $dados);
        fwrite($arq_saida, $dados_saida . "@nm@\r\n");
        $rs_fx_loc->MoveNext();
    }
    fclose($arq_saida);
    $rs_fx_loc->Close();
}

//--- Logradouros
function conv_logradouros()
{
    global $root, $Db;

    $estado = "";
    $cidade_nome  = "";
    $dados   = array();
    $pointer = 0;
    $cidade_point = 0;

    $comando = "SELECT end.id_uf, end.cep, end.nome, end.complemento, bai.nome, cid.nome FROM endereco end INNER JOIN bairro bai ON end.id_bairro = bai.id_bairro INNER JOIN cidade cid ON end.id_cidade = cid.id_cidade ORDER BY end.id_uf,  end.id_cidade,  end.id_bairro";
    $rs_logr = $Db->Execute($comando);
    if ($rs_logr === false && !$rs_logr->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Logradouros: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_logr->EOF)
    {
        $dados[0] = trim($rs_logr->fields[0]);  // UF
        $dados[1] = "";                         // Titulo da rua
        $dados[2] = trim($rs_logr->fields[2]);  // Nome
        $dados[3] = trim($rs_logr->fields[1]);  // CEP
        $dados[4] = trim($rs_logr->fields[5]);  // Cidade
        $dados[5] = trim($rs_logr->fields[4]);  // Bairro
        $dados[6] = '';  // Tipoext
        $dados[7] = trim($rs_logr->fields[3]);  // Compl
        if (substr($dados[7], 0, 2) == "- ")
        {
            $dados[7] = substr($dados[7], 2);
        }
        $dados_saida = implode("@nm@", $dados);
        $dados_saida .= "@nm@\r\n";
        if ($estado != $dados[0])
        {
            if (!empty($estado))
            {
                fwrite($arq_point, $cidade_nome . "@nm@" . $cidade_point . "@nm@\r\n") ;
                fclose($arq_point);
                fclose($arq_saida);
            }
            $pointer = 0;
            $cidade_point = 0;
            $estado = $dados[0];
            $cidade_nome = $dados[4];
            $arq_saida = fopen ($root . "/cep_logradouros_" . strtolower($estado) . ".txt", 'w');
            $arq_point = fopen ($root . "/cep_pointer_log_" . strtolower($estado) . ".txt", 'w');
            echo "<br>   >> Convertendo Estado: " . $estado;flush();
        }
        fwrite($arq_saida, $dados_saida) ;
        if ($cidade_nome != $dados[4])
        {
            fwrite($arq_point, $cidade_nome . "@nm@" . $cidade_point . "@nm@\r\n") ;
            $cidade_nome = $dados[4];
            $cidade_point = $pointer;
        }
        $pointer += strlen($dados_saida);
        $rs_logr->MoveNext();
    }
    fwrite($arq_point, $cidade_nome . "@nm@" . $cidade_point . "@nm@\r\n") ;
    fclose($arq_saida);
    fclose($arq_point);
    $rs_logr->Close();
}

//--- Especiais
function conv_especiais()
{
    global $root, $Db;

    $dados  = array();

    $comando = "SELECT id_uf FROM estado order by id_uf";
    $rs_especial = $Db->Execute($comando);
    if ($rs_especial === false && !$rs_especial->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Especiais: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_especial->EOF)
    {
        $arq_saida = fopen ($root . "/cep_grandes_usuarios_" . strtolower($rs_especial->fields[0]) . ".txt", 'w');
        fclose($arq_saida);
        $rs_especial->MoveNext();
    }
    $rs_especial->Close();
}

?>