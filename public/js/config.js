function add_category(select,categories,categories_show){
    if(select.value != ""){
        if(categories.value.indexOf(select.value) == -1){
            categories.innerText = categories.value + select.value + ";";
            update_categories(categories,categories_show);
        }
    }
}

function remove_category(times){
    var a = document.getElementById("categories");
    var categories_show = document.getElementById("categories_show");
    a.innerText = a.value.replaceAll(times.parentElement.innerText+";","");
    update_categories(a,categories_show);
}

function update_categories(categories,categories_show){
    if(categories.value != ""){
        var cate  = categories.value.substring(0,categories.value.length-1);
        var text = '<button type="button" class="btn btn-outline-light me-2">' + cate.replaceAll(";",'<i class="fas fa-times ms-1" onclick="remove_category(this)"></i></button><button type="button" class="btn btn-outline-light me-2">')+'<i class="fas fa-times ms-1"  onclick="remove_category(this)"></i></button>';
        categories_show.innerHTML = text;
    } else {
        categories_show.innerHTML = "";
    }
}
function useLink(check){
    let poster = document.getElementById('poster');
    let link = document.getElementById('link');
    let files = document.getElementsByName("image[]");
    if(check.checked == true){
        poster.src = link.value;
        link.required =  true;
        files[0].required =  false;
    } else {
        poster.src = "";
        const file = files[0].files[0];
        if(files[0].value != ""){
            const render = new FileReader();
            render.onload = function () {
                const result = render.result;
                poster.src = result;
            };
            render.readAsDataURL(file);
        }
        
        files[0].required =  true;
        link.required =  false;
    }
}