

<!-- Button to trigger modal -->
<a href="#" data-toggle="modal" data-target="#editIpBlockModal{{ $ipBlock->id }}">Edit</a>

<!-- Modal -->
<div class="modal fade" id="editIpBlockModal{{ $ipBlock->id }}" tabindex="-1" role="dialog" aria-labelledby="editIpBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIpBlockModalLabel">Edit IP Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.ipblock.update', ['id' => $ipBlock->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="ip_address">IP Address</label>
                        <input type="text" class="form-control" id="ip_address" name="ip_address" value="{{ $ipBlock->ip_address }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required>{{ $ipBlock->reason }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
