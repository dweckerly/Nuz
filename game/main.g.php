<?php
include_once("../layout/gameHeader.php");
?>
<div id="mainContainer">
    <div id="map">
        <!-- currentlt just doing a 3 x 3 grid for the map-->
        <div id="0" class="row">
            <div id="0-0" class="col">
                <button><img src="" /></button>
            </div>
            <div id="0-1" class="col"></div>
            <div id="0-2" class="col"></div>
        </div>
        <div id="1" class="row">
            <div id="1-0" class="col"></div>
            <div id="1-1" class="col"></div>
            <div id="1-2" class="col"></div>
        </div>
        <div id="2" class="row">
            <div id="2-0" class="col"></div>
            <div id="2-1" class="col"></div>
            <div id="2-2" class="col"></div>
        </div>
    </div>
</div>
<script src="../js/mapMaker.js"></script>
<?php
include_once("../layout/gameFooter.php");
?>