/* Insert your javascript here */
var movieID = { ACT, RMC, ANM, AHF }; // not used yet

function toggleSynopsis(whichID){
    var whichMovie = document.getElementById("synopsis" + whichID);
    var movieButton = document.getElementById("movieButton" + whichID);
    var movieName = movieButton.getAttribute("name");
    var synopsisDisplay = whichMovie.style.display;

    if (synopsisDisplay == 'block'){
        whichMovie.style.display = 'none';   
        console.log(movieName + ": hide");
        return;
    }
    else {
        whichMovie.style.display = 'block';
        console.log(movieName + ": show");
        return;
    }
}