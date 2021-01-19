'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

// function runFormValidation()
// {
//     var $form;
//     var formValidator;

//     $form = $('form:not([data-no-validation=true])');

//     // Y a t'il un formulaire à valider sur la page actuelle ?
//     if($form.length == 1)
//     {
//         // Oui, exécution de la validation de formulaire.
//         formValidator = new FormValidator($form);
//         formValidator.run();
//     }
// }

// function runOrderForm()
// {
//     var orderForm;
//     var orderStep;

//     orderForm = new OrderForm();

//     // A quelle étape de la commande sommes-nous ?
//     orderStep = $('[data-order-step]').data('order-step');

//     switch(orderStep)
//     {
//         case 'run':
//         orderForm.run();        // Commande en cours
//         break;

//         case 'success':
//         orderForm.success();    // Succès du paiement de la commande
//         break;
//     }
// }



/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

// $(function()
// {
//     // Effet spécial sur la boite de notifications (le flash bag).
//     $('#notice').delay(3000).fadeOut('slow');


//     // Exécution de la validation de formulaire si besoin.
//     runFormValidation();

//     // Exécution de la gestion du processus de commande si besoin.
//     if(typeof OrderForm != 'undefined')
//     {
//         runOrderForm();
        
//     }
// });

// bar de recherche
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mydiv article").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

// scroll
$(document).ready(function(){
 
    $(window).scroll(function(){
    
     var position = $(window).scrollTop();
     var bottom = $(document).height() - $(window).height();
   
     if( position == bottom ){
   
      var row = Number($('#row').val());
      var allcount = Number($('#all').val());
      var rowperpage = 3;
      row = row + rowperpage;
   
      $("#scroll").text($("#mydiv article:last-of-type").attr("id")); 
      var lastId = $("#mydiv article:last-of-type").attr("id")
     //  if(row <= allcount){
     //   $('#row').val(row);
     //   $.ajax({
     //    url: 'fetch_details.php',
     //    type: 'post',
     //    data: {row:row},
     //    success: function(response){
     //     $(".post:last").after(response).show().fadeIn("slow");
     //    }
     //   });
     //  }
     }
   
    });
    
   });



// $(document).ready(function(){
//     $(window).scroll(function(){
//         var currentPageNumber = 1;
//         if($(window).scrollTop() == $(document).height() - $(window).height()){
//             currentPageNumber += 1;
//             loadData(currentPageNumber);
//         }
//     });

    
//     function loadData(currentPage){
//         $ajax({
//             url : "getMoreMovies/",
//             method: 'post',
//             data: {pageNumber: currentPage, pageSize: 30},
//             success: function (data) {
//                 var divMovies = $('#movieSql');

//                 $(data).each(function(index, movie){
//                     divMovies.append('<a class="poster" href=/index.php/movie?id_m="' + movie.id_m +
//                     '<img class="main" src="' + movie.poster_m + '" alt="' +movie.title_m + '"<strong>' + 
//                     movie.title_m + '</strong></a>');
//                 })

//             }
//         });
//     }
// });


