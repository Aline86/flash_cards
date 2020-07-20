
const list_element = document.getElementById('result');
const pagination_element = document.getElementById('pagination');

let start = 5 * 1
let end = 1 + 5;
let paginatedItems = list_element.innerHTML.slice(start, end);

    


let current_page = 1;
let rows = 5;

function DisplayList (items, wrapper, rows_per_page, page){
    wrapper.innerHTML="";
    page--;

    let start = rows_per_page * page;
    let end = start + rows_per_page;
    let paginatedItems = list_element.slice(start, end);
    console.log(paginatedItems)
    for(let i = 0; i <paginatedItems.length; i++){
        console.log(items[i]);
    }
}

document.getElementById('button').addEventListener('click', function(e){
    document.getElementById('french').style.display= "none";
    document.getElementById('russian').style.display= "block";
    document.getElementById('russian').classList.add('add');
  
  
})

