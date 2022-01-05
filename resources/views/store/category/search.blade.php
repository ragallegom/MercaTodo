<form class="card-body" action="/store/category" method="GET" autocomplete="off" role="search">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="searchText" placeholder="{{__('search_find')}}" value="{{$searchText}}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">{{__('search_find_button')}}</button>
            </span>
        </div>
    </div>
</form>
