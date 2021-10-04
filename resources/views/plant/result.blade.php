<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Designer"/>

    <link href="{{asset("/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("/css/style.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("/img/favicon.png")}}" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">

    <script src="{{asset("/js/modernizr.js")}}"></script>

    <title>Designer</title>

</head>
<body>

<!--- PAGE LOADING --->
<div class="preloading fadeIn">

    <div class="container">

        <!--- HERO HEADER --->
        <div class="row">
            <div class="col-md-12">
                <div class="hero-bg">
                    <h1 class="fade-anime-top"> Nhận diện cây trồng </h1>
                    <h1 class="fade-anime-top"> Tên cây trồng </h1>
                    @if($plantId_data[0]["plant_details"]["common_names"] != null && count($plantId_data[0]["plant_details"]["common_names"]) > 0)
                        @foreach($plantId_data[0]["plant_details"]["common_names"] as $key => $name_vi)
                            <h2 class="fade-anime-bottom"> {{$name_vi}} </h2>
                            @if($key >= 0)
                                @break
                            @endif
                        @endforeach
                    @else
                        <h2 class="fade-anime-bottom"> {{$plantId_data[0]["plant_name"]}} </h2>
                    @endif
                    <h1 class="fade-anime-top"> Tên cây trồng chuẩn hóa quốc tế</h1>
                    @if(isset($plantId_data[0]["plant_details"]["global_name"]) && $plantId_data[0]["plant_details"]["global_name"] != null)

                        <h2 class="fade-anime-bottom"> {{$plantId_data[0]["plant_details"]["global_name"]}} </h2>

                    @else
                        <h2 class="fade-anime-bottom"> Không có trong cơ sở dữ liệu </h2>
                    @endif
                </div>
            </div>
        </div>
        <!--- THE END HERO HEADER --->

        <!--- ABOUT --->
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="lg-col-bg">
                    <div class="lg-col-ttl2">Bệnh cây trồng</div>

                    @if($plantix_data["response"][0]["name"] == "UNKNOWN_DISEASE")
                        <div class="lg-col-wrt"> Không chuẩn đoán được bệnh <br><br>
                            {{--                            <b>Độ chính xác</b><br>--}}
                            {{--                            98<br>--}}
                            {{--                        Illustration<br>--}}
                            {{--                        Web Design<br>--}}
                            {{--                        Web Development--}}
                        </div>
                    @elseif($plantix_data["response"][0]["name"] == "Healthy")
                        <div class="lg-col-wrt"> Cây trồng khỏe mạnh <br><br>
                            <b>Độ chính xác</b><br>
                            {{$plantix_data["response"][0]["probability"] ?? "Không xác định"}}<br>
                            {{--                        Illustration<br>--}}
                            {{--                        Web Design<br>--}}
                            {{--                        Web Development--}}
                        </div>
                    @else
                        <div
                            class="lg-col-wrt"> {{$plantix_data["response"][0]["name_vi"] ?? $plantix_data["response"][0]["name"]}}
                            <br><br>
                            <b>Tên Virus/ Vi Khuẩn gây bệnh:</b><br>
                            {{$plantix_data["response"][0]["scientific_name"]}}
                            <br><br>
                            <b>Độ chính xác</b><br>
                            {{$plantix_data["response"][0]["probability"] ?? "Không xác định"}}<br>
                            {{--                        Illustration<br>--}}
                            {{--                        Web Design<br>--}}
                            {{--                        Web Development--}}
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <div class="lg-col-bg2">
                    <img src="{{asset($plantix_data["image_url"])}}" alt="" class="img-lg-col2">
                </div>
            </div>

        </div>
        <!--- THE END ABOUT CLIENT --->

        <!--- HERO HEADER WORK SLIDER --->
        <div class="row">
            <div class="col-md-12 xs-col-12">
                <div class="lg-col-bg">
                    <div class="lg-col-wrt2">
                        {{$plantId_data[0]["plant_details"]["wiki_description"]["value"]}}
                        {{--                        <a target="_blank" class="soc-lnk" href="#">Dribbble</a>,--}}
                        {{--                        <a target="_blank" class="soc-lnk" href="#">Instagram</a> or--}}
                        {{--                        <a target="_blank" class="soc-lnk" href="#">Behance</a>.--}}
                    </div>
                </div>
            </div>
        </div>

    {{--        <div class="row">--}}
    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/1.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-left-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Branding, Identity</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/2.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-right-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Typography</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="row">--}}
    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/3.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-left-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Illustration, Art Direction</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/4.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-right-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Street Art</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="row">--}}
    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/5.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-left-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Art Direction</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-md-6 col-xs-12">--}}
    {{--                <div class="prjct-bg">--}}
    {{--                    <a target="blank" href="#"> <img--}}
    {{--                            src="{{asset("/img/covers/6.jpg" alt="" class="img-prjct-wrk"> </a>--}}
    {{--                    <div class="prjct-wrt-right-wrk"></div>--}}
    {{--                    <div class="shw-cs2"> Project Title</div>--}}
    {{--                    <div class="shw-cs4"> Branding, Web Design, App. Design</div>--}}
    {{--                    <div class="shw-cs"> Case study ( Coming soon )</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <!--- THE END HERO HEADER WORK SLIDER --->

        <!--- FOOTER --->
        <div class="container">
            <div class="row">
                <div class="footer-bg">
                    <div class="col-md-4 col-xs-12">
                        <h1 div class="tfv"> Thanks for visiting. </h1>
                        <a href="mailto:#0">
                            <div class="ftr-lnk"> Just say hello</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--- THE END FOOTER --->

        <!--- SCRIPTS --->
        <script src="{{asset("/js/jquery-2.1.1.js")}}"></script>
        <script src="{{asset("/js/main.js")}}"></script>
        <script src="{{asset("/js/bootstrap.min.js")}}"></script>
        <!--- THE END SCRIPTS --->

    </div>
    <!--- THE PAGE LOADING --->
</div>
</div>
</body>

</html>
