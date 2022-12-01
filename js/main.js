/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
**
** JS-file that contains several important functions:
** 
** - Receives access token via Blizzard API
** - Writes out searched items for users from Blizzard API
** - Writes out classes and reserved items from SQL for users
** - Autocomplete function for search
*/

"use strict";

let url = "https://eu.api.blizzard.com/data/wow/search/item?namespace=static-eu&name.en_US="; 
let beforeToken = "&orderby=id&_page=1&access_token=";

document.addEventListener("DOMContentLoaded", function(){
    /*
    ** Utilizing axios to get access token via API/get_access_token.php. Token is then 
    ** used throughout the rest of the script.
    */
    axios({
        method: 'POST',
        url: 'API/get_access_token.php',
        data: {id: 1},
        }) // get information via AJAX request using includes/getdb.php
        .then(function(response) {
            var jsonData = response.data;
            var token = jsonData[0].value;
            console.log(token);

            // ITEM 1
            document.getElementById('item1').addEventListener("input", function(e){
                let fullURL = url + document.getElementById("item1").value + beforeToken + token;
                // fetches the searched term via Blizzard API
                fetch(fullURL, {method: 'GET'})
                    .then(response => response.text())
                        .then(data => {
                            var jsonData = JSON.parse(data); // Parses the JSON-data into an object.
                            let itemArray = [];
                            if(jsonData.results.length != 0){
                                for(var i = 0; i < jsonData.results.length; i++){
                                    // push the name of the item into an array called itemArray, this array will be pushed into function autocomplete
                                    itemArray.push(jsonData.results[i].data.name.en_GB);
                                }
                                autocomplete(document.getElementById("item1"), itemArray);
                            }        
                        })
                        .catch(error => {
                            alert('There was an error '+error);
                        });
            })

            // ITEM 2
            document.getElementById('item2').addEventListener("input", function(e){
                let fullURL = url + document.getElementById("item2").value + beforeToken + token;
                // fetches the searched term via Blizzard API
                fetch(fullURL, {method: 'GET'})
                    .then(response => response.text())
                        .then(data => {
                            var jsonData = JSON.parse(data); // Parses the JSON-data into an object.
                            let itemArray = [];
                            if(jsonData.results.length != 0){
                                for(var i = 0; i < jsonData.results.length; i++){
                                    // push the name of the item into an array called itemArray, this array will be pushed into function autocomplete
                                    itemArray.push(jsonData.results[i].data.name.en_GB);
                                }
                                autocomplete(document.getElementById("item2"), itemArray);
                            }        
                        })
                        .catch(error => {
                            alert('There was an error '+error);
                        });
            })

            document.getElementById('afterReserve').addEventListener("click", function(e){
                /*
                ** Creating two arrays, "classes" containing all the classes from the game and "classColors" containing all the colors for the classes.
                ** The class colors are in the same order as the classes, i.e. class Warrior has the color #C69B6D, Rogue #FFF468, etc. This is utilized
                ** later on to color every class accordingly.
                */
                let classes = ['Warrior', 'Rogue', 'Mage', 'Warlock', 'Paladin', 'Shaman', 'Priest', 'Druid', 'Hunter'];
                let classColors = ['#C69B6D', '#FFF468', '#3FC7EB', '#8788EE', '#F48CBA', '#0070DD', '#FFFFFF', '#FF7C0A', '#AAD372'];
                var j = 0;
                document.getElementById('reservedItems').innerHTML = ""; // clear the div reservedItemss
                document.getElementById('reservedItems').style.display = 'flex'; // style flex to utilize flex-boxes
                document.getElementById('reservedItems').style['flex-wrap'] = 'wrap';
                document.getElementById('reservedItems').style['justify-content'] = 'center';

                // for every element in classes, create a new div for each classs with respective class colors
                for(const e of classes){
                    document.getElementById('reservedItems').innerHTML += "<div id='"+e+"'>"+"<h2 class='classes'>"+e+"<hr /></div>";
                    document.getElementById(e).style.color = classColors[j];
                    document.getElementById(e).style.width = '20%';
                    j++;
                }
                
                /*
                ** utilize includes/getdb.php to write out every playername and the items that has been reserved.
                */
                axios({
                    method: 'POST',
                    url: 'includes/getdb.php',
                    data: {id: 1},
                    }) // get information via AJAX request using includes/getdb.php
                    .then(function(response) {
                        var jsonData = response.data; // data is a json object
                        console.log(jsonData);
                        // check if the jsonObject is empty or not
                        if(Object.keys(jsonData).length != 0){
                            for(var i = 0; i < jsonData.length; i++){
                                document.getElementById(jsonData[i].Class).innerHTML += "<span id='"+jsonData[i].PlayerName+"'>"
                                +"<br />Name: "+jsonData[i].PlayerName
                                +"<br />#1: "+jsonData[i].Item1
                                +"</br >#2: "+jsonData[i].Item2
                                +"</span><br />";
                                document.getElementById(jsonData[i].PlayerName).style.color = '#FFFFFF';
                            }
                        }
                    })
                })
            })
});


/*
** @param inp: input of the user (in this case 'item1' and 'item2')
** @param arr: array to search through, in this case created itemArray
**
** Function based of https://www.w3schools.com/howto/howto_js_autocomplete.asp.
**
** The function will take an input together with an array and update the page with <div> containing
** matching autocompleted values.
*/
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    var a, b, i, val = inp.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) {
        return false;
    }
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", inp.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    inp.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
        }
    }
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}