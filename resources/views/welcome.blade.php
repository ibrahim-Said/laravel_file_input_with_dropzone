<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/basic.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>
            .dropzone {
                background: white;
                border-radius: 5px;
                border: 2px dashed rgb(0, 135, 247);
                border-image: none;

                margin-left: auto;
                margin-right: auto;
                margin-buttom:10px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-6 offset-md-3">
            <form action="/" enctype="multipart/form-data" method="POST">
                @csrf()
                <div class="form-group">
                  <label for="">Nom</label>
                  <input type="text" class="form-control" name="nom" id="Username" placeholder="">
                </div>
                <div class="dropzone" id="my-dropzone" name="mainFileUploader">

                    <DIV class="dz-message needsclick">
                        Choisir une photo à importer .<BR>
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                      </DIV>
                </div>
            </form>
            <div>
                <button class="btn btn-primary" type="submit" id="submit-all"> ajouter </button>
            </div>

        </div>
        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
            //<img src="{{asset('storage/uploads/4Y7lxss02G7JZU583IAwqk4Q1icwbM5kTB8oj2bU.png')}}" alt="">
            Dropzone.options.myDropzone = {

                url: "/add",
                headers: {
                    'x-csrf-token': CSRF_TOKEN,
                },

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                init: function () {

                    var submitButton = document.querySelector("#submit-all");
                    var wrapperThis = this;

                    submitButton.addEventListener("click", function () {
                        wrapperThis.processQueue();
                    });

                    this.on('sendingmultiple', function (data, xhr, formData) {
                        console.log(formData)
                        formData.append("nom", $("#Username").val());
                    });
                }
            };
        </script>
    </body>
</html>
