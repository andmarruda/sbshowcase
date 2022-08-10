const filter_cities = (cities, state_id) => cities.filter(city => city.state_id == state_id).sort((a, b) => a.city_name.localeCompare(b.city_name));
const cities_options = (cities, state_id) => filter_cities(cities, state_id).map(city => `<option value="${city.city_id}">${city.city_name}</option>`).join('');

const load_cities = (event, cities_id, cities) => {
    let cb = document.getElementById(cities_id);
    if(!(event.target instanceof HTMLSelectElement) || !(cb instanceof HTMLSelectElement))
        return;
    
    let copts = cities_options(cities, event.target.value);
    if(cities_options.length == 0){
        cb.innerHTML = '<option value="">Nenhuma cidade cadastrada</option>';
        return;
    }
    cb.innerHTML = '<option value="">Selecione...</option>' + copts;
}