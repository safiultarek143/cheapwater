<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
        data-target="#modal-{{ $id }}">
    <i class="fa fa-trash"></i>
</button>

<div class="modal fade" id="modal-{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete Confirmation?</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ $url }}" method="post">
                @csrf @method('delete')
                <div class="modal-body">
                    <p>{{ isset($message) ? $message : 'Are you sure want to delete this?' }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        No
                    </button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>