
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <style>
                .carousel {
                    margin-left: 113px;
                    width: 942px;
                }
                .carousel-inner > .item > img, .carousel-inner > .item > a > img {
                    line-height: 1;
                    height: 469px;
                    width: 100%;
                }

            </style>


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src='<?php echo $this->baseUrl() . '/images/slider/kids.jpg'?>' >
                    </div>

                    <div class="item">
                        <img src="<?php echo $this->baseUrl() . '/images/slider/home.jpg';?>" >
                    </div>

                    <div class="item">
                        <img src="<?php echo $this->baseUrl() . '/images/slider/cooking.jpg';?>"  >
                    </div>

                    <div class="item">
                        <img  src="<?php echo $this->baseUrl() . '/images/slider/wedding.jpg';?>" >
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

