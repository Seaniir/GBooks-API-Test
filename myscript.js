var titleArray = new Array();
var authorsArray = new Array();
var imgArray = new Array();

$(document).ready(function () 
{
    var arrayDiv = new Array();
    
    $("#test").click(function () 
    {
        for (var i = 0; i < arrayDiv.length; i++) {
             $('.bookCards').remove();
          }
        
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
                     }
                    // Je charge les données dans box
                    for (i = 0; i < data.items.length; i++) 
                    {

                        title = $('<h5 class = "center-align black-text">' + data.items[i].volumeInfo.title + '</h5>');
                        author = $('<h5 class = "center-align black-text">' + data.items[i].volumeInfo.authors + '</h5>');
                        img = $('<img class = "aligning card z-depth-5" id = "dynamic"><br><button onClick="showTitle(' +i+')" id ="imagebutton" class="btn red aligning">INFO</button></a>');
                        if (data.items[i].volumeInfo.imageLinks === undefined) 
                        {
                            title = null;
                            author = null;
                            img = null;
                            url = null;
                        } 
                        else 
                        {
                            arrayDiv[i] = document.createElement('div');
                            arrayDiv[i].className = 'bookCards';
                            url = data.items[i].volumeInfo.imageLinks.thumbnail;
                            img.attr('src', url); //Attach the image url
                            title.appendTo(arrayDiv[i]);
                            author.appendTo(arrayDiv[i]);
                            img.appendTo(arrayDiv[i]);
                            document.body.append(arrayDiv[i]);
                        }
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

function showTitle(i)
{
    console.log(titleArray[i]);
    console.log(authorsArray[i]);
    console.log(imgArray[i]);
    var stuff ={'key1':  titleArray[i], 'key2' : authorsArray[0][0], 'key3' : imgArray[i].thumbnail};
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

