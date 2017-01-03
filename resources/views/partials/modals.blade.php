<!-- are you sure to logout -->
<div class="modal fade logout-modal z-depth-3" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">logout</h4>
      </div>
      <div class="modal-body">
        <p class="text-center"><i class="fa fa-exclamation-circle"></i> Are you sure?, if u haven't saved your work yet, it will be lost</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="{{ route('logout.success') }}" class="btn btn-danger">yes <i class="fa fa-times"></i></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

