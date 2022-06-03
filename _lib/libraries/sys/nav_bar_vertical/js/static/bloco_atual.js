	$( document ).ready(function() {
  //  var tempo = 10000; //10 segundos

    //(function selectNumUsuarios () {
        $.ajax({
	   //  type: 'GET',
          url: "numero_atual.php",
		// dataType: 'php',
          success: function (n) {
              //essa é a function success, será executada se a requisição obtiver exito
              $("#bloco_atual").text(n);
          }//,
         // complete: function () {
             // setTimeout(selectNumUsuarios,tempo);
         // }
       });
   // })();
});
