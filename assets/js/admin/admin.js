function makeAdmin(event, baseUrl, id){
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/makeAdmin/'+ id, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };
    xhr.send();
}

function removeAdmin(event, baseUrl, id){
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/removeAdmin/'+ id, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };
    xhr.send();
}

function deleteUser(event, baseUrl, id){
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/deleteUser/'+ id, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };
    xhr.send();
}

function addButtonClicked(idToHide, idtoShow){
    document.getElementById(idToHide).style.display = 'none';
    document.getElementById(idtoShow).style.display = 'table-row';
}

function editButtonClicked(idToHide, idtoShow){
    document.getElementById(idToHide).style.display = 'none';
    document.getElementById(idtoShow).style.display = 'table-cell';
}

function cancelEditButtonClicked(idtoShow, idToHide){
    document.getElementById(idToHide).style.display = 'none';
    document.getElementById(idtoShow).style.display = 'table-cell';
}


function addNewArtistCategory(event, baseUrl, idInput){
    
    event.preventDefault();
    var category_name = document.getElementById(idInput).value;
    
    if(category_name == ''){
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/addNewArtistCategory' , true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };

    xhr.send('artist_category_name=' + category_name);
}

function updateArtistCategoryName(event, baseUrl, input, id, current_name){
    
    event.preventDefault();
    var category_name = document.getElementById(input).value;
    
    if(category_name == ''){
        return;
    }
    
    if(category_name == current_name){
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/updateArtistCategoryName' , true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };
    
    xhr.send('&artist_category_id=' + id + '&artist_category_name=' + category_name);
}

function updateProductCategoryName(event, baseUrl, input, id, current_name){
    
    event.preventDefault();
    var category_name = document.getElementById(input).value;
    
    if(category_name == ''){
        return;
    }
    
    if(category_name == current_name){
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + 'admin/updateProductCategoryName' , true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if(this.responseText != "success"){
           console.log(this.responseText)
        } 
    };
    
    xhr.send('product_category_id=' + id + '&product_category_name=' + category_name);
}