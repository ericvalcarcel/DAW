$(function()
{
  tinymce.init({
    selector: '#mytextarea',
    height : "580",
    setup: function (editor) {
      editor.on('init', function () {
        $(".tox-tinymce").prepend("<div class='form-group row' ><div class='col-sm-10'><input type='text' class='form-control' id='tema' placeholder='tema'></div></div>");
        $(".tox-tinymce").prepend("<div class='form-group row' id='marcador'><div class='col-sm-10'><input type='text' class='form-control' id='cco' placeholder='CCO'></div></div>");
        $(".tox-promotion").html("");
        $(".tox-promotion").html("<button class='btn btn-primary' id='guardar'>Guardar</button>");
       $(".tox-promotion").append("<button class='btn btn-success' id='enviar'>Enviar</button>");
       $(".tox-promotion").append("<button class='btn btn-success' id='recuperar'>Recuperar</button>");
        $(".tox-tinymce").prepend("<div class='form-group row' id='divCc'><div class='col-sm-10'><input type='text' class='form-control mb-2' placeholder='CC' id='cc'></div></div>");
        $(".tox-tinymce").prepend("<div class='form-group row'><div class='col-sm-10'><input type='text' class='form-control' id='destinatario' placeholder='Destinatario'></div></div>");
        $(".tox-tinymce").prepend("<h1>Redactar</h1>");
      
        $("#guardar").click(function() {
          // Obtener los valores de los campos de entrada   
          // Crear un objeto de datos con los valores
          var datos = {
            tema: $("#tema").val(),
            cco: $("#cco").val(),
            cc: $("#cc").val(),
            destinatario: $("#destinatario").val(),
            contenido: tinymce.activeEditor.getContent()
          };
        
          // Enviar los datos al servidor usando AJAX
          $.ajax({
            url: 'ajax/guardarDatos.php', // Ruta al archivo PHP en el servidor
            method: 'POST',
            data:datos,
            
            success: function(response) {
              // Manejar la respuesta del servidor si es necesario
              console.log(response);
            },
            error: function(xhr, status, error) {
              // Manejar los errores de la solicitud si es necesario
              console.log(error);
            }
          });
        });
        $("#recuperar").click(function() {
          // Obtener los valores de los campos de entrada
 
          // Enviar los datos al servidor usando AJAX
          $.ajax({
            async: true,
            type: "GET",
            // dataType:"json",
            contentType: "application/x-www-form-urlencoded",
            url: "ajax/recuperarDatos.php",
            success: function(response) {
              var responseData = JSON.parse(response);
              var content=responseData.contenido;
              
               $("#tema").val(responseData.tema);
               $("#cco").val(responseData.cco);
               $("#cc").val(responseData.cc);
               $("#destinatario").val(responseData.destinatario);
               
               $("#tinymce").html(tinymce.activeEditor.setContent(content))
            },
            error: function(xhr, status, error) {
              // Manejar los errores de la solicitud si es necesario
              console.log(error);
            }
          });
        });
      
      });
    }
  });
 
})