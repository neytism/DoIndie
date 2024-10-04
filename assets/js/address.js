var base_url = '';
const province_select = document.getElementById('province_id');
const city_select = document.getElementById('city_id');
const brgy_select = document.getElementById('brgy_id');

function checkRegion(select_region){

    var xhr = new XMLHttpRequest();

        xhr.open('POST', base_url + 'profile/checkRegion/'+select_region.value , true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload  = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {

                province_select.innerHTML = `<option value="">
                    ---Select Province---
                </option>`;
                
                const response = xhr.responseText;

                console.log(response);

                let [result, message] = response.split("|");
    
                if(result === 'null'){
                    
                
                }else{

                    let results_serialized = JSON.parse(message);

                    let provinces = results_serialized;
                    
                    provinces.forEach(function (province) {
                        let opt = document.createElement('option');
                        opt.value = province.provCode;
                        opt.innerHTML = province.provDesc;
                        province_select.appendChild(opt);
                    });
                }
                
            } 
        };
            
        xhr.send();
}

function checkProvince(select_province){

    var xhr = new XMLHttpRequest();

        xhr.open('POST', base_url + 'profile/checkProvince/'+select_province.value , true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload  = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {

                city_select.innerHTML = `<option value="">
                    ---Select City---
                </option>`;
                
                const response = xhr.responseText;

                console.log(response);

                let [result, message] = response.split("|");

                if(result === 'null'){
                    

                
                }else{

                    //if(message.trim()== '') return;

                    let results_serialized = [];

                    try {
                        results_serialized = JSON.parse(message);
                    } catch (e) {
                        console.error("JSON parsing error:", e);
                    }

                    let cities = results_serialized;
                    
                    cities.forEach(function (city) {
                        let opt = document.createElement('option');
                        opt.value = city.citymunCode;
                        opt.innerHTML = city.citymunDesc;
                        city_select.appendChild(opt);
                    });
                }
                
            } 
        };
            
        xhr.send();
}

function checkCity(select_city){

    var xhr = new XMLHttpRequest();

        xhr.open('POST', base_url + 'profile/checkCity/'+select_city.value , true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload  = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {

                brgy_select.innerHTML = `<option value="">
                    ---Select Barangay---
                </option>`;
                
                const response = xhr.responseText;

                console.log(response);

                let [result, message] = response.split("|");
                
    
                if(result === 'null'){
                    
                
                }else{

                    //if(message.trim()== '') return;

                    let results_serialized = JSON.parse(message);

                    let brgys = results_serialized;
                    
                    brgys.forEach(function (brgy) {
                        let opt = document.createElement('option');
                        opt.value = brgy.brgyCode;
                        opt.innerHTML = brgy.brgyDesc;
                        brgy_select.appendChild(opt);
                    });
                }
                
            } 
        };
            
        xhr.send();
}

function setBaseUrl(url){
    base_url = url;
}