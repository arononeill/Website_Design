var pict_array = ["samsungTv.jpg","smartwatches.jpg","samsungNote.jpg","appleGoods.jpg"];
var counter = 0;

function rotatePicts() {
	document.getElementById("rotator").src = "Images/" + pict_array[counter];
	counter++;
	
	setTimeout(rotatePicts,3000);
	if(counter == pict_array.length) { counter = 0; }
}

//array to hold the Mr. T quotes
var quote_array = [];
var counter2 = 0;

quote_array[0] = "Stylish Samsung smart Tvs";
quote_array[1] = "The full range of new smartwatches";
quote_array[2] = "The all new Samsung Galaxy Note!";
quote_array[3] = "All your Apple needs";

//create a function
function nextQuote() {
	document.getElementById("message").innerHTML = quote_array[counter2];
	counter2++;
	
	setTimeout(nextQuote,3000);
	if(counter2 == quote_array.length) { counter2 = 0; }
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}