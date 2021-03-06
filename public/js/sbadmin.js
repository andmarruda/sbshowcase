const genFormData = (form) => {
    let fd = new FormData(form);
    return fd;
}

const jsSearchModal = async (route) => {
    let form = document.getElementById('formModalSearch');
    let grid = document.getElementById('gridSearch');
    grid.querySelector('TBODY').innerHTML = '';

    let fd = genFormData(form);
    let f = await fetch(route, {
        method: 'POST',
        body: fd
    });

    let j = await f.json();
    for(let i of j){
        grid.querySelector('TBODY').innerHTML += '<tr>\
            <td>'+i.id+'</td>\
            <td>'+i.name+'</td>\
            <td>'+(i.deleted_at===null ? 'Não' : 'Sim')+'</td>\
        </tr>';
    }
};

const loadDataForm = (event, route) => {
    let line = event.target.tagName=='TR' ? event.target : event.target.closest('TR');
    let id = line.children[0].innerText;
    location.href = route + '/' + id;
};