<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{$response["crop_data"][0]["image"]}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$response["crop_data"][0]["crop_name"] }}</h5>
        <p class="card-text">{{$response["crop_data"][0]["introduce"] ?? "No info"}}</p>
        {{--        <a href="#" class="btn btn-primary">Go somewhere</a>--}}
    </div>
</div>
<h2>Bệnh đã phát hiện</h2>
@foreach($response["pathogen_data"] as $key => $value)
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{$value['name']}}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Tên khoa học: {{$value['scientific_name']}}</h5>
            <p class="card-text">Dấu hiệu nhận biết: {{$value['recognition'] ?? "Chưa rõ"}}</p>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-{{$key}}"
                                    aria-expanded="true" aria-controls="collapseOne-{{$key}}">
                                Hướng dẫn sử dụng thuốc
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne-{{$key}}" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        @foreach($value['drug_instruction'] as $key1 => $value1)
                            <div class="card-body">
                                {{$value1["name"]}}
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <br/>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#crop_disease"
                                    aria-expanded="true" aria-controls="crop_disease">
                                Phổ ký chủ
                            </button>
                        </h5>
                    </div>

                    <div id="crop_disease" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        @foreach($value['crop_disease'] as $key2 => $value2)

                            <div class="card-body">
                                <h3>
                                    {{$value2["crop_name"]}}
                                </h3>
                            </div>
                            <div class="card-body">
                                <b>Triệu chứng:</b> {{$value2["symptom"]}}
                            </div>
                            <div class="card-body">
                                <b>Các giai đoạn gây bệnh trên cây trồng:</b>
                                @foreach( $value2["stage"] as$stage_key => $stage)
                                    @if($stage_key > 0)
                                        -
                                    @endif
                                    {{$stage["category_name"]}}
                                @endforeach
                            </div>
                            <div class="card-body">
                                <b>Nguyên Nhân gây hại:</b> {{$value2["cause"]}}
                            </div>
                            <div class="card-body">
                                <b>Các biện pháp điều trị:</b>
                                @foreach( $value2["general_method"] as$method_key => $method)
                                    <p>
                                        {{$method["content"]}}
                                    </p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br/>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_bio_drug"
                                    aria-expanded="true" aria-controls="collapse_bio_drug">
                                Thuốc sinh học
                            </button>
                        </h5>
                    </div>

                    <div id="collapse_bio_drug" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        @foreach( $value["biology_drug"] as $biology_key => $biology)
                            <div class="card-body">
                                <p><b>{{$biology_key}}</b></p>
                                <ul>
                                    @foreach($biology as $biology_item)
                                        <li>{{$biology_item["trade_name"]}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br/>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_chemical_drug"
                                    aria-expanded="true" aria-controls="collapse_chemical_drug">
                                Thuốc hóa học
                            </button>
                        </h5>
                    </div>

                    <div id="collapse_chemical_drug" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        @foreach( $value["chemical_drug"] as $chemical_key => $chemical)
                            <div class="card-body">
                                <p><b>{{$chemical_key}}</b></p>
                                <ul>
                                    @foreach($chemical as $chemical_item)
                                        <li>{{$chemical_item["trade_name"]}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br/>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_drug_instruction"
                                    aria-expanded="true" aria-controls="collapse_drug_instruction">
                                Hướng dẫn dùng thuốc
                            </button>
                        </h5>
                    </div>

                    <div id="collapse_drug_instruction" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                            <div class="card-body">
                                {{$value["instruction"] ?? ''}}
                            </div>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
@endforeach

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
