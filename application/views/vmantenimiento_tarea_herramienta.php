
<div class="container">

<div class="row">
<h4 align="center"><?php echo $nombre_tarea?></h4>
 

<form role = "form"  action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/lista_herramienta" method="POST">
<input type="hidden" name="co_mto_tarea" value="<?php echo  $co_mto_tarea?>"/>
    <div class="col-xs-3">
     <label for="">Herramienta:</label>
 <div class="input-group form-control form-group-sm" style="padding-bottom: 0px;padding-top: 0px;padding-left: 0px;padding-right: 0px;border-top-width: 0px;border-bottom-width: 0px;">
 <input type="hidden" name="co_herramienta" id="co_herramienta">
 <input type="text" class="form-control" disabled="disabled" id="tx_herramienta">
 <span class="input-group-btn">    
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#modal-default" style="margin-top:-4px;"><span class="fa fa-search"></span> Buscar</button>
</span>
      </div><!-- /input-group -->
  </div> 


<div class="col-xs-1">
<br>
<button type="button" class="btn btn-danger btn-sm" value="" id="btnAgregar" style="margin-top:4px;">Agregar</button>

</div>



<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Materiales y Herramientas</h4>
            </div>
            <div class="modal-body">
                <table  class="table table-bordered table-striped table-hover" id="mostrar_herramienta">
                    <thead>
                        <tr>
                            <th>Herramienta</th>
                            <th>Tipo</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($buscar_herramienta)):?>
                    <?php foreach ($buscar_herramienta as $value):?>
                    <?php $value->co_herramienta?>
                    <td> <?php echo $value->tx_herramienta?></td>
                    <td> <?php echo $value->tx_tipo?></td>
                
                    <?php $data=$value->co_herramienta."*".$value->tx_herramienta."*".$value->tx_tipo;?>
        <td><button type="button" class="btn btn-danger btn-check btn-xs" value="<?php echo $data;?>"><span class="glyphicon glyphicon-ok"></span> </button> </td>
                    </tr>
    <?php endforeach;?>
    <?php endif;?>
                   
                    </tbody>
                </table>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class ="container"> 

<div class ="col-xs-9">
  <table  class="table table-bordered table-striped table-hover" id="herramienta">
                    <thead>
                        <tr>
            <th>Herramienta o Material</th>
            <th>Tipo</th>
            <th>Cancelar</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                   
                    </tbody>
                </table>
 <button type="submit" class="btn btn-danger btn-sm btn-flat" style="margin-left: 830px;margin-bottom: px;margin-top: -90px;">Guardar</button>

</form>


<br> <br> <br>

  <table  class="table table-bordered table-striped table-hover" id="manageMemberTable">
                    <thead>
                        <tr>
            
            <th>Herramienta</th>
            <th>Tipo</th>
            <th>Eliminar</th>
            </tr>
            <tbody>
            </thead>
           
                            <?php if(!empty($tabla)):?>
                    <?php foreach ($tabla as $value):?>
                    <tr>
                   
            
                    <td> <?php echo $value->tx_herramienta?></td>
                    <td> <?php echo $value->tx_tipo?></td>
                  
    <td><a  href="" type="button" class="btn btn-danger btn-check btn-xs" data-toggle="modal" data-target="#removeModal" ><span class="glyphicon glyphicon-trash"></span> </a> 
    </td>
                     </tr>
    <?php endforeach;?>
    <?php endif;?>
                       
                   
                    <tbody>
                   <td>  </td>
                   <td>  </td>
                    </tbody>
                </table>
 
            


</div>  <!-- xs-10  --> 

 
</div>  <!-- row --> 

 
</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar</h4>
        <form method="post" action="<?php echo base_url();?>index.php/Cmantenimiento_tarea/eliminar_herramienta/<?php echo $value->co_tarea_mtto_herramienta?>" id="editForm">
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar el registro?</p>
        <input name="co_tarea" id="co_tarea" type="hidden" value="<?php echo $value->co_tarea_mtto?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#mostrar_herramienta").DataTable({
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

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
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

$(document).on("click",".btn-check",function(){ //
herramienta=$(this).val(); //recupera la informacion
info_herramienta =herramienta.split("*");
$("#co_herramienta").val(info_herramienta[0]);
$("#tx_herramienta").val(info_herramienta[1]);
$("#tx_tipo").val(info_herramienta[2]);
$("#modal-default").modal("hide");
});


$('#btnAgregar').click(function()
{
   
if(herramienta != ''){
  //  depositoE=$("#tx_deposito_entrada").val();
 
info=herramienta.split("*");
html= "<tr>";
html += "<td><input type='hidden' name='co_herramienta[]' value='"+info_herramienta[0]+"'>"+info_herramienta[1]+"</td>";
html += "<td>"+info_herramienta[2]+"</td>"
//html+="<td input type='hidden' style='display:none' name='co_herramienta[]'>"value'"+info_herramienta[0]+"</td>";
//html+="<td>"+info_herramienta[1]+"</td>";
html+="<td><button class= 'btn btn-danger btn-remove btn-xs'><span class='glyphicon glyphicon-remove'></span></button></td>";
html+="</tr>";
$("#herramienta tbody").append(html);
$("#tx_herramienta").val(null);

}if(herramienta.length == 0 ) {
    alert("Debe seleccionar la herramienta");
}
});
$(document).on("click",".btn-remove", function(){
$(this).closest("tr").remove(); //permite ubicarse en un elemento (closest)y luego se aplica el metodo remove
});


 </script>
