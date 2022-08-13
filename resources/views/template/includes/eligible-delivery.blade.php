<div class="modal fade" id="eligible_delivery" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cidades elegíveis - Frete Grátis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-floating" style="margin-bottom:2rem;" autocomplete="off">
                    <input type="text" list="eligibleAvailableCitiesList" class="form-control" id="eligible_city_name" placeholder="Cidade" value="">
                    <label for="eligible_city_name">Cidade</label>

                    <datalist id="eligibleAvailableCitiesList"></datalist>
                </form>
                <table class="table table-bordered table-striped" id="tableAvailableCities">
                    <thead>
                        <tr>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody><tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const availableCities = @json($eligible);
    var inputInterval;

    const generatesAvailableList = (cities) => {
        let datalist = '';
        for(let city of cities) {
            datalist += `<option value="${city.city.city_name} - ${city.city.state.state_name}">`;
        }

        document.getElementById('eligibleAvailableCitiesList').innerHTML = datalist;
    }

    const generateAvailableTable = (cities) => {
        let html = '';

        for(let city of cities) {
            html += `<tr>
                <td style="text-align:left;">${city.city.city_name}</td>
                <td>${city.city.state.state_name}</td>
                <td style="font-weight:bold;">${city.price == '0' ? 'Grátis' : city.price}</td>
            </tr>`;
        }

        document.getElementById('tableAvailableCities').querySelector('tbody').innerHTML = html;
    };

    const filterAvailableCities = (value) => {
        let cities = availableCities.filter((val) => {
            let label = val.city.city_name + ' - ' + val.city.state.state_name;
            return label.indexOf(value) >= 0;
        }).sort((a,b) => a.city.city_name>=b.city.city_name);
        generateAvailableTable(cities);
    }

    document.addEventListener('DOMContentLoaded', () => {
        let cities = availableCities.sort((a,b) => a.city.city_name>=b.city.city_name);
        generateAvailableTable(cities);
        generatesAvailableList(cities);

        document.getElementById('eligible_delivery').addEventListener('hidden.bs.modal', function (event) {
            event.target.querySelector('.form-floating').reset();
            generateAvailableTable(cities);
        });

        document.getElementById('eligible_city_name').addEventListener('input', function (event) {
            clearInterval(inputInterval) || null;
            filterAvailableCities(event.target.value);
        });

        document.getElementById('eligible_city_name').addEventListener('keyup', (event) => {
            let value = event.target.value;
            if(value==''){
                generatesAvailableList(cities);
                return;
            }

            clearInterval(inputInterval) || null;
            inputInterval = setInterval(() => {
                filterAvailableCities(value);
            }, 700);
        });
    });
</script>