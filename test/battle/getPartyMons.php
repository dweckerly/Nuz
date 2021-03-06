<?php
include_once("../../includes/db.inc.php");
// would use the SESSION variable here...
$pid = 1628894889;
?>
<script>
var pMons = {
<?php
$sql = "SELECT * FROM ownedMons WHERE playerID = '$pid' AND inParty = 1";
$result = mysqli_query($conn, $sql);
$rows = array();
while($val = mysqli_fetch_assoc($result)) {
    $rows[] = $val;
}

// using the foreach loop below to cache all party information in a json object
foreach($rows as $row) {
    // need to query and get type, name, imgPath.    
    $mid = $row['monID'];
    $sql = "SELECT imgPath, type1, type2 FROM mons WHERE monID = '$mid'";
    $result = mysqli_query($conn, $sql);
    $vals = mysqli_fetch_assoc($result);
    echo $row['partyOrder']; ?> : {
        'name' : '<?php echo $row['name']; ?>',
        'type1' : '<?php echo $vals['type1']; ?>',
        'type2' : '<?php echo $vals['type2']; ?>',
        'cHp' : '<?php echo $row['currentHp']; ?>',
        'hp' : '<?php echo $row['hp']; ?>',
        'atk' : '<?php echo $row['atk']; ?>',
        'def' : '<?php echo $row['def']; ?>',
        'sAtk' : '<?php echo $row['sAtk']; ?>',
        'sDef' : '<?php echo $row['sDef']; ?>',
        'speed' : '<?php echo $row['speed']; ?>',
        'status' : '<?php echo $row['status']; ?>',
        'attacks' : { <?php
            $atk1 = $row['atk1'];
            $atk2 = $row['atk2'];
            $atk3 = $row['atk3'];
            $atk4 = $row['atk4'];
            $sql = "SELECT * FROM attacks WHERE atkID = '$atk1' OR atkID = '$atk2' OR atkID = '$atk3' OR atkID = '$atk4'";
            $result = mysqli_query($conn, $sql);
            $atkRows = array();
            while($aRow = mysqli_fetch_assoc($result)) {
                $atkRows[] = $aRow;
            }
            $i = 1;
            foreach($atkRows as $atkRow) {
                echo $i; ?> : {
                    'name' : '<?php echo $atkRow['name']; ?>',
                    'dmg' : '<?php echo $atkRow['dmg']; ?>',
                    'acc' : '<?php echo $atkRow['acc']; ?>',
                    'crit' : '<?php echo $atkRow['crit'] ?>',
                    'type' : '<?php echo $atkRow['type'] ?>',
                    'special' : '<?php echo $atkRow['special'] ?>',
                    'e1' : '<?php echo $atkRow['effect1'] ?>',
                    'e2' : '<?php echo $atkRow['effect2'] ?>',
                    'e3' : '<?php echo $atkRow['effect3'] ?>',
                    'contact' : '<?php echo $atkRow['contact']; ?>',
                    'priority' : '<?php echo $atkRow['priority']; ?>'
                },
            <?php
                $i++;
            }?>
        },
        'perk1' : '<?php echo $row['perk1']; ?>',
        'perk2' : '<?php echo $row['perk2']; ?>',
        'imgPath' : '<?php echo $vals['imgPath']; ?>'
    }, <?php
}
?>
};
<?php
$nid = 1;
?>
var nMons = {
<?php
$sql = "SELECT * FROM npcMons WHERE npcID = '$nid'";
$result = mysqli_query($conn, $sql);
$rows = array();
while($val = mysqli_fetch_assoc($result)) {
    $rows[] = $val;
}

// using the foreach loop below to cache all party information in a json object
foreach($rows as $row) {
    // need to query and get type, name, imgPath.    
    $mid = $row['monID'];
    $sql = "SELECT name, imgPath, type1, type2 FROM mons WHERE monID = '$mid'";
    $result = mysqli_query($conn, $sql);
    $vals = mysqli_fetch_assoc($result);
?>
    <?php echo $row['partyOrder']; ?> : {
        'name' : '<?php echo $vals['name']; ?>',
        'type1' : '<?php echo $vals['type1']; ?>',
        'type2' : '<?php echo $vals['type2']; ?>',
        'cHp' : '<?php echo $row['currentHp']; ?>',
        'hp' : '<?php echo $row['hp']; ?>',
        'atk' : '<?php echo $row['atk']; ?>',
        'def' : '<?php echo $row['def']; ?>',
        'sAtk' : '<?php echo $row['sAtk']; ?>',
        'sDef' : '<?php echo $row['sDef']; ?>',
        'speed' : '<?php echo $row['speed']; ?>',
        'status' : '<?php echo $row['status']; ?>',
        'attacks' : {<?php
            $atk1 = $row['atk1'];
            $atk2 = $row['atk2'];
            $atk3 = $row['atk3'];
            $atk4 = $row['atk4'];
            $sql = "SELECT * FROM attacks WHERE atkID = '$atk1' OR atkID = '$atk2' OR atkID = '$atk3' OR atkID = '$atk4'";
            $result = mysqli_query($conn, $sql);
            $atkRows = array();
            while($aRow = mysqli_fetch_assoc($result)) {
                $atkRows[] = $aRow;
            }
            $i = 1;
            foreach($atkRows as $atkRow) {
                echo $i; ?> : {
                    'name' : '<?php echo $atkRow['name']; ?>',
                    'dmg' : '<?php echo $atkRow['dmg']; ?>',
                    'acc' : '<?php echo $atkRow['acc']; ?>',
                    'crit' : '<?php echo $atkRow['crit'] ?>',
                    'type' : '<?php echo $atkRow['type'] ?>',
                    'special' : '<?php echo $atkRow['special'] ?>',
                    'e1' : '<?php echo $atkRow['effect1'] ?>',
                    'e2' : '<?php echo $atkRow['effect2'] ?>',
                    'e3' : '<?php echo $atkRow['effect3'] ?>',
                    'contact' : '<?php echo $atkRow['contact']; ?>',
                    'priority' : '<?php echo $atkRow['priority']; ?>'
                },
            <?php
                $i++;
            }?>
        },
        'perk1' : '<?php echo $row['perk1']; ?>',
        'perk2' : '<?php echo $row['perk2']; ?>',
        'imgPath' : '<?php echo $vals['imgPath']; ?>'
    }, <?php
}
mysqli_close($conn);
?>
};
</script>

