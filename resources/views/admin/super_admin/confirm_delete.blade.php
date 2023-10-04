<!-- Delete Modal here -->
<div id="myProductModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">  
        <h4 class="modal-title">Are you sure?</h4>  
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <form method="post" action="" id="deleteProductForm">
        @csrf
        {{ method_field('DELETE') }}
        <div class="modal-body">
          <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>                 
<!-- Delete Modal End here -->