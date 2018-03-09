var day = true;
var dayCount = 1;
var millitaryTime = false;

// amount of time for a minute to pass (in milliseconds)
var minuteInterval = 20;

function timeKeeper() {
    var minutes = 0;
    var hours = 7;

    setInterval(function() {
        // update minutes everytime called
        minutes++;
        // change minutes and hours to replicate actual time keeping
        if (minutes > 59) {
            minutes = 0;
            hours++;
            if (hours > 23) {
                hours = 0;
                dayCount++;
                updateDay();
            }
        }

        // check for if it's day or night
        if (hours > 17 || hours < 6) {
            day = false;
            cycleDay("Night");
        } else {
            day = true;
            cycleDay("Day");
        }

        // check for military or standard time setting
        if (millitaryTime) {
            millitaryTimeDisplay(hours, minutes);
        } else {
            standardTimeDisplay(hours, minutes);
        }
    }, minuteInterval)
}

// next two functions control display of the two options
function millitaryTimeDisplay(hours, minutes) {
    if (hours < 10) {
        if (minutes < 10) {
            timeString = "0" + hours + ":" + "0" + minutes;
        } else {
            timeString = "0" + hours + ":" + minutes;
        }
    } else {
        if (minutes < 10) {
            timeString = hours + ":" + "0" + minutes;
        } else {
            timeString = hours + ":" + minutes;
        }
    }
    document.getElementById("time").innerHTML = timeString;
}

function standardTimeDisplay(hours, minutes) {
    if (hours == 0) {
        hours = 12;
    }
    if (hours > 12) {
        hours = hours - 12;
    }
    millitaryTimeDisplay(hours, minutes);
}

// sets dayOrNight span to passed in string
function cycleDay(day) {
    document.getElementById("dayOrNight").innerHTML = day;
}

// change from millitary to standard time and vice-versa
function toggleTime() {
    millitaryTime = !millitaryTime;
}

// displays current day count.
function updateDay() {
    document.getElementById("dayCount").innerHTML = "Day " + dayCount;
}

// will call this function when a button is clicked in on the main frame. Passing in 
// the index of the HTML to be displayed. Need to store that in some variable...
function changeMainFrame(index) {
    document.getElementById("mainFrame").innerHTML = "<h1>TEST " + index + "</h1>";
}