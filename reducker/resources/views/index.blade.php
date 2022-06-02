<!doctype html>
<html lang="ru">
<head>
    <!-- Кодировка веб-страницы -->
    <meta charset="utf-8">
    <!-- Настройка viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DUCK</title>
    <style>
        .btn-color{
            background-color: #265db2;
            color: #fff;
        }

        .profile-image-pic{
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color{
            background-color: #ebf2fa;
        }

        a{
            text-decoration: none;
        }

    </style>
    <!-- Bootstrap CSS (jsDelivr CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                <form class="card-body cardbody-color" id="short_form">

                    <h2 class="text-center"><font color="#408ca9">Re</font><font color="#eaae21">DUCK</font><font color="#408ca9">er</font></h2>

                    <h3 class="text-center"><font color="#408ca9">Сократи свою ссылку</font></h3>

                    <div class="text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/714/714024.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="DUCK">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="fLink" aria-describedby="emailHelp" placeholder="Your link">
                    </div>

                    <div class="text-center">
                        <button type="button" id="generate" class="btn-color px-5 mb-3 w-100">QUACK</button>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="shLink" aria-describedby="emailHelp" placeholder="Your short link">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(function() {
        $('#generate').on('click',function(){
            var link = $('#fLink').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/short',
                type: "POST",
                data: {link:link},
                success: function (data) {
                    $('#shLink').val('http://127.0.0.1:8000/'+data);
                },
                error: function (xhr, textStatus ) {
                    alert( [ xhr.status, textStatus ] );
                }
            });
        });
    });
</script>
</body>
</html>
