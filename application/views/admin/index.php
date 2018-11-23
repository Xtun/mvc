<!doctype html>
<html lang="en">

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="/../www/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="/../www/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="/../www/css/style.css" rel="stylesheet">
  <link href="/../www/css/addons/datatables.min.css" rel="stylesheet">

    <title><?=$title;?></title>

  </head>
  <body>
  
    <div class="container">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th>Id
                <i class="float-right" ></i>
            </th>
            <th class="th-sm">Name
                <i class="fa fa-sort float-right" aria-hidden="true"></i>
            </th>
            <th class="th-sm">E-mail
                <i class="fa fa-sort float-right" aria-hidden="true"></i>
            </th>
            <th class="th-sm">Status
                <i class="fa fa-sort float-right" aria-hidden="true"></i>
            </th>
            <th class="th-sm">Description
                <i class="fa fa-sort float-right" aria-hidden="true"></i>
            </th>
            <th class="th-sm">Image
                <i class="fa float-right" aria-hidden="true"></i>
            </th>
            <th class="th-sm">Edit
                <i class="fa float-right" aria-hidden="true"></i>
            </th>
            </tr>
        </thead>
        <tbody>
            <?=$table;?>
        </tbody>
        <tfoot>
            <tr>
            <th>Id
            </th>
            <th>Name
            </th>
            <th>E-Mail
            </th>
            <th>Status
            </th>
            <th>Description
            </th>
            <th>Image
            </th>
            <th>Edit
            </th>
            </tr>
        </tfoot>
        </table>

        <div><a class="btn btn-primary" href="../auth/logout" role="button">Logout</a><div>

        <!-- Modal adding-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../admin/main" method="POST" enctype="multipart/form-data" id="saveTask">
                <div class="form-group">
                    <label for="name" class="col-form-label">Name:</label>
                    <input type="text" name='name' class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="Email" class="col-form-label">E-mail:</label>
                    <input type="email" name='email' class="form-control" id="Email">
                </div>
                <div class="custom-file form-check">
                    <input class="form-check-input" name="status" type="checkbox"  id="blankCheckbox" >
                    <label class="form-check-label" for="blankCheckbox">
                        Status
                    </label> 
                </div>
                <div class="form-group">
                    <label for="text" class="col-form-label">Task:</label>
                    <textarea class="form-control" name="text" id="text"></textarea>
                </div>
                <div class="custom-file">
                    <label for="image" class="custom-file-label">image:</label>
                    <input type="file" name="image" class="custom-file-input" id="image" accept="image/gif, image/jpeg, image/png" />
                </div>

                <input type="text" name="action" value="edit" style="display:none;" class="form-control">
                <input type="text" name="id" value="" style="display:none;" class="id form-control">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="preview" data-toggle="modal" data-target="#exampleModalCenter">
                Preview
                </button>
                <button type="submit" class="btn btn-primary" form="saveTask">Save task</button>
            </div>
            </div>
        </div>
        </div>

        <!--Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="overflow-x:auto;" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table  class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th class="th-sm">Name
                            <i class="fa float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">E-mail
                            <i class="fa float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">Status
                            <i class="fa float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">Description
                            <i class="fa  float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">Image
                            <i class="fa float-right" aria-hidden="true"></i>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="sad">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><img class="mr-3" id="blah" width="320" height="240" src="#"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Name
                        </th>
                        <th>E-Mail
                        </th>
                        <th>Status
                        </th>
                        <th>Description
                        </th>
                        <th>Image
                        </th>
                        </tr>
                    </tfoot>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
            </div>
        </div>
        </div>
    </div>

        
    <footer>

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="/../www/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="/../www/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="/../www/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="/../www/js/mdb.min.js"></script>
  <script type="text/javascript" src="/../www/js/addons/datatables.min.js"></script>
  <script>
  // Basic example
    $(document).ready(function () {
            
            $('#dtBasicExample').DataTable({
                "paging": true, // false to disable pagination (or any other option)
                "lengthMenu": [[3, -1], [3,"All"]]
            });

            $('.dataTables_length').addClass('bs-select');
            
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function() {
            readURL(this);
            });
            $('#Email').on('blur', function () {
            let email = $(this).val();
            
            if (email.length > 0
            && (email.match(/.+?\@.+/g) || []).length !== 1) {
                console.log('invalid');
                alert('Вы ввели некорректный e-mail!');
            } else {
            }
            });
            $("#preview").click(function(){

                var check=$("#blankCheckbox").prop( "checked" );
   
                var src = $("#blah").attr("src");
                var src2 = $('.tr_image_'+$(".id").val()+'> img').attr("src");
                if(src === ''){src=src2;}    
    
                $('#sad').html('<td>'+
                $("#name").val()+'</td><td>'+
                $("#Email").val()+'</td><td>'+check+'</td><td>'+
                $("#text").val()+'</td><td><img class="mr-3" id="blah" width="320" height="240" src="'
                +src+
                '"></td>');

              

              
            });
            $(".edit").click(function(){
              

              var id=$(this).val();
              $('#name').val($('.tr_name_'+id).text());  
              $('#Email').val($('.tr_email_'+id).text());  
              $('#text').val($('.tr_text_'+id).text());
              $('#blah').attr('src',($('.tr_image_'+id +'> img').attr('src')));
              $('.id').val(id);                     
            });
              
    });

  </script>
    </footer>
    
  </body>
</html>

