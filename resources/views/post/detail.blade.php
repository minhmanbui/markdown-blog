<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title post-title">{{$post->getTitle()}}</h4>
            <p class='post-date'>{{$post->getCreatedDate()->format('M, d Y')}}</p>
        </div>
        <div class="modal-body post-content">
            @markdown($post->getContent())
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

