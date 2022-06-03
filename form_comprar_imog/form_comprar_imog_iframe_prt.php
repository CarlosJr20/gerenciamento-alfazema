<?php
 @session_start();
 $script_case_init = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
 $path_botoes      = filter_input(INPUT_GET, 'path_botoes', FILTER_SANITIZE_STRING);
 $apl_dependente   = filter_input(INPUT_GET, 'apl_dependente', FILTER_SANITIZE_STRING);
 $apl_opcao        = (isset($_GET['opcao']))            ? filter_input(INPUT_GET, 'opcao', FILTER_SANITIZE_STRING)            : "print";
 $apl_atual        = (isset($_GET['apl_prt']))          ? filter_input(INPUT_GET, 'apl_prt', FILTER_SANITIZE_STRING)          : "index.php";
 $apl_cor_print    = (isset($_GET['cor_print']))        ? filter_input(INPUT_GET, 'cor_print', FILTER_SANITIZE_STRING)        : "PB";
 $apl_pag_ativa    = filter_input(INPUT_GET, 'SC_Pdf_pag_ativa', FILTER_SANITIZE_STRING);
 $apl_tipo_print   =  "RC";
 $apl_saida        = filter_input(INPUT_GET, 'apl_saida', FILTER_SANITIZE_STRING);
?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
  <title>form_comprar_imog :: PRINT</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
  <META http-equiv="Pragma" content="no-cache">
  <link rel="shortcut icon" href="../_lib/img/sys__NM__img__NM__LOGOTIPO-SEM_FUNDO-PNG.png">
 </head>
 <body>
  <form name="Fini" method="post" 
        action="<?php echo $apl_atual ?>" 
        target="_self"> 
    <input type="hidden" name="nmgp_opcao" value="<?php echo $apl_opcao;?>"/> 
    <input type="hidden" name="nmgp_tipo_print" value="<?php echo $apl_tipo_print;?>"/> 
    <input type="hidden" name="nmgp_cor_print" value="<?php echo $apl_cor_print;?>"/> 
    <input type="hidden" name="SC_Pdf_pag_ativa" value="<?php echo $apl_pag_ativa;?>"/> 
    <input type="hidden" name="nmgp_navegator_print" value=""/> 
    <input type="hidden" name="script_case_init" value="<?php echo $script_case_init ?>"/> 
  </form> 
 <script>
    document.Fini.nmgp_navegator_print.value = navigator.appName;
    document.Fini.submit();
 </script>
 </body>
</html>
