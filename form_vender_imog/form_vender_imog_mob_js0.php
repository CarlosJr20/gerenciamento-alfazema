<form name="F2" method=post 
               action="form_vender_imog_mob.php" 
               target="_self"> 
<input type="hidden" name="id" value="<?php echo $this->form_encode_input($this->nmgp_dados_form['id']); ?>">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="master_nav" value="off">
<input type="hidden" name="sc_ifr_height" value="">
<input type="hidden" name="nmgp_parms" value=""/>
<input type="hidden" name="nmgp_ordem" value=""/>
<input type="hidden" name="nmgp_clone" value=""/>
<input type="hidden" name="nmgp_fast_search" value=""/>
<input type="hidden" name="nmgp_cond_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_dyn_search" value=""/>
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<form name="F5" method="post" 
                  action="form_vender_imog_mob.php" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value="<?php if ($this->nm_Start_new) {echo "ini";} elseif ($this->sc_insert_on) {echo "final";} else {echo "igual";}?>"/>
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['form_vender_imog_mob']['parms']); ?>"/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F6" method="post" 
                  action="form_vender_imog_mob.php" 
                  target="_self"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F7" method="post" 
                  action="form_vender_imog_mob.php" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value="change_qtd_line"/>
  <input type="hidden" name="nmgp_max_line" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F8" method="post" 
                  action="form_vender_imog_mob.php" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value=""/>
  <input type="hidden" name="nmgp_tipo_pdf" value=""/>
  <input type="hidden" name="nmgp_parms_pdf" value=""/>
  <input type="hidden" name="use_pass_pdf" value=""/>
  <input type="hidden" name="pdf_zip" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="Fprint" method="post" 
            action="form_vender_imog_mob.php" 
                     target="_self" style="display: none"> 
  <input type="hidden" name="nmgp_opcao" value="print"/>
  <input type="hidden" name="nmgp_tipo_print" value="RC"/>
  <input type="hidden" name="nmgp_cor_print" value="CO"/>
  <input type="hidden" name="nmgp_password" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>"/> 
</form> 
<form name="FCAP" action="" method="post" target="_blank"> 
  <input type="hidden" name="SC_lig_apl_orig" value="form_vender_imog_mob"/>
  <input type="hidden" name="nmgp_parms" value=""> 
  <input type="hidden" name="nmgp_outra_jan" value="true"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<div id="id_div_process" style="display: none; margin: 10px; whitespace: nowrap" class="scFormProcessFixed"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_fatal_error" class="scFormLabelOdd" style="display: none; position: absolute"></div>
<script type="text/javascript"> 
 NM_tp_critica(1);

function scInlineFormSend()
{
  return false;
}

function nm_navpage(x, op) 
{ 
    nm_move('navpage', x);
} 
function nm_gp_export(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) 
{ 
    document.F8.nmgp_opcao.value  = x;
    document.F8.nmgp_tipo_pdf.value  = z;
    document.F8.nmgp_parms_pdf.value = p;
    document.F8.use_pass_pdf.value = use_pass_pdf;
    document.F8.pdf_zip.value = pdf_zip;
    if (y == 1) 
    {
        document.F8.target = "_blank"; 
    }
    document.F8.submit();
}
   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)
   {
       if (password != "")
       {
           document.Fprint.nmgp_cor_print.value =  cor;
           document.Fprint.nmgp_password.value =  password;
           document.Fprint.submit();
       }
       else
       {
           window.open('<?php echo$this->Ini->path_link . "" . SC_dir_app_name('form_vender_i') . "/form_vender_i_iframe_prt.php?path_botoes=" . $this->Ini->path_botoes . "&script_case_init=" . $this->form_encode_input($this->Ini->sc_page); ?>&apl_prt=form_vender_imog_mob.php&opcao=print&cor_print=' + cor,'','location=no,menubar,resizable,scrollbars,status=no,toolbar');
       }
   }
function nm_move(x, y, z) 
{ 
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (("inicio" == x || "retorna" == x) && "S" != Nav_permite_ret)
    {
        return;
    }
    if (("avanca" == x || "final" == x) && "S" != Nav_permite_ava)
    {
        return;
    }
    document.F2.nmgp_opcao.value = x; 
    document.F2.nmgp_ordem.value = y; 
    document.F2.nmgp_clone.value = "";
    if ("apl_detalhe" == x)
    {
        document.F2.nmgp_opcao.value = 'igual'; 
        document.F2.master_nav.value = 'on'; 
        if (z)
        {
            document.F2.sc_ifr_height.value = z;
        }
        document.F2.submit();
        return;
    }
    if ("clone" == x)
    {
        x = "novo";
        document.F2.nmgp_clone.value = "S";
        document.F2.nmgp_opcao.value = x; 
    }
    if ("fast_search" == x)
    {
        document.F2.nmgp_ordem.value = ''; 
        document.F2.nmgp_fast_search.value = scAjaxGetFieldSelectMult("nmgp_fast_search_" + y, ";"); 
        if(document.F2.nmgp_fast_search.value == '') 
        { 
           document.F2.nmgp_fast_search.value = 'SC_all_Cmp'; 
        } 
        document.F2.nmgp_arg_fast_search.value = scAjaxGetFieldText("nmgp_arg_fast_search_" + y); 
        var ver_ch = eval('change_fast_' + y);
        if (document.F2.nmgp_arg_fast_search.value == '' && ver_ch == '')
        { 
            scJs_alert("<?php echo $this->Ini->Nm_lang['lang_srch_req_field'] ?>");
            document.F1.elements["nmgp_arg_fast_search_" + y].focus();
            return false;
        } 
        if (document.F2.nmgp_arg_fast_search.value == '__Clear_Fast__')
        { 
            document.F2.nmgp_arg_fast_search.value = '';
            document.F1.elements["nmgp_arg_fast_search_" + y].value = '';
        } 
        if(document.F2.nmgp_arg_fast_search.value == '') 
        { 
            $('#SC_fast_search_close_' + y).hide();
            $('#SC_fast_search_submit_' + y).show();
        } 
        else 
        { 
            $('#SC_fast_search_close_' + y).show();
            $('#SC_fast_search_submit_' + y).hide();
        } 
        document.F2.nmgp_cond_fast_search.value = scAjaxGetFieldSelect("nmgp_cond_fast_search_" + y); 
    }
    if ("novo" == x || "edit_novo" == x)
    {
<?php
       $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
        document.F2.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
        if (scFormHasChanged) {
          scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F2.submit(); }, function() {});
        } else {
          document.F2.submit();
        }
    }
    else
    {
        do_ajax_form_vender_imog_mob_navigate_form();
    }
} 
var sc_mupload_ok = true;
var Nm_submit_ok = true; 
function nm_atualiza(x, y) 
{ 
    if ("incluir" == x) {
        scForm_insert(x, y);
        return;
    }
    if ("alterar" == x) {
        scForm_update(x, y);
        return;
    }
    if ("excluir" == x) {
        scForm_delete(x, y);
        return;
    }
    if ("recarga_mobile" == x) {
        scForm_refreshMobile(x, y);
        return;
    }
    if ("muda_form" == x) {
        scForm_changeForm(x, y);
        return;
    }
<?php 
    if (isset($this->Refresh_aba_menu)) 
    {
?>
        parent.Tab_refresh['<?php echo $this->Refresh_aba_menu ?>'] = "S";
<?php 
    }
?>
    if (!sc_mupload_ok)
    {
        if (!confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>"))
        {
            return;
        }
        sc_mupload_ok = true;
    }
    Nm_submit_ok = true; 
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (!scAjaxDetailProc())
    {
        return;
    }
<?php
    $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
    document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
    document.F1.target = "_self";
    if (x == "muda_form") 
    { 
       document.F1.nmgp_num_form.value = y; 
    } 
    if (x == "excluir") 
    { 
       if (confirm ("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"))  
       { 
           scAjaxProcOn();
           document.F1.nmgp_opcao.value = x; 
           document.F1.submit(); 
       } 
       else 
       { 
          return; 
       } 
    } 
    else 
    { 
       document.F1.nmgp_opcao.value = x; 
       if ("incluir" == x || "muda_form" == x || "recarga" == x || "recarga_mobile" == x)
       {
           document.F1.ul_info_imagem.value = scJQMultiUploadPrepare_imagem();
           scAjaxProcOn();
           Nm_Proc_Atualiz = true;
           document.F1.submit();
       }
       else
       {
           Nm_Proc_Atualiz = true;
           do_ajax_form_vender_imog_mob_submit_form();
       }
    } 
    if (Nm_submit_ok)
    { 
        Nm_Proc_Atualiz = true;
    } 
} 

<?php
$NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
function scForm_cancel() {
	return;
}
function scForm_insert(x, y) {
	if (!scForm_initSubmit(x, y)) { return; }
	scForm_checkMultiUpload(function() { scForm_insert_prepare(x, y); }, scForm_cancel);
} // scForm_insert

function scForm_update(x, y) {
	if (!scForm_initSubmit(x, y)) { return; }
	scForm_checkMultiUpload(function() { scForm_update_prepare(x, y); }, scForm_cancel);
} // scForm_update

function scForm_delete(x, y) {
	if (!scForm_initSubmit(x, y)) { return; }
	scForm_checkMultiUpload(function() { scForm_delete_prepare(x, y); }, scForm_cancel);
} // scForm_delete

function scForm_refreshMobile(x, y) {
	if (!scForm_initSubmit(x, y)) { return; }
	scForm_checkMultiUpload(function() { scForm_refreshMobile_prepare(x, y); }, scForm_cancel);
} // scForm_refreshMobile

function scForm_changeForm(x, y) {
	if (!scForm_initSubmit(x, y)) { return; }
	scForm_checkMultiUpload(function() { scForm_changeForm_prepare(x, y); }, scForm_cancel);
} // scForm_changeForm

function scForm_insert_prepare(x, y) {
	scForm_general_prepare(x, y);
	scForm_confirmInsert_single(function() { scForm_submit_single(x); }, scForm_cancel);
} // scForm_insert_prepare

function scForm_update_prepare(x, y) {
	scForm_general_prepare(x, y);
	scForm_confirmUpdate_single(function() { scForm_submit_single(x); }, scForm_cancel);
} // scForm_update_prepare

function scForm_delete_prepare(x, y) {
	scForm_general_prepare(x, y);
	scForm_confirmDelete(function() { scForm_delete_submit(x); }, scForm_cancel);
} // scForm_delete_prepare

function scForm_refreshMobile_prepare(x, y) {
	scForm_general_prepare(x, y);
	scForm_submit_single(x);
} // scForm_refreshMobile_prepare

function scForm_changeForm_prepare(x, y) {
	scForm_general_prepare(x, y);
	scForm_submit_single(x);
} // scForm_changeForm_prepare

function scForm_delete_submit(x) {
    scAjaxProcOn();
	document.F1.nmgp_opcao.value = x;
	document.F1.submit();
}

function scForm_general_prepare(x, y) {
	sc_mupload_ok = true;
	if (false === scForm_onSubmit(x)) {
		return;
	}
	scForm_setFormValues(x, y);
	scForm_packMultiSelect_single();
} // scForm_general_prepare

function scForm_initSubmit(x, y) {
<?php
if (isset($this->Refresh_aba_menu)) {
?>
	parent.Tab_refresh["<?php echo $this->Refresh_aba_menu ?>"] = "S";
<?php
}
?>

	Nm_submit_ok = true;
	if (Nm_Proc_Atualiz) {
		return false;
	}
	if (!scAjaxDetailProc()) {
		return false;
	}

	return true;
} // scForm_initSubmit


function scForm_checkMultiUpload(callbackOk, callbackCancel) {
	if (!sc_mupload_ok) {
		scJs_confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>", callbackOk, callbackCancel);
	}
	else {
		callbackOk();
	}
} // scForm_checkMultiUpload

function scForm_onSubmit(x) {
	return true;
} // scForm_onSubmit

function scForm_setFormValues(x, y) {
	document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
	document.F1.target = "_self";
	if (x == "muda_form") {
		document.F1.nmgp_num_form.value = y;
	}
} // scForm_setFormValues

function scForm_packMultiSelect_single() {
} //scForm_packMultiSelect_single

function scForm_packMultiSelect_multi() {
	NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packMultiSelect_multi

function scForm_packSignature_single() {
} // scForm_packSignature_single

function scForm_packSignature_multi() {
	NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packSignature_multi

function scForm_confirmDelete(callbackOk, callbackCancel) {
	scJs_confirm("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", callbackOk, callbackCancel);
} // scForm_confirmDelete

function scForm_confirmInsert_single(callbackOk, callbackCancel) {
	callbackOk();
} // scForm_confirmInsert_single

function scForm_confirmUpdate_single(callbackOk, callbackCancel) {
	callbackOk();
} // scForm_confirmUpdate_single

function scForm_submit_control(x) {
	document.F1.nmgp_opcao.value = x;
	document.F1.submit();
	if (Nm_submit_ok) {
		Nm_Proc_Atualiz = true;
	}
} // scForm_submit_control

function scForm_submit_single(x) {
	if (x != "excluir")
	{
		document.F1.nmgp_opcao.value = x;
		if ("incluir" == x || "muda_form" == x || "recarga" == x || "recarga_mobile" == x) {
			document.F1.ul_info_imagem.value = scJQMultiUploadPrepare_imagem();
            scAjaxProcOn();
			Nm_Proc_Atualiz = true;
			document.F1.submit();
		}
		else {
			Nm_Proc_Atualiz = true;
			do_ajax_form_vender_imog_mob_submit_form();
		}
	}
	if (Nm_submit_ok) {
		Nm_Proc_Atualiz = true;
	}
} // scForm_submit_single

function nm_mostra_img(imagem, altura, largura)
{
    var image = new Image();
    image.src = imagem;
    var viewer = new Viewer(image, {
        navbar: false,
        hidden: function () {
            viewer.destroy();
        },
    });
    viewer.show();
}
function nm_recarga_form(nm_ult_ancora, nm_ult_page) 
{ 
    document.F1.target = "_self";
    document.F1.nmgp_parms.value = "";
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_opcao.value= "recarga"; 
    document.F1.action += "#" +  nm_ult_ancora;
    document.F1.submit(); 
} 
function nm_link_url(Sc_url)
{
    if (Sc_url.substr(0, 7) != 'http://' && Sc_url.substr(0, 8) != 'https://')
    {
        Sc_url = 'http://' + Sc_url;
    }
    return Sc_url;
}
function sc_trim(str, chars) {
        return sc_ltrim(sc_rtrim(str, chars), chars);
}
function sc_ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
function sc_rtrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
var hasJsFormOnload = false;

function scCssFocus(oHtmlObj)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  if ($(oHtmlObj).hasClass('sc-ui-pwd-toggle')) {
    $(oHtmlObj).addClass('scFormObjectFocusOddPwdInput')
               .addClass('scFormObjectFocusOddPwdText')
               .removeClass('scFormObjectOddPwdInput')
               .removeClass('scFormObjectOddPwdText');
    $(oHtmlObj).parent().addClass('scFormObjectFocusOddPwdBox')
                        .removeClass('scFormObjectOddPwdBox');
  } else {
    $(oHtmlObj).addClass('scFormObjectFocusOdd')
               .removeClass('scFormObjectOdd');
  }
}

function scCssBlur(oHtmlObj)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  if ($(oHtmlObj).hasClass('sc-ui-pwd-toggle')) {
    $(oHtmlObj).addClass('scFormObjectOddPwdInput')
               .addClass('scFormObjectOddPwdText')
               .removeClass('scFormObjectFocusOddPwdInput')
               .removeClass('scFormObjectFocusOddPwdText');
    $(oHtmlObj).parent().addClass('scFormObjectOddPwdBox')
                        .removeClass('scFormObjectFocusOddPwdBox');
  } else {
    $(oHtmlObj).addClass('scFormObjectOdd')
               .removeClass('scFormObjectFocusOdd');
  }
}

 function nm_submit_cap(apl_dest, parms)
 {
    document.FCAP.action = apl_dest;
    document.FCAP.nmgp_parms.value = parms;
    window.open('','jan_cap','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
    document.FCAP.target = "jan_cap"; 
    document.FCAP.submit();
 }
</script> 
