
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField)) {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["selecao_projetos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tag" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["selecao_atividade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["data" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_inicio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_final" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["selecao_projetos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["selecao_projetos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tag" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tag" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["selecao_atividade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["selecao_atividade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_inicio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_inicio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_final" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_final" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("selecao_projetos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tag" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("selecao_atividade" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id_atividade_mp' + iSeqRow).bind('change', function() { sc_form_atividade_mp_carlos_id_atividade_mp_onchange(this, iSeqRow) });
  $('#id_sc_field_selecao_projetos' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_selecao_projetos_onblur(this, iSeqRow) })
                                              .bind('change', function() { sc_form_atividade_mp_carlos_selecao_projetos_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_atividade_mp_carlos_selecao_projetos_onfocus(this, iSeqRow) });
  $('#id_sc_field_tag' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_tag_onblur(this, iSeqRow) })
                                 .bind('change', function() { sc_form_atividade_mp_carlos_tag_onchange(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_atividade_mp_carlos_tag_onfocus(this, iSeqRow) });
  $('#id_sc_field_selecao_atividade' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_selecao_atividade_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_atividade_mp_carlos_selecao_atividade_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_atividade_mp_carlos_selecao_atividade_onfocus(this, iSeqRow) });
  $('#id_sc_field_data' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_data_onblur(this, iSeqRow) })
                                  .bind('change', function() { sc_form_atividade_mp_carlos_data_onchange(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_atividade_mp_carlos_data_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora_inicio' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_hora_inicio_onblur(this, iSeqRow) })
                                         .bind('change', function() { sc_form_atividade_mp_carlos_hora_inicio_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_atividade_mp_carlos_hora_inicio_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora_final' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_hora_final_onblur(this, iSeqRow) })
                                        .bind('change', function() { sc_form_atividade_mp_carlos_hora_final_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_atividade_mp_carlos_hora_final_onfocus(this, iSeqRow) });
  $('#id_sc_field_descricao' + iSeqRow).bind('blur', function() { sc_form_atividade_mp_carlos_descricao_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_atividade_mp_carlos_descricao_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_atividade_mp_carlos_descricao_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_atividade_mp_carlos_id_atividade_mp_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_selecao_projetos_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_selecao_projetos();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_selecao_projetos_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_selecao_projetos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_tag_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_tag();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_tag_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_tag_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_selecao_atividade_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_selecao_atividade();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_selecao_atividade_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_selecao_atividade_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_data_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_data();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_data_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_data_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_hora_inicio_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_hora_inicio();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_hora_inicio_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_hora_inicio_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_hora_final_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_hora_final();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_hora_final_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_hora_final_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_atividade_mp_carlos_descricao_onblur(oThis, iSeqRow) {
  do_ajax_form_atividade_mp_carlos_validate_descricao();
  scCssBlur(oThis);
}

function sc_form_atividade_mp_carlos_descricao_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_atividade_mp_carlos_descricao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("selecao_projetos", "", status);
	displayChange_field("tag", "", status);
	displayChange_field("selecao_atividade", "", status);
	displayChange_field("data", "", status);
	displayChange_field("hora_inicio", "", status);
	displayChange_field("hora_final", "", status);
	displayChange_field("descricao", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_selecao_projetos(row, status);
	displayChange_field_tag(row, status);
	displayChange_field_selecao_atividade(row, status);
	displayChange_field_data(row, status);
	displayChange_field_hora_inicio(row, status);
	displayChange_field_hora_final(row, status);
	displayChange_field_descricao(row, status);
}

function displayChange_field(field, row, status) {
	if ("selecao_projetos" == field) {
		displayChange_field_selecao_projetos(row, status);
	}
	if ("tag" == field) {
		displayChange_field_tag(row, status);
	}
	if ("selecao_atividade" == field) {
		displayChange_field_selecao_atividade(row, status);
	}
	if ("data" == field) {
		displayChange_field_data(row, status);
	}
	if ("hora_inicio" == field) {
		displayChange_field_hora_inicio(row, status);
	}
	if ("hora_final" == field) {
		displayChange_field_hora_final(row, status);
	}
	if ("descricao" == field) {
		displayChange_field_descricao(row, status);
	}
}

function displayChange_field_selecao_projetos(row, status) {
}

function displayChange_field_tag(row, status) {
}

function displayChange_field_selecao_atividade(row, status) {
}

function displayChange_field_data(row, status) {
}

function displayChange_field_hora_inicio(row, status) {
}

function displayChange_field_hora_final(row, status) {
}

function displayChange_field_descricao(row, status) {
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_atividade_mp_carlos_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(32);
		}
	}
}
function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_atividade_mp_carlos')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});function scJQPasswordToggleAdd(seqRow) {
  $(".sc-ui-pwd-toggle-icon" + seqRow).on("click", function() {
    var fieldName = $(this).attr("id").substr(17), fieldObj = $("#id_sc_field_" + fieldName), fieldFA = $("#id_pwd_fa_" + fieldName);
    if ("text" == fieldObj.attr("type")) {
      fieldObj.attr("type", "password");
      fieldFA.attr("class", "fa fa-eye sc-ui-pwd-eye");
    } else {
      fieldObj.attr("type", "text");
      fieldFA.attr("class", "fa fa-eye-slash sc-ui-pwd-eye");
    }
  });
} // scJQPasswordToggleAdd

function scJQSelect2Add(seqRow, specificField) {
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

