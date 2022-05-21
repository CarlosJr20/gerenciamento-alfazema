
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
  scEventControl_data["titulo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valor" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["quartos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["area" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["lote" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ano" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["imagem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["titulo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["titulo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valor" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valor" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quartos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quartos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["area" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["area" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["lote" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["lote" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ano" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ano" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["imagem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["imagem" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
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
  $('#id_sc_field_id' + iSeqRow).bind('change', function() { sc_form_novidade_imog_id_onchange(this, iSeqRow) });
  $('#id_sc_field_img' + iSeqRow).bind('change', function() { sc_form_novidade_imog_img_onchange(this, iSeqRow) });
  $('#id_sc_field_titulo' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_titulo_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_novidade_imog_titulo_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_novidade_imog_titulo_onfocus(this, iSeqRow) });
  $('#id_sc_field_valor' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_valor_onblur(this, iSeqRow) })
                                   .bind('change', function() { sc_form_novidade_imog_valor_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_novidade_imog_valor_onfocus(this, iSeqRow) });
  $('#id_sc_field_quartos' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_quartos_onblur(this, iSeqRow) })
                                     .bind('change', function() { sc_form_novidade_imog_quartos_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_novidade_imog_quartos_onfocus(this, iSeqRow) });
  $('#id_sc_field_area' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_area_onblur(this, iSeqRow) })
                                  .bind('change', function() { sc_form_novidade_imog_area_onchange(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_novidade_imog_area_onfocus(this, iSeqRow) });
  $('#id_sc_field_lote' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_lote_onblur(this, iSeqRow) })
                                  .bind('change', function() { sc_form_novidade_imog_lote_onchange(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_novidade_imog_lote_onfocus(this, iSeqRow) });
  $('#id_sc_field_ano' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_ano_onblur(this, iSeqRow) })
                                 .bind('change', function() { sc_form_novidade_imog_ano_onchange(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_novidade_imog_ano_onfocus(this, iSeqRow) });
  $('#id_sc_field_descricao' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_descricao_onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_novidade_imog_descricao_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_novidade_imog_descricao_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_hora' + iSeqRow).bind('change', function() { sc_form_novidade_imog_data_hora_onchange(this, iSeqRow) });
  $('#id_sc_field_data_hora_hora' + iSeqRow).bind('change', function() { sc_form_novidade_imog_data_hora_hora_onchange(this, iSeqRow) });
  $('#id_sc_field_imagem' + iSeqRow).bind('blur', function() { sc_form_novidade_imog_imagem_onblur(this, iSeqRow) })
                                    .bind('change', function() { sc_form_novidade_imog_imagem_onchange(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_novidade_imog_imagem_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_novidade_imog_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_img_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_titulo_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_titulo();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_titulo_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_titulo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_valor_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_valor();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_valor_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_valor_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_quartos_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_quartos();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_quartos_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_quartos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_area_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_area();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_area_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_area_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_lote_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_lote();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_lote_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_lote_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_ano_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_ano();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_ano_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_ano_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_descricao_onblur(oThis, iSeqRow) {
  do_ajax_form_novidade_imog_validate_descricao();
  scCssBlur(oThis);
}

function sc_form_novidade_imog_descricao_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_descricao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_novidade_imog_data_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_data_hora_hora_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_imagem_onblur(oThis, iSeqRow) {
  scCssBlur(oThis);
}

function sc_form_novidade_imog_imagem_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_novidade_imog_imagem_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
	if ("1" == block) {
		displayChange_block_1(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("titulo", "", status);
	displayChange_field("valor", "", status);
	displayChange_field("quartos", "", status);
	displayChange_field("area", "", status);
	displayChange_field("lote", "", status);
	displayChange_field("ano", "", status);
	displayChange_field("descricao", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("imagem", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_titulo(row, status);
	displayChange_field_valor(row, status);
	displayChange_field_quartos(row, status);
	displayChange_field_area(row, status);
	displayChange_field_lote(row, status);
	displayChange_field_ano(row, status);
	displayChange_field_descricao(row, status);
	displayChange_field_imagem(row, status);
}

function displayChange_field(field, row, status) {
	if ("titulo" == field) {
		displayChange_field_titulo(row, status);
	}
	if ("valor" == field) {
		displayChange_field_valor(row, status);
	}
	if ("quartos" == field) {
		displayChange_field_quartos(row, status);
	}
	if ("area" == field) {
		displayChange_field_area(row, status);
	}
	if ("lote" == field) {
		displayChange_field_lote(row, status);
	}
	if ("ano" == field) {
		displayChange_field_ano(row, status);
	}
	if ("descricao" == field) {
		displayChange_field_descricao(row, status);
	}
	if ("imagem" == field) {
		displayChange_field_imagem(row, status);
	}
}

function displayChange_field_titulo(row, status) {
}

function displayChange_field_valor(row, status) {
}

function displayChange_field_quartos(row, status) {
}

function displayChange_field_area(row, status) {
}

function displayChange_field_lote(row, status) {
}

function displayChange_field_ano(row, status) {
}

function displayChange_field_descricao(row, status) {
}

function displayChange_field_imagem(row, status) {
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_novidade_imog_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(26);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_data_hora" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_hora" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['data_hora']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['data_hora']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_novidade_imog_validate_data_hora(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['data_hora']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "<?php echo $miniCalendarFA; ?>",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "<?php echo $miniCalendarButton[0]; ?>",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });
} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_img" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_novidade_imog_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'img'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_img" + iSeqRow);
        loaderContent = $("#id_img_loader_img" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_img" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_img" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_img" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_img" + iSeqRow).val("");
      $("#id_sc_field_img_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_img_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_img = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_img) ? "none" : "";
      $("#id_ajax_img_img" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_img" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_img) {
        document.F1.temp_out_img.value = var_ajax_img_thumb;
        document.F1.temp_out1_img.value = var_ajax_img_img;
      }
      else if (document.F1.temp_out_img) {
        document.F1.temp_out_img.value = var_ajax_img_img;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_img" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_img" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_img" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_img" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_novidade_imog')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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
});<?php

if (isset($GLOBALS['erro_incl']) && 1 == $GLOBALS['erro_incl'] && isset($this->ul_info_imagem) && '' != $this->ul_info_imagem)
{
    $aTmpUploads = explode('@scl@', $this->ul_info_imagem);
?>
var scUploadCount_imagem = <?php echo sizeof($aTmpUploads); ?>;
var scUploadQueue_imagem = new Array("<?php echo implode('", "', $aTmpUploads); ?>");
<?php
}
else
{
?>
var scUploadCount_imagem = 0;
var scUploadQueue_imagem = new Array();
<?php
}

?>
var scUploadFiles_imagem = 0;
var scFileQ_imagem = [];
function scJQMultiUploadAdd(iSeqRow) {
  $("#id_sc_field_imagem" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_novidade_imog_ul_save.php",
    dropZone: $("#id_sc_dragdrop_imagem" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'imagem'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    add: function (e, data) {
      var $elemSubmit, $divUpload, htmlUpload;
      $elemSubmit = $("#id_sc_submit_imagem" + iSeqRow);
      if (!$elemSubmit.hasClass("sc_upload_submit")) {
        $elemSubmit.click(function () {
          data.submit();
        }).add("sc_upload_submit");
      }
      $divUpload = $("#id_sc_upload_todo_imagem" + iSeqRow);
      $.each(data.files, function (index, file) {
        var tableUploadId = 'id_sc_file_imagem_' + scUploadFiles_imagem;
        scFileQ_imagem.push(file.name);
        htmlUpload = $("<table id='" + tableUploadId + "' style='border-collapse: collapse; border-width: 0'><tr><td style='padding: 0'><img src='" + sc_img_mupload_pending + "' style='border-width: 0' title='<?php echo $this->Ini->Nm_lang['lang_upload_pending'] ?>' /></td><td class='sc_ui_mu_status_imagem' style='padding: 1px 5px 1px 2px; white-space: nowrap'>" + file.name + " <a href='javascript:scJQMultiUploadRemove_imagem(\"" + tableUploadId + "\", \"" + file.name + "\")'><img src='<?php echo $this->Ini->path_icones ?>/scriptcase__NM__trash.gif' style='border-width: 0; vertical-align: middle'></a></td><td style='padding: 1px 5px'><?php echo $this->Ini->Nm_lang['lang_errm_mu_pending'] ?></td></table>");
        $divUpload.append(htmlUpload);
        scUploadFiles_imagem++;
      });
      sc_mupload_ok = false;
      scJQMultiFixStatus("imagem");
    },
    send: function (e, data) {
      if (scFileQ_imagem.includes(data.files[0].name)) {
        scFileQ_imagem.splice(scFileQ_imagem.indexOf(data.files[0].name), 1);
      } else {
        e.preventDefault();
      }
    },
    progressall: function (e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_imagem" + iSeqRow);
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_imagem" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var i, fileData, respData, respPos, respMsg, $loader, $elemSubmit, $divUploadTodo, $divUploadDone, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $loader = $("#id_img_loader_imagem" + iSeqRow);
        $loader.hide();
      }
      else
      {
        $loader = $("#id_ajax_loader_imagem" + iSeqRow);
        $loader.hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = fileData[0].error;
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $elemSubmit = $("#id_sc_submit_imagem" + iSeqRow);
      $elemSubmit.unbind("click").removeClass("sc_upload_submit");
      $divUploadTodo = $("#id_sc_upload_todo_imagem" + iSeqRow);
      $divUploadTodo.html("");
      $divUploadDone = $("#id_sc_upload_done_imagem" + iSeqRow);
      for (i = 0; i < fileData.length; i++) {
        scUploadCount_imagem++;
        scUploadQueue_imagem.push("add@sci@" + fileData[i].name_prot + "@sci@" + fileData[i].sc_random_prot + "@sci@" + scUploadCount_imagem);
        $divUploadDone.html($divUploadDone.html() + "<table id='id_sc_fileok_imagem_" + scUploadCount_imagem + "' style='border-collapse: collapse; border-width: 0'><tr><td style='padding: 0'><img src='" + sc_img_mupload_finished + "' style='border-width: 0' title='<?php echo $this->Ini->Nm_lang['lang_upload_completed'] ?>' /></td><td class='sc_ui_mu_status_imagem' style='padding: 1px 5px 1px 2px; white-space: nowrap'>" + fileData[i].name + "&nbsp;<a href='javascript:scJQMultiUploadCancel_imagem(" + scUploadCount_imagem + ")'><img src='<?php echo $this->Ini->path_icones ?>/scriptcase__NM__trash.gif' style='border-width: 0; vertical-align: middle'></a></td><td style='padding: 1px 5px'><?php echo $this->Ini->Nm_lang['lang_errm_mu_complete'] ?></td></tr></table>");
      }
      sc_mupload_ok = true;
      scJQMultiFixStatus("imagem");
    }
  });

} // scJQMultiUploadAdd

function scJQMultiFixStatus(fieldName) {
  var i, maxWidth = 0, $itemList;
  $itemList = $(".sc_ui_mu_status_" + fieldName);
  for (i = 0; i < $itemList.length; i++) {
    maxWidth = Math.max(maxWidth, $($itemList[i]).width());
  }
  if (0 < maxWidth) {
    $itemList.css("width", maxWidth + "px");
  }
} // scJQMultiFixStatus

function scJQMultiUploadPrepare_imagem() {
  var i, $delItems = $(".id_mu_chkbx_imagem:checked");
  for (i = 0; i < $delItems.length; i++) {
    scUploadCount_imagem++;
    scUploadQueue_imagem.push("del@sci@" + $($delItems[i]).val() + "@sci@@sci@" + scUploadCount_imagem);
  }
  return scUploadQueue_imagem.join("@scl@");
} // scJQMultiUploadPrepare_imagem

function scJQMultiUploadCancel_imagem(itemIndex) {
  var i, ulInfo;
  for (i = 0; i < scUploadQueue_imagem.length; i++) {
    ulInfo = scUploadQueue_imagem[i].split("@sci@");
    if (ulInfo[3] == itemIndex) {
      scUploadQueue_imagem.splice(i, 1);
      $("#id_sc_fileok_imagem_" + itemIndex).hide();
    }
  }
} // scJQMultiUploadCancel_imagem

function scJQMultiUploadRemove_imagem(tableRow, fileName) {
  if (scFileQ_imagem.includes(fileName)) {
    scFileQ_imagem.splice(scFileQ_imagem.indexOf(fileName), 1);
  }
  $("#" + tableRow).remove();
} // scJQMultiUploadRemove_imagem

function scJQPasswordToggleAdd(seqRow) {
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
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQMultiUploadAdd(iLine);
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

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };
  $('#sc_btgp_btn_' + sGroup).addClass('selected');
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    scBtnGrpStatus[sGroup] = '';
    setTimeout(function() {
      scBtnGrpHide(sGroup, false);
    }, 1000);
  }).mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup, false);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup, false);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup, bForce) {
  if (bForce || 'over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
    $('#sc_btgp_btn_' + sGroup).addClass('selected');
  }
}
