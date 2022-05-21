<?php
class pdfreport_paciente_helder_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $id_paciente = array();
   var $nome = array();
   var $idade = array();
   var $sc_field_0 = array();
   var $leito = array();
   var $registro = array();
   var $atendimento = array();
   var $data = array();
   var $hora = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("pt_br");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdfreport_paciente_helder']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdfreport_paciente_helder", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->id_paciente[0] = $Busca_temp['id_paciente']; 
       $tmp_pos = strpos($this->id_paciente[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->id_paciente[0]))
       {
           $this->id_paciente[0] = substr($this->id_paciente[0], 0, $tmp_pos);
       }
       $this->nome[0] = $Busca_temp['nome']; 
       $tmp_pos = strpos($this->nome[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->nome[0]))
       {
           $this->nome[0] = substr($this->nome[0], 0, $tmp_pos);
       }
       $this->idade[0] = $Busca_temp['idade']; 
       $tmp_pos = strpos($this->idade[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->idade[0]))
       {
           $this->idade[0] = substr($this->idade[0], 0, $tmp_pos);
       }
       $this->sc_field_0[0] = $Busca_temp['sc_field_0']; 
       $tmp_pos = strpos($this->sc_field_0[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->sc_field_0[0]))
       {
           $this->sc_field_0[0] = substr($this->sc_field_0[0], 0, $tmp_pos);
       }
       $sc_field_0_2 = $Busca_temp['sc_field_0_input_2']; 
       $this->sc_field_0_2 = $Busca_temp['sc_field_0_input_2']; 
       $this->hora[0] = $Busca_temp['hora']; 
       $tmp_pos = strpos($this->hora[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->hora[0]))
       {
           $this->hora[0] = substr($this->hora[0], 0, $tmp_pos);
       }
   } 
   else 
   { 
       $this->sc_field_0_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT id_paciente, Nome, Idade, str_replace (convert(char(10),`Data de Nascimento`,102), '.', '-') + ' ' + convert(char(8),`Data de Nascimento`,20) as sc_field_0, Leito, Registro, Atendimento, str_replace (convert(char(10),Data,102), '.', '-') + ' ' + convert(char(8),Data,20), str_replace (convert(char(10),Hora,102), '.', '-') + ' ' + convert(char(8),Hora,20) from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id_paciente, Nome, Idade, `Data de Nascimento` as sc_field_0, Leito, Registro, Atendimento, Data, Hora from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id_paciente, Nome, Idade, `Data de Nascimento` as sc_field_0, Leito, Registro, Atendimento, Data, Hora from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['id_paciente'] = "Id Paciente";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['nome'] = "Nome";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['idade'] = "Idade";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['sc_field_0'] = "Data De Nascimento";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['leito'] = "Leito";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['registro'] = "Registro";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['atendimento'] = "Atendimento";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['data'] = "Data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['labels']['hora'] = "Hora";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_paciente_helder']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_paciente_helder']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->id_paciente[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->id_paciente[$this->nm_grid_colunas] = (string)$this->id_paciente[$this->nm_grid_colunas];
          $this->nome[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->idade[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->idade[$this->nm_grid_colunas] = (string)$this->idade[$this->nm_grid_colunas];
          $this->sc_field_0[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->leito[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->leito[$this->nm_grid_colunas] = (string)$this->leito[$this->nm_grid_colunas];
          $this->registro[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->registro[$this->nm_grid_colunas] = (string)$this->registro[$this->nm_grid_colunas];
          $this->atendimento[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->atendimento[$this->nm_grid_colunas] = (string)$this->atendimento[$this->nm_grid_colunas];
          $this->data[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->hora[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->id_paciente[$this->nm_grid_colunas] = sc_strip_script($this->id_paciente[$this->nm_grid_colunas]);
          if ($this->id_paciente[$this->nm_grid_colunas] === "") 
          { 
              $this->id_paciente[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->id_paciente[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->id_paciente[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->id_paciente[$this->nm_grid_colunas]);
          $this->nome[$this->nm_grid_colunas] = sc_strip_script($this->nome[$this->nm_grid_colunas]);
          if ($this->nome[$this->nm_grid_colunas] === "") 
          { 
              $this->nome[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nome[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nome[$this->nm_grid_colunas]);
          $this->idade[$this->nm_grid_colunas] = sc_strip_script($this->idade[$this->nm_grid_colunas]);
          if ($this->idade[$this->nm_grid_colunas] === "") 
          { 
              $this->idade[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->idade[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->idade[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->idade[$this->nm_grid_colunas]);
          $this->sc_field_0[$this->nm_grid_colunas] = sc_strip_script($this->sc_field_0[$this->nm_grid_colunas]);
          if ($this->sc_field_0[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_0[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $sc_field_0_x =  $this->sc_field_0[$this->nm_grid_colunas];
               nm_conv_limpa_dado($sc_field_0_x, "YYYY-MM-DD");
               if (is_numeric($sc_field_0_x) && strlen($sc_field_0_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->sc_field_0[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->sc_field_0[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->sc_field_0[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_0[$this->nm_grid_colunas]);
          $this->leito[$this->nm_grid_colunas] = sc_strip_script($this->leito[$this->nm_grid_colunas]);
          if ($this->leito[$this->nm_grid_colunas] === "") 
          { 
              $this->leito[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->leito[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->leito[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->leito[$this->nm_grid_colunas]);
          $this->registro[$this->nm_grid_colunas] = sc_strip_script($this->registro[$this->nm_grid_colunas]);
          if ($this->registro[$this->nm_grid_colunas] === "") 
          { 
              $this->registro[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->registro[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->registro[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->registro[$this->nm_grid_colunas]);
          $this->atendimento[$this->nm_grid_colunas] = sc_strip_script($this->atendimento[$this->nm_grid_colunas]);
          if ($this->atendimento[$this->nm_grid_colunas] === "") 
          { 
              $this->atendimento[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->atendimento[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->atendimento[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->atendimento[$this->nm_grid_colunas]);
          $this->data[$this->nm_grid_colunas] = sc_strip_script($this->data[$this->nm_grid_colunas]);
          if ($this->data[$this->nm_grid_colunas] === "") 
          { 
              $this->data[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $data_x =  $this->data[$this->nm_grid_colunas];
               nm_conv_limpa_dado($data_x, "YYYY-MM-DD");
               if (is_numeric($data_x) && strlen($data_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->data[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->data[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->data[$this->nm_grid_colunas]);
          $this->hora[$this->nm_grid_colunas] = sc_strip_script($this->hora[$this->nm_grid_colunas]);
          if ($this->hora[$this->nm_grid_colunas] === "") 
          { 
              $this->hora[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $hora_x =  $this->hora[$this->nm_grid_colunas];
               nm_conv_limpa_dado($hora_x, "HH:II:SS");
               if (is_numeric($hora_x) && strlen($hora_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->hora[$this->nm_grid_colunas], "HH:II:SS");
                   $this->hora[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->hora[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->hora[$this->nm_grid_colunas]);
                      /*-------- Def. Body --------*/
            $cell_id_paciente = array('posx' => '10', 'posy' => '10', 'data' => $this->id_paciente[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Nome = array('posx' => '10', 'posy' => '20', 'data' => $this->nome[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Idade = array('posx' => '10', 'posy' => '30', 'data' => $this->idade[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_0 = array('posx' => '10', 'posy' => '40', 'data' => $this->sc_field_0[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Leito = array('posx' => '10', 'posy' => '50', 'data' => $this->leito[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Registro = array('posx' => '10', 'posy' => '60', 'data' => $this->registro[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Atendimento = array('posx' => '10', 'posy' => '70', 'data' => $this->atendimento[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Data = array('posx' => '10', 'posy' => '80', 'data' => $this->data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Hora = array('posx' => '10', 'posy' => '90', 'data' => $this->hora[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);

          /*------------------ Page 1 -----------------*/

            $this->Pdf->SetFont($cell_id_paciente['font_type'], $cell_id_paciente['font_style'], $cell_id_paciente['font_size']);
            $this->pdf_text_color($cell_id_paciente['data'], $cell_id_paciente['color_r'], $cell_id_paciente['color_g'], $cell_id_paciente['color_b']);
            if (!empty($cell_id_paciente['posx']) && !empty($cell_id_paciente['posy']))
            {
                $this->Pdf->SetXY($cell_id_paciente['posx'], $cell_id_paciente['posy']);
            }
            elseif (!empty($cell_id_paciente['posx']))
            {
                $this->Pdf->SetX($cell_id_paciente['posx']);
            }
            elseif (!empty($cell_id_paciente['posy']))
            {
                $this->Pdf->SetY($cell_id_paciente['posy']);
            }
            $this->Pdf->Cell($cell_id_paciente['width'], 0, $cell_id_paciente['data'], 0, 0, $cell_id_paciente['align']);

            $this->Pdf->SetFont($cell_Nome['font_type'], $cell_Nome['font_style'], $cell_Nome['font_size']);
            $this->pdf_text_color($cell_Nome['data'], $cell_Nome['color_r'], $cell_Nome['color_g'], $cell_Nome['color_b']);
            if (!empty($cell_Nome['posx']) && !empty($cell_Nome['posy']))
            {
                $this->Pdf->SetXY($cell_Nome['posx'], $cell_Nome['posy']);
            }
            elseif (!empty($cell_Nome['posx']))
            {
                $this->Pdf->SetX($cell_Nome['posx']);
            }
            elseif (!empty($cell_Nome['posy']))
            {
                $this->Pdf->SetY($cell_Nome['posy']);
            }
            $this->Pdf->Cell($cell_Nome['width'], 0, $cell_Nome['data'], 0, 0, $cell_Nome['align']);

            $this->Pdf->SetFont($cell_Idade['font_type'], $cell_Idade['font_style'], $cell_Idade['font_size']);
            $this->pdf_text_color($cell_Idade['data'], $cell_Idade['color_r'], $cell_Idade['color_g'], $cell_Idade['color_b']);
            if (!empty($cell_Idade['posx']) && !empty($cell_Idade['posy']))
            {
                $this->Pdf->SetXY($cell_Idade['posx'], $cell_Idade['posy']);
            }
            elseif (!empty($cell_Idade['posx']))
            {
                $this->Pdf->SetX($cell_Idade['posx']);
            }
            elseif (!empty($cell_Idade['posy']))
            {
                $this->Pdf->SetY($cell_Idade['posy']);
            }
            $this->Pdf->Cell($cell_Idade['width'], 0, $cell_Idade['data'], 0, 0, $cell_Idade['align']);

            $this->Pdf->SetFont($cell_sc_field_0['font_type'], $cell_sc_field_0['font_style'], $cell_sc_field_0['font_size']);
            $this->pdf_text_color($cell_sc_field_0['data'], $cell_sc_field_0['color_r'], $cell_sc_field_0['color_g'], $cell_sc_field_0['color_b']);
            if (!empty($cell_sc_field_0['posx']) && !empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_0['posx'], $cell_sc_field_0['posy']);
            }
            elseif (!empty($cell_sc_field_0['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_0['posx']);
            }
            elseif (!empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_0['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_0['width'], 0, $cell_sc_field_0['data'], 0, 0, $cell_sc_field_0['align']);

            $this->Pdf->SetFont($cell_Leito['font_type'], $cell_Leito['font_style'], $cell_Leito['font_size']);
            $this->pdf_text_color($cell_Leito['data'], $cell_Leito['color_r'], $cell_Leito['color_g'], $cell_Leito['color_b']);
            if (!empty($cell_Leito['posx']) && !empty($cell_Leito['posy']))
            {
                $this->Pdf->SetXY($cell_Leito['posx'], $cell_Leito['posy']);
            }
            elseif (!empty($cell_Leito['posx']))
            {
                $this->Pdf->SetX($cell_Leito['posx']);
            }
            elseif (!empty($cell_Leito['posy']))
            {
                $this->Pdf->SetY($cell_Leito['posy']);
            }
            $this->Pdf->Cell($cell_Leito['width'], 0, $cell_Leito['data'], 0, 0, $cell_Leito['align']);

            $this->Pdf->SetFont($cell_Registro['font_type'], $cell_Registro['font_style'], $cell_Registro['font_size']);
            $this->pdf_text_color($cell_Registro['data'], $cell_Registro['color_r'], $cell_Registro['color_g'], $cell_Registro['color_b']);
            if (!empty($cell_Registro['posx']) && !empty($cell_Registro['posy']))
            {
                $this->Pdf->SetXY($cell_Registro['posx'], $cell_Registro['posy']);
            }
            elseif (!empty($cell_Registro['posx']))
            {
                $this->Pdf->SetX($cell_Registro['posx']);
            }
            elseif (!empty($cell_Registro['posy']))
            {
                $this->Pdf->SetY($cell_Registro['posy']);
            }
            $this->Pdf->Cell($cell_Registro['width'], 0, $cell_Registro['data'], 0, 0, $cell_Registro['align']);

            $this->Pdf->SetFont($cell_Atendimento['font_type'], $cell_Atendimento['font_style'], $cell_Atendimento['font_size']);
            $this->pdf_text_color($cell_Atendimento['data'], $cell_Atendimento['color_r'], $cell_Atendimento['color_g'], $cell_Atendimento['color_b']);
            if (!empty($cell_Atendimento['posx']) && !empty($cell_Atendimento['posy']))
            {
                $this->Pdf->SetXY($cell_Atendimento['posx'], $cell_Atendimento['posy']);
            }
            elseif (!empty($cell_Atendimento['posx']))
            {
                $this->Pdf->SetX($cell_Atendimento['posx']);
            }
            elseif (!empty($cell_Atendimento['posy']))
            {
                $this->Pdf->SetY($cell_Atendimento['posy']);
            }
            $this->Pdf->Cell($cell_Atendimento['width'], 0, $cell_Atendimento['data'], 0, 0, $cell_Atendimento['align']);

            $this->Pdf->SetFont($cell_Data['font_type'], $cell_Data['font_style'], $cell_Data['font_size']);
            $this->pdf_text_color($cell_Data['data'], $cell_Data['color_r'], $cell_Data['color_g'], $cell_Data['color_b']);
            if (!empty($cell_Data['posx']) && !empty($cell_Data['posy']))
            {
                $this->Pdf->SetXY($cell_Data['posx'], $cell_Data['posy']);
            }
            elseif (!empty($cell_Data['posx']))
            {
                $this->Pdf->SetX($cell_Data['posx']);
            }
            elseif (!empty($cell_Data['posy']))
            {
                $this->Pdf->SetY($cell_Data['posy']);
            }
            $this->Pdf->Cell($cell_Data['width'], 0, $cell_Data['data'], 0, 0, $cell_Data['align']);

            $this->Pdf->SetFont($cell_Hora['font_type'], $cell_Hora['font_style'], $cell_Hora['font_size']);
            $this->pdf_text_color($cell_Hora['data'], $cell_Hora['color_r'], $cell_Hora['color_g'], $cell_Hora['color_b']);
            if (!empty($cell_Hora['posx']) && !empty($cell_Hora['posy']))
            {
                $this->Pdf->SetXY($cell_Hora['posx'], $cell_Hora['posy']);
            }
            elseif (!empty($cell_Hora['posx']))
            {
                $this->Pdf->SetX($cell_Hora['posx']);
            }
            elseif (!empty($cell_Hora['posy']))
            {
                $this->Pdf->SetY($cell_Hora['posy']);
            }
            $this->Pdf->Cell($cell_Hora['width'], 0, $cell_Hora['data'], 0, 0, $cell_Hora['align']);

          /*-------------------------------------------*/
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
 }
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
}
?>
