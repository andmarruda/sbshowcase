const filter_cities = (cities, state_id) => cities.filter(city => city.state_id == state_id).sort((a, b) => a.city_name.localeCompare(b.city_name));
const cities_options = (cities, state_id) => filter_cities(cities, state_id).map(city => `<option value="${city.city_id}">${city.city_name}</option>`).join('');

const load_cities = (target, cities_id, cities) => {
    let cb = document.getElementById(cities_id);
    if(!(target instanceof HTMLSelectElement) || !(cb instanceof HTMLSelectElement))
        return;
    
    let copts = cities_options(cities, target.value);
    if(cities_options.length == 0){
        cb.innerHTML = '<option value="">Nenhuma cidade cadastrada</option>';
        return;
    }
    cb.innerHTML = '<option value="">Selecione...</option>' + copts;
}

const searchCep = async (cep) => {
    let url = 'https://viacep.com.br/ws/'+ cep +'/json/';
    let f = await fetch(url);
    let j = await f.json();
    if(j.erro)
        return j;

    j['uf'] = j.ibge.substr(0, 2);
    return j;
}

const checkCep = (cep) => /^[0-9]{5}-[0-9]{3}$/.test(cep);

const move_scroll = (element_id) => {
    let element = document.getElementById(element_id);
    let newPosition = element.offsetTop + element.offsetHeight;
    window.scrollTo(0, newPosition);
};

const cepEvent = async (event, cep_error_id, city_error_id, fields, cities) => {
    document.getElementById(cep_error_id).style.display='none';
    document.getElementById(city_error_id).style.display='none';

    if(!checkCep(event.target.value)){
        document.getElementById(cep_error_id).style.display='block';
        move_scroll(cep_error_id);
        event.target.value = '';
        return;
    }

    let j = await searchCep(event.target.value);
    if(j.erro){
        document.getElementById(city_error_id).style.display='block';
        move_scroll(city_error_id);
        return;
    }

    let state = document.getElementById(fields['state']);
    state.value = j.uf;
    load_cities(state, fields['city'], cities);

    let city = document.getElementById(fields['city']);
    city.value = j.ibge;

    if(state.value != j.uf || city.value != j.ibge){
        document.getElementById(city_error_id).style.display='block';
        move_scroll(city_error_id);
        return;
    }

    document.getElementById(fields['number']).focus();
    document.getElementById(fields['address']).value = j.logradouro;
    document.getElementById(fields['neighborhood']).value = j.bairro;
    document.getElementById(fields['complement']).value = j.complemento;
};