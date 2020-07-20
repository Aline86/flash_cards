/*document.querySelectorAll("a").forEach(elem => {
    elem.addEventListener("click", function(e){
$.ajax({
type: "GET",
url: $(this).attr("href"),
})
.done(function( msg ) {
$("#result").html(msg);
});
e.preventDefault();
});
})

document.getElementById("theme_form").addEventListener('submit', function(e){
    e.preventDefault();
    var motcle = document.getElementById("theme").value
    var str = document.location.href; 
    var url = new URL(str);
    var string= url.search
    var last = string.charAt(string.length-1); 
    var page = url.searchParams.get("page");
    console.log(last);
   

    $.ajax({
        type: "POST",
        url: "{{ path('rechercher')}}",
        data: {
            'page': last,
            'motcle': motcle
        },
        cache: false,
        success: function(data){
     
        }
         
        })
    });
      
   


  function ajax(motcle, page){
     document.querySelectorAll("a").forEach(elem => {
      
       var page=elem.innerHTML;
   document.querySelectorAll("a").forEach(elem => {
    elem.addEventListener("click", function(e){
$.ajax({
type: "GET",
url: $(this).attr("href"),
})
.done(function( msg ) {
$("#result").html(msg);
});
e.preventDefault();
});
}) })
  }
*/