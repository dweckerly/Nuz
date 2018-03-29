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
</head>
<body>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-6" align="center">
            <div class="d-block">
                <div class="progress">
                    <div id="enemy-health" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="d-block">
                <p id="enemy-status">Status</p>
            </div>
        </div> 
        <div class="col-6" style="background-color: #000022;" align="center">
            <img id="enemy-mon-portrait" class="mon-battle-portrait" src="/img/mons/derple.jpg">
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-6" style="background-color: powderblue;" align="center">
            <img id="player-mon-portrait" class="mon-battle-portrait" src="/img/mons/derple.jpg">
        </div> 
        <div class="col-6" align="center">
            <div class="d-block">
                <div class="progress">
                    <div id="player-health" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="d-block">
                <p id="player-status">Status</p>
            </div>
        </div>
    </div>
    <div class=" row justify-content-center">
        <div class="col-sm-6">
            <div class="d-block" style="background-color: #123456;" align="center">
                <div class="d-inline">
                    <button id="btn-1" class="btn btn-outline-secondary battle-button">Label</button>
                </div>
                <div class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Label</button>
                </div>
            </div>
            <div class="d-block" style="background-color: #654321;" align="center">
                <div class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Label</button>
                </div>
                <div class="d-inline">
                    <button class="btn btn-outline-secondary battle-button">Label</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="battle.js"></script>
</body>
</html>