<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">Order Status</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
            <form action="{{ route('admin.multuOrderStatusUpdate')}}" method="POST" id="order_status_update_form">
      @csrf
      <div class="modal-body">
          
          <div class="div-group">
              <label>Status</label>
              <select class="form-control" name="status" id="multi_status" required>
                   @foreach($status as $key=>$s)
                   <option value="{{$key}}"> {{ $s}} </option>
                   @endforeach
              </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Submit</button>
      </div>
    </form>
						</div>
					
					</div>
				</div>