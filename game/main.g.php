<?php
include_once("../layout/gameHeader.php");
?>
<div id="mainContainer">
    <div id="map">
        <!-- currentlt just doing a 3 x 3 grid for the map-->
        <div id="0" class="row">
            <div id="0-0" class="col">
                <button><i class="fa fa-anchor" style="font-size:36px"></i></button>
            </div>
            <div id="0-1" class="col"><button><i class="fa fa-birthday-cake" style="font-size:36px"></i></button></div>
            <div id="0-2" class="col"><button><i class="fa fa-bug" style="font-size:36px"></i></button></div>
        </div>
        <div id="1" class="row">
            <div id="1-0" class="col"><button><i class="fa fa-diamond" style="font-size:36px"></i></button></div>
            <div id="1-1" class="col"><button><i class="fa fa-fire" style="font-size:36px"></i></button></div>
            <div id="1-2" class="col"><button><i class="fa fa-leaf" style="font-size:36px"></i></button></div>
        </div>
        <div id="2" class="row">
            <div id="2-0" class="col"><button><i class="fa fa-rocket" style="font-size:36px"></i></button></div>
            <div id="2-1" class="col"><button><i class="fa fa-snowflake-o" style="font-size:36px"></i></button></div>
            <div id="2-2" class="col"><button><i class="fa fa-ship" style="font-size:36px"></i></button></div>
        </div>
    </div>
</div>
<script src="../js/mapMaker.js"></script>
<?php
include_once("../layout/gameFooter.php");
?>