<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Prediksi Hasil Panen</title>

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/728d1d3dec.js" crossorigin="anonymous"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<body>
    <div class="svgs">
        <img src="imgs/bg_svg.svg">
    </div>
    <div class="page" id="part1">
        <div class="info">
            <div class="heading">
                <div class="title text-primary">Prediksi Hasil Panen</div>
            </div>
            <div class="dev">
                <div class="text-primary">
                    <i class="far fa-file-code"></i>&nbsp;Developed by:
                </div>
                <ul>
                    <li>Universitas Dian Nuswantoro</li>    
                </ul>
            </div>
            <div class="btn-grp">
                <a href="#part3" class="try">
                    Coba Sekarang!
                </a>
            </div>
            
        </div>
        <div class="imgContainer">
            <!-- <img src="imgs/farm1.jpg" alt=""> -->
            <img src="imgs/flowers.svg" alt="">
        </div>
        <div class="scrollIndicator"></div>
    </div>
    <div class="page" id="part2">
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/input.svg" alt="">
            </div>
            <div class="myCard-title text-blue">Masukkan detail</div>
            <div class="myCard-body ">Berikan informasi tentang luas lahan, jumlah bibit dan jumlah pakan </div>
        </div>
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/weather.svg" alt="">
            </div>
            <div class="myCard-title text-green">Analitika Waktu Nyata</div>
            <div class="myCard-body ">Anda dapat memeriksa data secara real time </div>
        </div>
        <div class="card myCard">
            <div class="myCard-img">
                <img src="imgs/model.svg" alt="">
            </div>
            <div class="myCard-title text-orange">Prediksi</div>
            <div class="myCard-body ">Model Decision Tree Regressor Machine Learning untuk memprediksi hasil panen</div>
        </div>
        <div class="scrollIndicator"></div>
    </div>
    <div class="container p-5 page" id="part3">
        <div class="imgContainer">
            <img src="imgs/plant.svg" alt="">
        </div>
        <div class="card shadow-lg col-6 p-0 mx-auto">
            <div class="card-header text-primary text-center">
                <h3><u>Prediksi Hasil Panen</u></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="LuasLahan">Luas Lahan:</label>
                    <input type="number" class="form-control" id="LuasLahan" placeholder="Masukkan angka">
                </div>
                <div class="form-group">
                    <label for="JumlahBibit">Jumlah Bibit:</label>
                    <input type="number" class="form-control" id="JumlahBibit" placeholder="Masukkan angka">
                </div>
                <div class="form-group">
                    <label for="JumlahPakan">Jumlah Pakan:</label>
                    <input type="number" class="form-control" id="JumlahPakan" placeholder="Masukkan angka">
                </div>
                <div class="row">
                    <button class="btn btn-primary mx-auto" id="submit">Prediksi</button>
                </div>
            </div>
            <div class="card-footer" id="prediction">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(()=>{
            $('#submit').prop('disabled', true);
            $('#prediction').hide();
            var model_dtr;
            $.get('model_dtr.pkl', (data, status)=>{
                model_dtr = JSON.parse(data);
            }).done(()=>{
                let opts = '<option value="" selected hidden disabled>Select district</option>';
                let luas = model_dtr['LuasLahan'];
                for(let i=0; i<luas.length; i++)
                    opts += '<option value="'+dists[i]+'">'+dists[i]+'</option>';
                $('#LuasLahan').html(opts);

                opts = '<option value="" selected hidden disabled>Select crop</option>';
                let crops = model_dtr['JumlahBibit'];
                for(let i=0; i<crops.length; i++)
                    opts += '<option value="'+crops[i]+'">'+crops[i]+'</option>';
                $('#crop').html(opts);

                opts = '<option value="" selected hidden disabled>Select soil type</option>';
                let soils = model_dtr['JumlahPakan'];
                for(let i=0; i<soils.length; i++)
                    opts += '<option value="'+soils[i]+'">'+soils[i]+'</option>';
                $('#soil').html(opts);
                
            });
        });
        $('select').change(()=>{
            var flag = 0;
            if(!$('#LuasLahan').val()){ flag = 1; }
            if(!$('#JumlahBibit').val()){ flag = 1; }
            if($('#JumlahPakan').val() == ""){ flag = 1; }
            $('#submit').prop('disabled', flag);
        })
        $('input').keyup(()=>{
            var flag = 0;
            if(!$('#LuasLahan').val()){ flag = 1; }
            if(!$('#JumlahBibit').val()){ flag = 1; }
            if($('#JumlahPakan').val() == ""){ flag = 1; }
            $('#submit').prop('disabled', flag);
        })
        
        $('#submit').click(()=>{
            var paras = 'LuasLahan='+$('#LuasLahan').val()+ '&JumlahBibit='+$('#JumlahBibit').val() + '&JumlahPakan='+$('#JumlahPakan').val();
            var res;
            $.get('predict.php?'+paras, (data, status)=>{
                // alert(data);
                res = data;
            }).done(()=>{
                $('#prediction').html(res);
                $('#prediction').show();
            });
        })
    </script>
</body>

</html>