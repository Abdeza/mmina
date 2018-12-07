$(document).ready(function(){
  var mptable =  $("#mptable").DataTable();
  $("#action").on('click',function(){

        $("#creatempform")[0].reset();
        $("#creatempform").unbind('submit').bind('submit',function(){
            var form = $(this);

            return false;
        });
  });
})