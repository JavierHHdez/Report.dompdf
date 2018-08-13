<?php 
    
    session_start();

    if(!isset( $_SESSION['usuario'])){
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>MySQL Table Manager With Bootstrap/JQuery/AJAX/PHP/MySQL</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
</head>
<body>

    <div class="container" style="margin-top: 30px;">

        <div id="tableManager" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">New Country</h2>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="countryId">
                        <input type="text" class="form-control" placeholder="Country Name..." id="countryName"><br>
                        <textarea class="form-control" id="shortDesc" placeholder="Sort Country Description"></textarea><br>
                        <textarea class="form-control" id="longDesc" placeholder="Long Country Description"></textarea>
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="btnSubmit" onclick="namagerData('AddNew');" class="btn btn-primary" value="Save">
                    </div>
                </div>
            </div>
        </div>

        <?php 

            require_once("../dbconfig/connection.php");

            $database = Connection::getInstance();
            
            $reponse = $database->findAll("SELECT * FROM country");

        ?>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                
                <a style="float: right;font-size: 20px;" href="/model/logout.php" class="logout">Logout</a>

                <h2>MySQL Table Manager</h2>
                <h3>Bienvendio <?php echo $_SESSION['usuario']['name']; ?></h3>
                
                
                <input type="button" id="AddNew" class="btn btn-primary pull-right" value="Add New" style="margin-bottom: 10px;">
                <a style="margin-right: 5px;" href="/pdf/output.php" target="_blank" class="btn btn-primary pull-right">Export PDF</a>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Country Name</td>
                            <td>Short Description</td>
                            <td>Long Description</td>
                            <td>Options</td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($reponse as $key => $value) {
                                echo '<tr>
                                        <td>'.$value['id'].'</td>
                                        <td>'.$value['countryName'].'</td>
                                        <td>'.$value['shortDesc'].'</td>
                                        <td>'.$value['longDesc'].'</td>
                                        <td>
                                            <input type="button" onclick="managerDelete('.$value['id'].');"  class="btn btn-danger btn-small" value="Delete">
                                            <input type="button" onclick = "managerGetBydId('.$value['id'].');" class="btn btn-primary btn-small" value="Edit">
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){

            $('#AddNew').on('click', function(){ 
                
                $('.modal-title').html('New Country');

                $("#tableManager").modal('show');

                var id          = $("#countryId");
                var name        = $("#countryName");
                var shortDesc   = $("#shortDesc");
                var longDesc    = $("#longDesc");

                if(_empty(id) == true && _empty(name) == true && _empty(shortDesc) == true && _empty(longDesc) == true){
                    id.val(''); name.val(''); shortDesc.val(''); longDesc.val('');

                    $("#btnSubmit").attr("onclick", "namagerData('AddNew')");
                }
                
            });

        });

        function _empty(input){

            return input.val().length > 0 ? true : false;
        }

        function managerDelete(id){

            var response = confirm("¿Esta seguro de eliminar el registro seleccionado?");

            if(response){

                $.ajax({
                    url : '../model/operations.php',
                    method : 'POST',
                    dataType : 'text',
                    data : {
                        key : 'Delete',
                        id  : id
                    },
                    success : function(response){
                        location.reload();
                    },
                    error : function(error){
                        alert(error);
                    }
                });
            }

            return false;
        }

        function managerGetBydId(id){
            $.ajax({
                url : '../model/operations.php',
                method : 'POST',
                dataType : 'json',
                data : {
                    key : 'getById',
                    id  : id
                },
                success : function(response){
                    $('.modal-title').html('Edit Country');
                    $("#countryId").val(response.id);
                    $("#countryName").val(response.countryName);
                    $("#shortDesc").val(response.shortDesc);
                    $("#longDesc").val(response.longDesc);
                    $("#btnSubmit").attr("onclick", "managerEditar('Update');");
                    $("#tableManager").modal('show');
                },
                error : function(error){
                    console.log(error);
                }
            });
        }

        function managerEditar(key){

            var id          = $("#countryId");
            var name        = $("#countryName");
            var shortDesc   = $("#shortDesc");
            var longDesc    = $("#longDesc");

            if( isNotEmpty(name) && isNotEmpty(shortDesc) && isNotEmpty(longDesc)){
                
                $.ajax({
                    url         : '../model/operations.php',
                    method      : 'POST',
                    dataType    : 'text',
                    data : {
                        id          : id.val(),
                        key         : key,
                        name        : name.val(),
                        shortDesc   : shortDesc.val(),
                        longDesc    : longDesc.val()
                    },
                    success : function(response){
                       location.reload();
                    },
                    error : function(error){
                        alert(error);
                    }
                });
            }
        }

        function namagerData(key){

            var name        = $("#countryName");
            var shortDesc   = $("#shortDesc");
            var longDesc    = $("#longDesc");

            if( isNotEmpty(name) && isNotEmpty(shortDesc) && isNotEmpty(longDesc)){
                
                $.ajax({
                    url         : '../model/operations.php',
                    method      : 'POST',
                    dataType    : 'text',
                    data : {
                        key         : key,
                        name        : name.val(),
                        shortDesc   : shortDesc.val(),
                        longDesc    : longDesc.val()
                    },
                    success : function(response){
                       location.reload();
                    },
                    error : function(error){
                        alert(error);
                    }
                });
            }
        }

        function isNotEmpty(caller){

            if(caller.val() == ''){
                caller.css('border', '1px solid red');
                return false;
            }
            else
                caller.css('border', '');

            return true;
        }
    </script>
</body>
</html>

