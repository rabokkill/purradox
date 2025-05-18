<!-- Success Modal -->
@if(session()->has('message'))
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="feedbackModalLabel">Notice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <p>{{ session('message') }}</p>
    </div>
    </div>
</div>
</div>
@endif
<!-- Error Modal -->
@if ($errors->any())
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="feedbackModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        </ul>
    </div>
    </div>
</div>
</div>
@endif