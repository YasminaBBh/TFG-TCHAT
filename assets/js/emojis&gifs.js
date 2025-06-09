// Mostrar/ocultar el panel de emojis
      $("#smiley").click(function() {
        $("#emojiPanel").toggleClass("active");
      });

      $("#emojiTab").click(function() {
        $("#emojis").addClass("active");
        $("#gifs").removeClass("active");
        $("#emojiTab").addClass("active");
        $("#gifTab").removeClass("active");
      });

      $("#gifTab").click(function() {
        $("#emojis").removeClass("active");
        $("#gifs").addClass("active");
        $("#emojiTab").removeClass("active");
        $("#gifTab").addClass("active");
      });

      // Cargar emojis
      $.ajax({
        type: "GET",
        url: "assets/js/emojis_es_unicos.json",
        dataType: "json",
        success: function(data) {
          var emojiPanel = $('#emojis');
          data.forEach(function(emoji) {
            emojiPanel.append('<span class="emojis" data-emoji="' + emoji.nombre + '">' + emoji.caracter + '</span>');
          });

          // Añadir evento click a los emojis
          $('.emojis').click(function() {
            var emoji = $(this).html();
            $('#message').val(function(i, text) {
              return text + ' ' + emoji;
            });
            $("#emojiPanel").removeClass("active");
          });
        }
      })
      
    var giphyApiKey = "WvFILWNYhvmL1AKhKDd5CwAbVl8qxlRH";
    // Cargar Gifs
    $('#gifTab').click(function() {
      var url = "https://api.giphy.com/v1/gifs/trending?api_key=" + giphyApiKey + "&limit=12&rating=g";
      searchGifs(url);
    });

    // Buscar Gifs
    $('#gifSearch').on("change", async (e) => {
      e.preventDefault();
      const query = $('#gifSearch').val().trim().toLowerCase();
      if (!query) return;
      const url = `https://api.giphy.com/v1/gifs/search?api_key=${giphyApiKey}&q=${encodeURIComponent(query)}&limit=12&rating=g`;
      searchGifs(url);
    });

    // Busqueda de gifs
    function searchGifs(url) {
      var gifPanel = $('#gifResults');
      gifPanel.html('Cargando...');
      $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
      success: function(data) {
        gifPanel.html('');
        if (data.data.length === 0) {
          gifPanel.html('<p>No se encontraron GIFs.</p>');
        } else {
          data.data.forEach(function(gif) {
            // Usar jQuery para crear el elemento y añadirlo correctamente
            var $img = $('<img>')
              .addClass('gif')
              .attr('src', gif.images.fixed_height.url)
              .attr('alt', gif.slug);
            gifPanel.append($img);
          });
          // Añadir evento click a los gifs
          $('.gif').click(function() {
            var gifUrl = $(this).attr('src');
            var form = $("#formenviarmsj_texto").serializeArray();
            data = {
              user_id: form[0].value,
              to_id: form[1].value,
              user: form[2].value,
              to_user: form[3].value,
              message: gifUrl,
              archivos: "Giphy"
            };
            data = JSON.stringify(data);
            
            $.ajax({
              type: "POST",
              url: "acciones/enviarGif.php",
              data: data,
              complete: function(data) {
              },
              success: function(data) {
                var idConectado = form[0].value;
                $("#conversation").load('MsjsUsers.php?id=' + idConectado, function() {
                });
                $(".audio")[0].play(); //reproducir audio de envio
              }
            });
            $("#emojiPanel").removeClass("active");
            return false;
          });
        }
      }
      })
    }