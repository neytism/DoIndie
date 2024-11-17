var base_url = '';
const province_select = document.getElementById('province_id');
const city_select = document.getElementById('city_id');
const brgy_select = document.getElementById('brgy_id');

function fetchData(url, selectElement, responseHandler) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = xhr.responseText;
            //console.log(response);
            let [result, message] = response.split("|");
            
            if (result !== 'null') {
                try {
                    let results_serialized = JSON.parse(message);
                    responseHandler(results_serialized, selectElement);
                } catch (e) {
                    console.error("JSON parsing error:", e);
                }
            }
        }
    };
    
    xhr.send();
}

function populateOptions(selectElement, items, valueKey, textKey, default_text) {
    selectElement.innerHTML = `<option value="">---Select ${default_text}---</option>`;
    
    items.forEach(function(item) {
        let opt = document.createElement('option');
        opt.value = item[valueKey];
        opt.innerHTML = item[textKey];
        selectElement.appendChild(opt);
    });
}

function checkRegion(select_region) {
    const url = base_url + 'profile/checkRegion/' + select_region.value;
    populateOptions(province_select, [], '', '', 'Province');
    populateOptions(city_select, [], '', '', 'City');
    populateOptions(brgy_select, [], '', '', 'Barangay');
    fetchData(url, province_select, (provinces) => populateOptions(province_select, provinces, 'provCode', 'provDesc', 'Province'));
    
}

function checkProvince(select_province) {
    const url = base_url + 'profile/checkProvince/' + select_province.value;
    populateOptions(city_select, [], '', '', 'City');
    populateOptions(brgy_select, [], '', '', 'Barangay');
    fetchData(url, city_select, (cities) => populateOptions(city_select, cities, 'citymunCode', 'citymunDesc', 'City'));
}

function checkCity(select_city) {
    const url = base_url + 'profile/checkCity/' + select_city.value;
    populateOptions(brgy_select, [], '', '', 'Barangay');
    fetchData(url, brgy_select, (brgys) => populateOptions(brgy_select, brgys, 'brgyCode', 'brgyDesc', 'Barangay'));
}

function setBaseUrl(url) {
    base_url = url;
}
