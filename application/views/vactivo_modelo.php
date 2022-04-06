


<h4 align="center" >Consultar Marcas y Modelos</h4> 
  <div class="container">
<div class="row">



<div class="col-xs-10">
<br>
    <table class="table table-bordered table-hover" id="manageMemberTable" class="display compact" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Numero de Producto</th>
         
        </tr>
      </thead>
    </table>
    </div>
  </div>
     </div>

      <div class="messages"></div>




<!-- Archivo modal -->


 <div class="modal fade" tabindex="-1" role="dialog" id="ArchivoModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Subir Archivo o Imagen</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cactivo_modelo/archivo" id="editForm">
      <div class="modal-body">        

        
  <label for="nombre">Archivo:</label>
    <input type="file" name="file" />


<?php foreach ($id as $value){ ?>
  <input name="id" type="text" value="<?php echo $value->co_modelo?>">
    <?php } ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Editar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






  <!-- edit member -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <form method="post" action="<?php echo base_url();?>index.php/Cactivo_modelo/edit" id="editForm">
      <div class="modal-body">        

    <label for="">Marca</label>
    <select name="edit_co_marca" id="edit_co_marca" class="form-control input-sm" >
    <?php foreach ($combo as $value){ ?>
    <option value="<?php echo $value->co_marca?>"> <?php echo $value->tx_marca?></option>
    <?php } ?>
    </select>

    <div class="form-group form-group-sm">
        <label for="" class="">Modelo</label>  
            <input name="edit_tx_modelo" id="edit_tx_modelo" class="form-control" type="text"> 
       </div> 

        
    <div class="form-group form-group-sm">
        <label for="" class="">Numero de Producto</label>  
      <input name="edit_tx_numero_producto" id="edit_tx_numero_producto" class="form-control" type="text"> 
            </div>
          

 <div class="form-group form-group-sm">
     <label for="" class="">Numero de Modelo</label>  
     <input name="edit_nu_modelo" id="edit_nu_modelo" class="form-control" type="text"> 
    </div>   




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Editar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!-- /edit mmebers -->

<!-- removeMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar</h4>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="removeMemberBtn" class="btn btn-danger">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <!-- removeMember -->
 

  <script type="text/javascript">
  var manageMemberTable;

$(document).ready(function() {
  manageMemberTable = $("#manageMemberTable").DataTable({
    'ajax': baseurl+'index.php/Cactivo_modelo/tabla',
   /* "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-info btn-xs'>Click!</button>"
        } ],*/
    'orders': [],

    "oLanguage":
		{    
    "sProcessing":     "Procesando...",
    "sLengthMenu": " Mostrar _MENU_ registros",   
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Filtrar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Por favor espere - cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }    
}
  }); 
});



function edit(co_modelo = null) 
{
  if(co_modelo) {

    $("#editForm")[0].reset();
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();

    $.ajax({
      url: baseurl+'index.php/Cactivo_modelo/obtener_tabla/'+co_modelo,
      type: 'post',
      dataType: 'json',
      success:function(response) {
          

        $("#edit_co_marca").val(response.co_marca); 

      $("#edit_tx_modelo").val(response.tx_modelo);

        $("#edit_tx_numero_producto").val(response.tx_numero_producto); 

        $("#edit_nu_modelo").val(response.nu_modelo);

  

        $("#editForm").unbind('submit').bind('submit', function() {
          
          var form = $(this);

          $.ajax({
            url: form.attr('action') + '/' + co_modelo,
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
              if(response.success === true) {
                $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');

                // hide the modal
                $("#editModal").modal('hide');

                // update the manageMemberTable
                manageMemberTable.ajax.reload(null, false); 

              } else {
                $('.text-danger').remove()
                if(response.messages instanceof Object) {
                  $.each(response.messages, function(index, value) {
                    var idi = $("#"+index);

                    idi
                    .closest('.form-group')
                    .removeClass('has-error')
                    .removeClass('has-success')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')                   
                    .after(value);                    

                  });
                } else {
                  $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                  '</div>');
                }
              }
            } // /succes
          }); // /ajax

          return false;
        });
        
      }
    });
  }
  else {
    alert('error');
  }
}

function eliminar(co_modelo = null) 
{
  if(co_modelo) {
    $("#removeMemberBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: baseurl+'index.php/Cactivo_modelo/eliminar' + '/' + co_modelo,
        type: 'post',       
        dataType: 'json',
        success:function(response) {
          if(response.success === true) {
            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

            // update the manageMemberTable
            manageMemberTable.ajax.reload(null, false); 

          } else {
            $('.text-danger').remove()
            if(response.messages instanceof Object) {
              $.each(response.messages, function(index, value) {
                var idi = $("#"+index);

                idi
                .closest('.form-group')
                .removeClass('has-error')
                .removeClass('has-success')
                .addClass(value.length > 0 ? 'has-error' : 'has-success')                   
                .after(value);                    

              });
            } else {
              $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
              '</div>');
            }
          }
        } // /succes
      }); // /ajax
    });
  }
}
  
  </script>
        </div>
