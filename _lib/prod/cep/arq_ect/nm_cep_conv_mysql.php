<?php
    session_start();

//---  Conversão dos arquivos do correio
//
    set_time_limit(0);
    include_once("../../third/adodb/adodb.inc.php");

    $root   = "../arquivos";
    $server = "localhost";
    $usr    = "root";
    $pw     = "";
    $base   = "cep";

/*
http://localhost/scriptcase/prod/cep/arq_ect/nm_cep_conv_mysql.php
*/
    ADOLoadCode("pdo");
    $Db = ADONewConnection("pdo");
    $Db->Connect('mysql:host=' . $server . ';dbname=' . $base,$usr,$pw);
    if (FALSE !== $Db->_connectionID)
    {  }
    else
    {
        die("Erro ao estabelecer uma conexão com o banco de dados = " . $Db->ErrorMsg());
        exit;
    }

    if(!isset($_GET['step']))
    {
        $_GET['step'] = 1;
        $_SESSION['cep_mens'] = "";
    }

    echo "<html>\r\n<HEAD>\r\n<TITLE>Conversão CEP</TITLE>\r\n<META http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\r\n</HEAD>\r\n<body>\r\n";

    switch($_GET['step'])
    {
        case 1:
            $_SESSION['cep_mens'] = "** Convertendo Localidades **";
            echo $_SESSION['cep_mens'];flush();
            conv_localidades();
        break;
        case 2:
            $_SESSION['cep_mens'] .= "<br>** Convertendo Faixas de CEP dos Estados **";
            echo $_SESSION['cep_mens'];flush();
            conv_fx_estados();
        break;
        case 3:
            $_SESSION['cep_mens'] .= "<br>** Convertendo Faixas de CEP das Localidades **";
            echo $_SESSION['cep_mens'];flush();
            conv_fx_localidades();
        break;
        case 4:
            $_SESSION['cep_mens'] .= "<br>** Convertendo Logradouros **";
            echo $_SESSION['cep_mens'];flush();
            conv_logradouros();
        break;
        case 5:
            $_SESSION['cep_mens'] .= "<br>** Criando arquivos de controle **";
            echo $_SESSION['cep_mens'];flush();
            arq_controles();

            $Db->Close();
            echo "<br>** Conversão Concluida com Sucesso **";
            echo "\r\n</body></html>";
            exit;
        break;
    }
    $Db->close();
    $step = $_GET['step']+1;
    echo "<script>window.location.href='?step=". $step ."';</script>";
    echo "\r\n</body></html>";

    exit;


//--- Localidades e faixas de CEP das localidades e dos estados
function conv_localidades()
{
    global $root, $Db;

    $dados    = array();
    $estado   = "";
    $comando  = "SELECT uf, cidade, cep FROM cepbr_cidade order by uf, cidade";
    $rs_local = $Db->Execute($comando);
    if ($rs_local === false && !$rs_local->EOF)
    {
        echo "<br>*** Erro ao acessar tabela cepbr_cidade: " . $Db->ErrorMsg();
        exit ;
    }
    $arr_ceps = array();
    while (!$rs_local->EOF)
    {
        $dados[0] = trim($rs_local->fields[0]);   // UF
        $dados[1] = mb_convert_encoding(trim($rs_local->fields[1]), "ISO-8859-1", "UTF-8");   // Cidade
        $dados[2] = trim($rs_local->fields[2]);   // CEP
        if(isset($arr_ceps[$dados[2]]))
        {
            $dados[2] = "";
        }
        $dados[3] = "";   // Tipo

        $dados[4] = "";   // Latitude
        $dados[5] = "";   // Longitude
        if (!empty($dados[2])) {
            $comando  = "SELECT latitude, longitude FROM cepbr_geo WHERE cep = '" . $dados[2] . "'";
            $rs_geo = $Db->Execute($comando);
            if ($rs_geo === false && !$rs_geo->EOF) {
                echo "<br>*** Erro ao acessar tabela cepbr_geo (Localidades): " . $Db->ErrorMsg();
                exit ;
            }
            if (!$rs_geo->EOF) {
                $dados[4] = $rs_geo->fields[0];   // Latitude
                $dados[5] = $rs_geo->fields[1];   // Longitude
            }
        }
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

    $dados     = array();
    $estado    = "";
    $cep_ini   = "";
    $cep_fim   = "";
    $cep_ant   = "0";
    $arq_saida = fopen ($root . "/cep_faixas_estados.txt", 'w');

    $comando = "SELECT uf, cep_inicial, cep_final FROM cepbr_faixa_cidades order by uf, cep_inicial";
    $rs_fx_est = $Db->Execute($comando);
    if ($rs_fx_est === false && !$rs_fx_est->EOF)
    {
        echo "<br>*** Erro ao acessar tabela cepbr_faixa_cidades: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_fx_est->EOF)
    {
        $mudou = false;
        $tst_est = trim($rs_fx_est->fields[0]);
        if ($tst_est != $estado) {
            $mudou = true;
        }
        $cep_ant++;
        $tst_cep = (int) substr($rs_fx_est->fields[1], 0, 5);
        if ($tst_cep != $cep_ant) {
            $mudou = true;
        }
        if ($mudou) {
            if (!empty($estado)) {
                $dados[0] = $estado;          // UF
                $dados[1] = $cep_ini;         // CEP inicial
                $dados[2] = $cep_fim;         // CEP final
                $dados_saida = implode("@nm@", $dados);
                fwrite($arq_saida, $dados_saida . "@nm@\r\n");
                /* Arquivos não mais utilizados. Gravados apenas para não dar erro nas rotinas de CEP da produção */
                $arq_grandes = fopen ($root . "/cep_grandes_usuarios_" . strtolower($estado) . ".txt", 'w');
                fclose($arq_grandes);
                $arq_unid = fopen ($root . "/cep_logradouros_unidades_operacionais_" . strtolower($estado) . ".txt", 'w');
                fclose($arq_unid);
                /*--------*/
            }
            $estado = $tst_est;
            $cep_ini = trim($rs_fx_est->fields[1]);
        }
        $cep_fim = trim($rs_fx_est->fields[2]);
        $cep_ant = (int) substr($cep_fim, 0, 5);
        $rs_fx_est->MoveNext();
    }
    $dados[0] = $estado;          // UF
    $dados[1] = $cep_ini;         // CEP inicial
    $dados[2] = $cep_fim;         // CEP final
    $dados_saida = implode("@nm@", $dados);
    fwrite($arq_saida, $dados_saida . "@nm@\r\n");
    fclose($arq_saida);
    /* Arquivos não mais utilizados. Gravados apenas para não dar erro nas rotinas de CEP da produção */
    $arq_grandes = fopen ($root . "/cep_grandes_usuarios_" . strtolower($estado) . ".txt", 'w');
    fclose($arq_grandes);
    $arq_unid = fopen ($root . "/cep_logradouros_unidades_operacionais_" . strtolower($estado) . ".txt", 'w');
    fclose($arq_unid);
    /*--------*/
    $rs_fx_est->Close();
}

//--- Faixas de CEP das Localidades
function conv_fx_localidades()
{
    global $root, $Db;

    $dados = array();
    $arq_saida = fopen ($root . "/cep_faixas_localidades.txt", 'w');
    $comando = "SELECT cepbr_cidade.uf, cepbr_cidade.cidade, cepbr_faixa_cidades.cep_inicial, cepbr_faixa_cidades.cep_final FROM
   cepbr_cidade INNER JOIN cepbr_faixa_cidades ON cepbr_cidade.id_cidade = cepbr_faixa_cidades.id_cidade
   where cepbr_cidade.cep is null
   order by cepbr_cidade.uf, cepbr_cidade.cidade";
    $rs_fx_loc = $Db->Execute($comando);
    if ($rs_fx_loc === false && !$rs_fx_loc->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Faixas das localidades: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_fx_loc->EOF)
    {
        $dados[0] = trim($rs_fx_loc->fields[0]);  // UF
        $dados[1] = mb_convert_encoding(trim($rs_fx_loc->fields[1]), "ISO-8859-1", "UTF-8");   // Cidade
        $dados[2] = trim($rs_fx_loc->fields[2]);  // CEP inicial
        $dados[3] = trim($rs_fx_loc->fields[3]);  // CEP final
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

    $comando = "SELECT cepbr_cidade.uf, cepbr_endereco.logradouro, cepbr_endereco.cep, cepbr_cidade.cidade, cepbr_bairro.bairro, cepbr_endereco.tipo_logradouro,
   cepbr_endereco.complemento  FROM
   cepbr_cidade INNER JOIN cepbr_endereco ON cepbr_cidade.id_cidade = cepbr_endereco.id_cidade
   INNER JOIN cepbr_bairro ON cepbr_endereco.id_bairro = cepbr_bairro.id_bairro
   where cepbr_cidade.cep is null
   order by cepbr_cidade.uf, cepbr_cidade.cidade, cepbr_endereco.logradouro";
    $rs_logr = $Db->Execute($comando);
    if ($rs_logr === false && !$rs_logr->EOF)
    {
        echo "<br>*** Erro ao acessar tabela de Logradouros: " . $Db->ErrorMsg();
        exit ;
    }
    while (!$rs_logr->EOF)
    {
        $dados[0] = trim($rs_logr->fields[0]);  // UF
        $dados[1] = "";                         // Titulo da rua (não existe mais)
        $dados[2] = mb_convert_encoding(trim($rs_logr->fields[1]), "ISO-8859-1", "UTF-8");   // Nome do logradouro
        $dados[3] = trim($rs_logr->fields[2]);  // CEP
        $dados[4] = mb_convert_encoding(trim($rs_logr->fields[3]), "ISO-8859-1", "UTF-8");   // Cidade
        $dados[5] = mb_convert_encoding(trim($rs_logr->fields[4]), "ISO-8859-1", "UTF-8");   // Bairro
        $espaco  = " ";
        $tipo    =  mb_convert_encoding(trim($rs_logr->fields[5]), "ISO-8859-1", "UTF-8");
        $limpa_tipo = false;
        if ($dados[0] == "DF")
        {
            if ($tipo == "Quadra" || $tipo == "Setor" || $tipo == "Bloco" || $tipo == "Entre Quadra" || $tipo == "Trecho")
            {
               $limpa_tipo = true;
            }
            if (substr($tipo, 0, 4) == "Área" && (strpos($dados[2], "Área") !== false || substr($dados[2], 0, 1) == "A"))
            {
               $limpa_tipo = true;
            }
            if ($tipo == "Avenida" && strpos($dados[2], "Avenida") !== false)
            {
               $limpa_tipo = true;
            }
            if ($tipo == "Conjunto" && strpos($dados[2], "Conjunto") !== false)
            {
               $limpa_tipo = true;
            }
        }
        if (trim($rs_logr->fields[0]) == "GO" && ($tipo == "Quadra" || $tipo == "Bloco"))
        {
           $limpa_tipo = true;
        }
        if (trim($rs_logr->fields[0]) == "TO" && $tipo == "Quadra")
        {
           $limpa_tipo = true;
        }
        if (trim($rs_logr->fields[0]) == "RS" && $tipo == "Quadra")
        {
           $limpa_tipo = true;
        }
        if ($limpa_tipo)
        {
            $espaco  = "";
            $rs_logr->fields[5] = "";
        }
        $dados[6] = mb_convert_encoding(trim($rs_logr->fields[5]), "ISO-8859-1", "UTF-8") . $espaco;  // Tipoext
        $dados[7] = mb_convert_encoding(trim($rs_logr->fields[6]), "ISO-8859-1", "UTF-8");   // Complemento
        if (substr($dados[7], 0, 2) == "- ")
        {
            $dados[7] = substr($dados[7], 2);
        }

        $dados[8] = "";   // Latitude
        $dados[9] = "";   // Longitude
        if (!empty($dados[2])) {
            $comando  = "SELECT latitude, longitude FROM cepbr_geo WHERE cep = '" . $dados[3] . "'";
            $rs_geo = $Db->Execute($comando);
            if ($rs_geo === false && !$rs_geo->EOF) {
                echo "<br>*** Erro ao acessar tabela cepbr_geo (logradouros): " . $Db->ErrorMsg();
                exit ;
            }
            if (!$rs_geo->EOF) {
                $dados[8] = $rs_geo->fields[0];   // Latitude
                $dados[9] = $rs_geo->fields[1];   // Longitude
            }
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
            $_SESSION['cep_mens'] .= "<br>   >> Convertendo Estado: " . $estado;
            echo $_SESSION['cep_mens'];flush();
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


function arq_controles()
{
    global $root, $Db;

    $arq_saida = fopen ($root . "/cep_contrl_arq.txt", 'w');

    $arr_files = array('sp', 'rj', 'pe');
    foreach ($arr_files as $estado)
    {
        $sFile = $root. '/cep_logradouros_'. $estado .'.txt';
        if(!is_file($sFile))
        {
            echo "<br>*** Erro criando arquivos de controle, arquivo nao existe: " . $sFile;
            exit ;
        }
        fwrite($arq_saida, $estado . '@#@' . md5_file($sFile) . "@#@\r\n") ;
    }
    fclose($arq_saida);
}

?>