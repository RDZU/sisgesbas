<h4>Listado de Activos</h4>
<div class = "row">

   
    
<div class="col-xs-10">
      <table id="table" class="table table-striped table-bordered" cellspacing="0">
        <thead>
          <tr>
            <th style= "border-bottom-width: 0px;">Serial</th>
            <th  style="width:389px; border-bottom-width: 0px;">Nota</th>
            <th style= "border-bottom-width: 0px;">Marca</th>
            <th style= " width:189px; border-bottom-width: 0px;">Numero de Parte</th>
            <th style="width:389px; border-bottom-width: 0px;">Etiqueta</th>
            <th style="width:149px;border-bottom-width: 0px;">Fecha de Asignación</th>
            <th style="width:389px;border-bottom-width: 0px;">Dirección</th>
            <th style="width:149px; border-bottom-width: 0px;">Clase de Activo</th>
            <th style="width:149px; border-bottom-width: 0px;">Tipo de Activo</th>
            <th style= "width:85px; border-bottom-width: 0px;">Prioridad</th>
          
            <th style= " border-bottom-width: 0px;">Editar</th>
          </tr>
        </thead>
        <tbody>
        </tbody>

        
      </table>
      </div>
    </div>


  </div>


  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "scrollX": true,
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('Cactivo_listado/ajax_list')?>",
          "type": "POST"
        },
        "oLanguage":
		{    
    "sProcessing":     "Procesando...",
    "sLengthMenu": " \n Mostrar  _MENU_ registros",   
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar Serial o Etiqueta:",
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
},
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });
/*
    function add_person()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add New Teacher'); // Set Title to Bootstrap modal title
    }*/

    function edit_person(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url :  baseurl+'index.php/Cactivo_listado/ajax_edit/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('[name="id"]').val(data.co_activo);
          $('[name="co_clase_activo"]').val(data.co_clase_activo);
          console.log(data)
          $('[name="co_clase_activo_detalle"]').val(data.co_clase_activo_detalle);
          console.log(data.co_clase_activo_detalle)
          $('[name="nu_prioridad"]').val(data.nu_prioridad);
          $('[name="tx_criticidad"]').val(data.tx_criticidad);
         // $('[name="address"]').val(data.address);
         // $('[name="dob"]').val(data.dob);
          //      $("#co_clase_activo_detalle").val(data.co_clase_activo_detalle);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Activo'); // Set title to Bootstrap modal title
         
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
      alert("El activo se ha editado exitosamente");
    }

    function save()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('Cactivo_listado/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('Cactivo_listado/ajax_update')?>";
      }

       // ajax adding data to database
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
               swal(
                'Good job!',
                'Data has been save!',
                'success'
                )
             },
           //  alert("El registro se modifico exitosamente");
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error adding / update data');
            }
          });
     }


    function view_person(id)
{
          $.ajax({
            url : "<?php echo site_url('Cactivo_listado/list_by_id')?>/" + id,
            type: "GET",
            success: function(result)
            {
                $('#haha').empty().html(result).fadeIn('slow');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
      }


     //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    $(document).ready(function() {                       
                $("#co_clase_activo").change(function() {
                    $("#co_clase_activo option:selected").each(function() {
                        co_clase_activo = $('#co_clase_activo').val();
                        $.post("<?php echo base_url(); ?>index.php/Cmantenimiento_tarea/get_tipo_activo", {
                            co_clase_activo : co_clase_activo
                        }, function(data) {
                            $("#co_clase_activo_detalle").html(data);
                        });
                   });
                });
            });
  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Clase de Activo</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id"/> 
            <div class="form-body">


                <label >Prioridad</label>
              <select class="form-control input-sm" id="tx_criticidad" name="tx_criticidad">
			     <option value="BAJA">BAJA</option>
           <option value="MEDIA">MEDIA</option>
           <option value="ALTA">ALTA</option>
			    </select>	
          <br>

    <label for="">Clase Activo</label>
    <select name="co_clase_activo" id='co_clase_activo' class="form-control input-sm" >
    
 
    <?php foreach ($combo as $value){ ?>
   
    echo '<option value="<?php echo $value->co_clase_activo?>"> <?php echo $value->tx_clase_activo?> </option>';
    <?php } ?>
    </select>
  
<br>

    <label for="">Tipo de Activo</label>
 <select id="co_clase_activo_detalle" name="co_clase_activo_detalle" class="form-control input-sm" >
 <?php foreach ($combo2 as $value){ ?>
   
    echo '<option value="<?php echo $value->co_clase_activo_detalle?>"> <?php echo $value->tx_clase_activo_detalle?> </option>';
    <?php } ?>
    </select>
    <br>
    <br>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->