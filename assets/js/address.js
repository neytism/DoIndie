function checkRegion(select_region, base_url){

    var xhr = new XMLHttpRequest();

        xhr.open('POST', base_url + 'profile/checkRegion/'+select_region.value , true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload  = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {

                const province_select = document.getElementById('province_id');

                province_select.innerHTML = `<option value="">
                    ---Select Province---
                </option>`;
                
                const response = xhr.responseText

                var [result, message] = response.split("|");
    
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