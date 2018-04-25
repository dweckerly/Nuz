<!DOCTYPE html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/uiEffects.js"></script>
    
    <title>NuzMon</title>
<?php
include_once("getPartyMons.php");
?>
</head>
<body>
<div class="container">
    <div class="row align-items-center">
        <div class="col-6" align="center">
            <div class="d-block">
                <h4 id="enemy-name"></h4>
            </div>
            <div class="d-block">
                <div class="progress">
                    <div id="enemy-health" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
                </div>
            </div>
            <div class="d-block">
                <p id="enemy-status"></p>
            </div>
        </div> 
        <div id="enemy-mon-portrait-container" class="col-6" align="center">
            <img id="enemy-mon-portrait" class="mon-battle-portrait" src="">
        </div>
    </div>
    <div class="row align-items-center">
        <div id="player-mon-portrait-container" class="col-6" align="center">
            <img id="player-mon-portrait" class="mon-battle-portrait" src="">
        </div> 
        <div class="col-6" align="center">
            <div class="d-block">
                <h4 id="player-name"></h4>
            </div>
            <div class="d-block">
                <div class="progress">
                    <div id="player-health" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
                </div>
            </div>
            <div class="d-block">
                <p id="player-status"></p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div id="battle-command-container" class="col-sm-6">
            <div class="d-block" align="center">
                <div class="d-inline">
                    <button id="atk-btn" class="btn btn-outline-secondary battle-button">Attack</button>
                </div>
                <div id="switch-btn" class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Switch</button>
                </div>
            </div>
            <div id="inv-btn" class="d-block" align="center">
                <div class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Items</button>
                </div>
                <div id="sur-btn" class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Surrender</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div id="attack-container" class="col-sm-6">
            <div class="d-block" align="center">
                <div class="d-inline">
                    <button id="atk-1" class="btn btn-outline-secondary battle-button"></button>
                </div>
                <div class="d-inline">
                    <button id="atk-2" class="btn btn-outline-secondary battle-button"></button>
                </div>
            </div>
            <div class="d-block" align="center">
                <div class="d-inline">
                    <button id="atk-3" class="btn btn-outline-secondary battle-button"></button>
                </div>
                <div class="d-inline">
                    <button id="atk-4" class="btn btn-outline-secondary battle-button"></button>
                </div>
            </div>
            <div align="center">
                <button id="back-btn" class="btn btn-outline-secondary">-></button>
            </div>
        </div>
    </div>
    <div class=" row justify-content-center">
        <div id="text-container" class="col-sm-6">
            <h4 id="message"></h4>
        </div>
    </div>
</div>
<script src="battle.js"></script>
</body>
</html>