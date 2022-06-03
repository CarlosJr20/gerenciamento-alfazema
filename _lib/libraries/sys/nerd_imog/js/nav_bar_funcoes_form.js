
function Mudarestado(el, t_p) {// exibe ou oculta uma div
	var display = document.getElementById(el).style.display;
	if (t_p === 0){
		if(display == "none")
			document.getElementById(el).style.display = 'block';
		else
			document.getElementById(el).style.display = 'none';
	}else{
		if (t_p == 1){
			document.getElementById(el).style.display = 'block';
		}else{
			document.getElementById(el).style.display = 'none';
		}
	}
}

function muda_estado_select(id_el_atual, nome_div) {// exibe ou oculta um select
	var spl = id_el_atual.split("_");
	var inic;
	var iLoop;
	var alt_base = 62;
	var alt;

	for (iLoop = 1; iLoop <= 10; iLoop++) {
		if(document.getElementById(spl[0]+'_'+iLoop).value === ""){
			inic = iLoop + 1;
			break;
		}
	}
	for (iLoop = 1; iLoop <= 10; iLoop++) {
		if (iLoop >= inic){
			document.getElementById(spl[0]+'_'+iLoop).style.display = "none";
			document.getElementById(spl[0]+'_'+iLoop).options[0].selected = "true"
		}else{
			document.getElementById(spl[0]+'_'+iLoop).style.display = "block";
		}
	}
	alt = alt_base * inic;
	document.getElementById(nome_div).style.height = alt + 'px';	
}

function nome_arquivo(id_file){
	var d_iretorio = document.getElementById(id_file).value;
	var d_iretorio_split = d_iretorio.split('\\');
	var d_iretorio_split = d_iretorio_split[d_iretorio_split.length -1];
	alert(d_iretorio_split);
	return d_iretorio_split;				
}

function readURL(input, id_nome, id_img) {
	var in_put = document.getElementById(input);
	if (in_put.files.length === 0) {
		alert('Selecione uma imagem.');
	}else{
		var reader = new FileReader();
		document.getElementById(id_nome).value = in_put.files[0].name;
		reader.onload = function (e) {
			$('#' + id_img).attr('src', e.target.result);
		}
		reader.readAsDataURL(in_put.files[0]);
	}
}

function carrega_logo(id_img, nome_img, pasta_img) {
	if (nome_img === '') {
		$('#' + id_img).removeAttr('src');
	}else{
		var arq = pasta_img + nome_img;
		$('#' + id_img).attr('src', arq);
	}
}	

function extensao_arq(nome_arquivo){
	var r;
	if (nome_arquivo === "") {
		r = "";
	}else{
		var nm = nome_arquivo.split('.');
		nm = nm[nm.length -1].toLowerCase();
		if ((nm == 'doc') || (nm == 'docm') || (nm == 'docx')){
			r = 'doc';
		}else if ((nm == 'xls') || (nm == 'xlsm') || (nm == 'xlsx')){
			r = 'xls';
		}else if (nm == 'pdf'){
			r = 'pdf';
		}else if (nm == 'txt'){
			r = 'txt';
		}else{ 
			r = 'arquivo';
		}
	}
	return r;
}

function carrega_logo(id_img, nome_img) {
	//alert(id_img +', '+ nome_img)
	if (nome_img === '') {
		$('#' + id_img).removeAttr('src');
	}else{
		var arq = "../_lib/libraries/sys/nav_bar_vertical/img/" + nome_img;
		$('#' + id_img).attr('src', arq);
	}
}	

function carrega_link(id_link, nome_d, extensao_d, nome_novo) {
	//alert(id_img +', '+ nome_img)
	if (nome_d === '') {
		$('#' + id_link).removeAttr('download');
		$('#' + id_link).removeAttr('href');
	}else{
		var arq = "../_lib/file/doc/" + nome_d;
		var nom_n = nome_novo.replace('nome_','') + '.' + extensao_d;

		$('#' + id_link).attr('download', nom_n);
		$('#' + id_link).attr('href', arq);
	}
}

function carrega_icone_arquivo(inp_nome, id_img, id_link){
	var in_put = document.getElementById(inp_nome);
	var nome_image, exten;

	if (in_put.value !== '') {
		exten = extensao_arq(in_put.value);
		if (exten !== ''){
			nome_image = 'icone_' + exten + '.png';
		}else{
			nome_image = '';
		}
		carrega_logo(id_img, nome_image);
		carrega_link(id_link, in_put.value, exten, inp_nome);
	}
}

function carrega_icone_arquivo_onchange(inp_nome, id_nome,id_img, id_link){
	var in_put = document.getElementById(inp_nome);
	var nome_image, exten;

	if (in_put.files.length == 0) {
		//alert('Selecione um arquivo.');
	}else{
		document.getElementById(id_nome).value = in_put.files[0].name;
		exten = extensao_arq(in_put.files[0].name);
		if (exten != ''){
			nome_image = 'icone_' + exten + '.png';
		}
		carrega_logo(id_img, nome_image);
		carrega_link(id_link, '', '', '');
	}
}