 var clic = 1;
    lotes = "";
    punto="";
url="";
$(document).ready(function(){

$('#loading').css('display','none');
    

});

    function divLogin(lote,tipo) {
      if ($(lote).attr('data-status')=='0') {
        point=$(lote);
         if (tipo==0) {
         punto=$(lote).attr('points').trim();
       }
       else{
        punto=$(lote).attr('d').trim();
       }
         $('#btnVender').attr('disabled',false);
         $('#btnPlanPago').attr('disabled',false);

         
         if (lotes=="") {
            lote.style.fill = "#0195bf"; 
         }
         else{
        if (lote != lotes && lotes != "") {
            lotes.style.fill = "#85f793";
            lote.style.fill = "#0195bf";
           }
        }
     
    
        lotes = lote;
    
      }
url=$('#url').val();
urlplan_pago=$('#urlplan_pago').val();


    }

function redireccionar(){
$('#loading').css('display','block');

    $.get('../buscarLote/'+punto,function(response){
        if (response.length!=0) {
$('#loading').css('display','none');

    window.parent.location.href=url+'/'+response[0].id;

        }
        else{
            toastr.error('INTENTE NUEVAMENTE');
        }
    });
}

function redireccionarPlanPago(){
$('#loading').css('display','block');

    $.get('../buscarLote/'+punto,function(response){
        if (response.length!=0) {
$('#loading').css('display','none');

    window.parent.location.href=urlplan_pago+'/'+response[0].id;

        }
        else{
            toastr.error('INTENTE NUEVAMENTE');
        }
    });
}