var titleArray = new Array();
var authorsArray = new Array();
var imgArray = new Array();
var ISBNArray = new Array();
var ISBN10Array = new Array();
var ISBN13Array = new Array();
var arrayDiv = new Array();

$(document).ready(function () 
{    
    $("#test").click(function () 
    {   
        var search = $("#books").val();

        if (search == '') 
        {
            alert("Please enter something in the field first");
        } 
        else 
        {    
            var url = '';
            var img = '';
            var title = '';
            var author = '';
            var bookURL = "https://www.googleapis.com/books/v1/volumes?q=";


            $.ajax({

                url: bookURL + search + "&maxResults=40",

                langRestrict: 'fr',

                // La fonction à apeller si la requête aboutie
                success: function (data) {
                    for (j = 0; j < data.items.length; j++) {
                        titleArray[j] = data.items[j].volumeInfo.title;
                        authorsArray[j] = data.items[j].volumeInfo.authors;
                        imgArray[j] = data.items[j].volumeInfo.imageLinks;
                        ISBNArray[j] = data.items[j].volumeInfo.industryIdentifiers;
                     }

                    // Je charge les données dans box
                    for (i = 0; i < data.items.length; i++) 
                    {
                        if(ISBNArray[i][0].type == "ISBN_10")
                        {
                            ISBN10Array[i] = ISBNArray[i][0].identifier;
                            ISBN13Array[i] = ISBNArray[i][1].identifier;
                        }
                        else 
                        {
                            ISBN13Array[i] = ISBNArray[i][0].identifier;
                            ISBN10Array[i] = ISBNArray[i][1].identifier;
                        }
                        load(ISBN10Array[i], ISBN13Array[i], data.items[i], arrayDiv, i);
                    }
                        
                },

                // La fonction à appeler si la requête n'a pas abouti
                error: function () 
                {
                    // J'affiche un message d'erreur
                    console.log("Désolé, aucun résultat trouvé.");
                }

            });
        }
    });

});

function showTitle(title,i)
{
    var ISBN;
    var lol;
    console.log(title);
    console.log(authorsArray[i]);
    if(imgArray[i] == null)
    {
        lol = null;
    }
    console.log(imgArray[i]);
    if(ISBNArray[i][0].type == "ISBN_10")
    {
        ISBN = ISBNArray[i][0].identifier;
        console.log(ISBN);
    }
    else
    {
        ISBN = ISBNArray[i][1].identifier;
        console.log(ISBN);
    }
    var stuff ={'key1':  title, 'key2' : authorsArray[i], 'key3' : lol, 'key4' : ISBN};
    $.ajax({
        type: "POST",
        dataType: 'json',
        data: stuff,
        url: 'saveBooks.php',
        success: function(msg) {
          if (msg.error == 1) {
            alert('Something Went Wrong!');
          } else {
          }
        }
      });
}

function searchTitle(ISBN)
{
    var afond;
    var url = "https://openlibrary.org/isbn/";
    url += ISBN;
    url += ".json";
    return fetch(url).then(response => response.json()).then(response => {return(response.title)});
}

function imgError(image) {
    image.parentElement.remove();
}

async function load(ISBN10Array, ISBN13Array, data, arrayDiv, i) 
{
    $('.bookCards').remove();
    arrayDiv.length = 0;
    var urlFetch = "https://openlibrary.org/isbn/";
    urlFetch += ISBN13Array;
    urlFetch += ".json";
let response = await fetch(urlFetch).then((response) => response.json()).then((user) => {return user.title});
title = $('<h5 class = "center-align black-text">' + response + '</h5>');
author = $('<h5 class = "center-align black-text">' + data.volumeInfo.authors + '</h5>');
img = $('<img class = "aligning card z-depth-5" id = "dynamic"><br><button onClick="showTitle(\'' + response + '\',\'' + i + '\')" id ="imagebutton" class="btn red aligning">INFO</button></a>');

if(data.volumeInfo.authors != undefined)
{
    var fleximax = "//ws-eu.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=FR&ASIN=";
    fleximax += ISBN10Array; 
    fleximax += "&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=seanir-21";
    console.log(fleximax);
    arrayDiv[i] = document.createElement('div');
    arrayDiv[i].className = 'bookCards';
    title.appendTo(arrayDiv[i]);
    url = fleximax;
    img.attr('src', url); //Attach the image url
    img.attr('onError', 'imgError(this)'); //Attach the image url
    author.appendTo(arrayDiv[i]);
    img.appendTo(arrayDiv[i]);
    document.body.append(arrayDiv[i]);
    console.log(arrayDiv.length);
}
else{
    title = null;
    author = null;
    img = null;
}
}