$(document).ready(function () 
{
    var arrayDiv = new Array();

    $("#books").keyup(function() 
    {
        for (var i = 0; i < arrayDiv.length; i++) {
            $('.bookCards').remove();
          }
        $('#result').empty();

        var search = $("#books").val();

        if (search == '') 
        {
        } 
        else 
        {
            //alert("Rentré2");
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
                    // Je charge les données dans box
                    for (i = 0; i < data.items.length; i++) 
                    {
                        title = $('<h5 class = "center-align black-text">' + data.items[i].volumeInfo.title + '</h5>');
                        author = $('<h5 class = "center-align black-text">' + data.items[i].volumeInfo.authors + '</h5>');
                        img = $('<img class = "aligning card z-depth-5" id = "dynamic"><br><a href =' + data.items[i].volumeInfo.infoLink + '><button id ="imagebutton" class="btn red aligning">INFO</button></a>');
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