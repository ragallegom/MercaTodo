<div class="modal fade  modal-slide-in-right"
     aria-hidden="true"
     role="dialog"
     tabindex="-1"
     id="modal-delete-{{ $category->id }}">
    <form class="card-body" action="{{ route('category.delete', $category->id) }}" method="POST" autocomplete="off">
        @method('DELETE')
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('category_delete_title')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('category_delete_body')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('category_delete_close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('category_delete_confirm')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
