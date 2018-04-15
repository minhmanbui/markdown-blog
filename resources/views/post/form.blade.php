<form method='POST'>
    <div class="form-group">
        <label for="post-title">Title</label>
        <input type="text" class="form-control" id="post-title" name='title' placeholder="Title">
    </div>

    <div>
        <label for="post-title">Content</label>
        <textarea id="post-content" name='content' style="display: none;"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type='submit' value='Submit'/>
</form>

@section('javascript')
<script type='text/javascript'>
    $(document).ready(function() {
        new SimpleMDE({
            element: document.getElementById("post-content"),
            spellChecker: false,
            hideIcons: ['guide', 'side-by-side', 'fullscreen']
        });
    });

</script>
@endsection
