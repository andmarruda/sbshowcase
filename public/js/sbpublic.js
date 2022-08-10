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

const checkCpfCnpj = (event, cnpj_cpf_error) => {
    let container = document.getElementById(cnpj_cpf_error);
    container.style.display = 'none';

    if((event.target.length != 11 && event.target.length != 14) || /^(0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11})|(0{14}|1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14})|[^0-9]$/.test(event.target.value)){
        event.target.value = '';
        container.style.display = 'block';
        return;
    }
};

const checkCPF = (cpf) => {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf.length != 11 || /^(0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11})$/.test(cpf))
        return false;
    
    let init_dv1 = 10,
        init_dv2 = 11,
        sum_dv1 = cpf.substr(0,9).split('').reduce((prev, val) => Number(prev) + (Number(val) * init_dv1--), 0),
        sum_dv2 = cpf.substr(0,10).split('').reduce((prev, val) => Number(prev) + (Number(val) * init_dv2--), 0);

    return (sum_dv1 % 11 < 2 ? 0 : 11 - sum_dv1 % 11) == cpf.substr(9,1) && (sum_dv2 % 11 < 2 ? 0 : 11 - sum_dv2 % 11) == cpf.substr(10,1);
};

const checkCNPJ = (cnpj) => {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj.length != 14 || /^(0{14}|1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14})$/.test(cnpj))
        return false;
    
    let init_dv1 = 5,
        init_dv2 = 6,
        sum_dv1 = cnpj.substr(0,12).split('').reduce((prev, val) => Number(prev) + (Number(val) * init_dv1--), 0),
        sum_dv2 = cnpj.substr(0,13).split('').reduce((prev, val) => Number(prev) + (Number(val) * init_dv2--), 0);

    return (sum_dv1 % 11 < 2 ? 0 : 11 - sum_dv1 % 11) == cnpj.substr(12,1) && (sum_dv2 % 11 < 2 ? 0 : 11 - sum_dv2 % 11) == cnpj.substr(13,1);
};