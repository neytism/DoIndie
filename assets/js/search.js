const search_container = document.getElementById('search-container');
const results_container = document.getElementById('results');
const loading = document.getElementById('loading');
const no_result = document.getElementById('no-result');

function inputSearch(input_box, base_url){

    let keyword = input_box.value;
    
    if(keyword == ''){
        search_container.style.display = 'none';
        loading.style.display = 'none';
        no_result.style.display = 'none';
        results_container.style.display = 'none';
        results_container.innerHTML = '';
    } else{
        search_container.style.display = 'block';

        loading.style.display = 'block';
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', base_url + 'search/keyword' , true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload  = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                loading.style.display = 'none';
                
                const response = xhr.responseText

                var [result, message] = response.split("|");
    
                if(result === 'null'){
                    
                    no_result.style.display = 'block';
                    results_container.style.display = 'none';
                    results_container.innerHTML = '';
                
                }else{
                    let results_serialized = JSON.parse(message);
                    
                    let artists = JSON.parse(results_serialized.artists);
                    let users = JSON.parse(results_serialized.users);
                    let products = JSON.parse(results_serialized.products);
                    
                    results_container.style.display = 'block';
                    results_container.innerHTML = '';

                    function highlight(text, keyword) {
                        const regex = new RegExp(`(${keyword})`, 'gi');
                        return text.replace(regex, '<span style="background-color: yellow;">$1</span>');
                    }
                    
                    function addDivider(text) {
                        let divider = document.createElement('div');
                        divider.style.paddingTop = '10px';
                        divider.innerHTML = `<b>${text}</b>`;
                        results_container.appendChild(divider);
                    }

                    if (artists.length > 0) {
                        addDivider('Artists');
                        
                        artists.forEach(function (artist) {
                            let artistDiv = document.createElement('div');
                            artistDiv.innerHTML = 'Artist: ' + highlight(artist.artist_display_name, keyword); // Highlight keyword

                            artistDiv.classList.add('search-result');
                            
                            artistDiv.onclick = function() {
                                window.location.href = base_url + 'profile/user/' + artist.username;
                            };
                            
                            artistDiv.style.cursor = 'pointer';  

                            results_container.appendChild(artistDiv);
                        });
                    }
                    
                    if (users.length > 0) {
                        addDivider('Users');
                        
                        users.forEach(function (user) {
                            let userDiv = document.createElement('div');
                            userDiv.innerHTML = 'User: ' + highlight(user.username, keyword); // Highlight keyword
                            
                            userDiv.classList.add('search-result');

                            userDiv.onclick = function() {
                                window.location.href = base_url + 'profile/user/' + user.username;
                            };
                            
                            userDiv.style.cursor = 'pointer';  
                            results_container.appendChild(userDiv);
                        });
                    }
                    
                    if (products.length > 0) {
                        addDivider('Products');
                        
                        products.forEach(function (product) {
                            let productDiv = document.createElement('div');
                            productDiv.innerHTML = 'Artwork: ' + highlight(product.title, keyword); // Highlight keyword
                            productDiv.classList.add('search-result');
                            results_container.appendChild(productDiv);
                        });
                    }

                    no_result.style.display = 'none';
                }
                
            } 
        };
            
        xhr.send('keyword=' + keyword);
       
    
    }
    
}

