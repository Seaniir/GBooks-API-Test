$(document).ready(function () 
{


    $("#test").click(function () 
    {
        $('#result').empty();

        var search = $("#books").val();

        if (search == '') 
        {
            alert("Please enter something in the field first");
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
                        img = $('<img class = "aligning card z-depth-5" id = "dynamic"><br><a href =' + data.items[i].volumeInfo.infoLink + '><button id ="imagebutton" class="btn red aligning">Read More</button></a>');
                        if (data.items[i].volumeInfo.imageLinks === undefined) 
                        {
                            title = null;
                            author = null;
                            img = null;
                            url = null;
                        } 
                        else 
                        {
                            url = data.items[i].volumeInfo.imageLinks.thumbnail;
                            img.attr('src', url); //Attach the image url
                            title.appendTo("#result");
                            author.appendTo("#result");
                            img.appendTo("#result");
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