$(document).ready(function () {
   $('activateAccountButton').click(function () {
       $.ajax({
           url: '/activate-account',
           type: 'POST',
           data: {
               _token: $('meta[name="csrf-token"]').attr('content'),

           }
       });
   }) ;
});
