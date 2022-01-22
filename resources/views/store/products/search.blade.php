<form class="card-body align-items-center" action="/store/product" method="GET" autocomplete="off" role="search">
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <input type="text" class="form-control" name="searchName" placeholder="{{__('search_products_name')}}" value="{{ $searchName }}">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="searchDescription" placeholder="{{__('search_products_description')}}" value="{{ $searchDescription }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="rangeMinPrice" class="form-label">{{__('search_products_range_price_min')}}</label>
            <input type="range" class="form-range" min="0" max="1000000" id="rangeMinPrice" name="searchRangeMin" value="{{ $searchRangeMin }}">
            <p>{{__('search_products_value_price')}}: <span id="valueMinPrice"></span></p>
        </div>
        <div class="col-6">
            <label for="rangeMaxPrice" class="form-label">{{__('search_products_range_price_max')}}</label>
            <input type="range" class="form-range" min="0" max="1000000" id="rangeMaxPrice" name="searchRangeMax" value="{{ $searchRangeMax }}">
            <p>{{__('search_products_value_price')}}: <span id="valueMaxPrice"></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">{{__('search_find_button')}}</button>
        </div>
    </div>
</form>
<script>
    const sliderMin = document.getElementById("rangeMinPrice");
    const sliderMax = document.getElementById("rangeMaxPrice");
    const outputMin = document.getElementById("valueMinPrice");
    const outputMax = document.getElementById("valueMaxPrice");

    outputMin.innerHTML = sliderMin.value;

    sliderMin.oninput = function() {
        outputMin.innerHTML = this.value;
    }

    outputMax.innerHTML = sliderMax.value;

    sliderMax.oninput = function() {
        outputMax.innerHTML = this.value;
    }
</script>
