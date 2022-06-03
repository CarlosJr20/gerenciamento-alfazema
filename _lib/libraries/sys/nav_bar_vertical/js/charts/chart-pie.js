// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

	$( document ).ready(function() {
    var tempo = 10000; //10 segundos


        $.ajax({
	   //  type: 'GET',
          url: "chart_dount.php",
		//	 dataType: 'php',
          success: function (data) {
			  
			   var nomearray = [];
               var quantarray = [];
			  
			  
			  for (var i = 0; i < data.length; i++) {

                nomearray.push(data[i].nome_da_empresa);
               quantarray.push(data[i].quant);

            }
			  grafico(nomearray,quantarray);
			  
            //  $("#myPieChart").text(n);
          }
         
       });

})

function(nome_da_empresa,quant){
// Pie Chart Example
var ctx = document.getElementById("clientes_projeto");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: nome_da_empresa ,
    datasets: [{
      data: quant,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
}