<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="asset/bootstrap-5.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/select2-4.0.6-rc.1/dist/css/select2.min.css">
    <script src="asset/jquery/jquery-3.3.1.min.js"></script>
    <script src="asset/bootstrap-5.2.1/js/bootstrap.min.js"></script>
    <script src="asset/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>   
    <script src="asset/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>   
</head>
<body>

    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card text-bg-light mb-5">
                    <div class="card-header"><b>Data Alumni Wilayah Indonesia</b></div>
                    <div class="card-body">
                        <form action="#" onsubmit="event.preventDefault();submitForm()">
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Provinsi:</label>
                                <select class="form-control w-100 " name="provinsi" id="provinsi">
                                    <?php 
                                        include("./backend/index.php");
                                    ?>

                                    <?php while($rs_provinsi = mysqli_fetch_assoc($getAllProvinsi)): ?>
                                        <option value="<?php echo $rs_provinsi['prov_id']; ?>"><?php echo $rs_provinsi['prov_name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <img src="asset/img/loading.gif" width="35" id="load1" style="display:none;" />
                            </div>
                            <div class="form-group my-2">
                                <label class="control-label col-sm-3">Kota/Kabupaten:</label>
                                <select class="form-select"name="kota" id="kota" aria-label="Floating label select example"></select>
                                <img src="asset/img/loading.gif" width="35" id="load2" style="display:none;" />
                            </div>
                            <div class="form-group mt-3">        
                                <div class="col-sm-12">
                                <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-block">Cari</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>   
                
                <div id="container"></div>
            </div>
        </div>  
    </div>

    <script refer>
        $('#provinsi').select2({
            placeholder: 'Pilih Provinsi',
            language: "id"
        });
        $('#kota').select2({
            placeholder: 'Pilih Kota/Kabupaten',
            language: "id"
        });

        $("#provinsi").change(function(){
            $("img#load1").show();
            var id_provinces = $(this).val(); 
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "backend/api.php?jenis=kota",
                data: "id_provinces="+id_provinces,
                success: function(msg){
                    $("select#kota").html(msg);                                                       
                    $("img#load1").hide();
                    getAjaxKota();                                                        
                }
            });                    
        });

        function submitForm() {
            try {
                $("img#load2").show();
                var id_regencies = $("#kota").val();
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "backend/api.php?jenis=kecamatan",
                    data: "id_regencies="+id_regencies,
                    success: function(msg){
                        $("img#load2").hide();
                        $("#container").html(msg);
                    }
                });
            } catch (error) {
                console.log(error);
            }
        }
    </script>

</body>
</html>