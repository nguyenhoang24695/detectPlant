<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .container {
            padding: 2rem 0;
        }

        h4 {
            margin: 2rem 0 1rem;
        }

        .table-image {

        td, th {
            vertical-align: middle;
        }

        }
    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-image">
                <thead>
                <tr>
                    <th scope="col">Thứ tự</th>
                    <th scope="col">Image</th>
                    <th scope="col">Tên cây trồng</th>
                    <th scope="col">Tên bệnh (nếu có)</th>
                    <th scope="col">Mức độ tin cậy</th>
                    <th scope="col">Nguồn</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($plantix_data["response"] as $data)
                    <tr>
                        <th scope="row">_</th>
                        <td class="w-25">
                            <img
                                src=""
                                class="img-fluid img-thumbnail" alt="Plant">
                        </td>
                        <td>{{$plantix_data["plant_net"][0]["name"]}}</td>
                        <td>{{$data["name"]}}</td>
                        <td>{{$data["probability"] ?? ''}}</td>
                        <td>Plantix</td>
                    </tr>
                @endforeach
                @foreach ($plantId_data as $data1)
                    <tr>
                        <th scope="row">_</th>
                        <td class="w-25">
                            <img
                                src=""
                                class="img-fluid img-thumbnail" alt="Plant">
                        </td>
                        <td>{{$data1["plant_name"]}}</td>
                        <td>unknow</td>
                        <td>{{100*(float)$data1["probability"] ?? ''}}</td>
                        <td>PlantId</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
</html>
