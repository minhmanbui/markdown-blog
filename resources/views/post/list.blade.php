@if (count($posts))
<table class='table'>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr class='post-item post-item-{{$post->getId()}}' data-id="{{$post->getId()}}">
            <td>{{$post->getKey()}} - {{$post->getTitle()}}</td>
            <td>{{$post->getCreater()->getName()}}</td>
            <td>{{$post->getCreatedDate()}}</td>
            <td>
                @if ($post->getModifiedDate())
                    {{$post->getModifiedDate()}}
                @endif
            </td>
            <td>
                <button class='js-read-post btn' data-url="{{ route('post-detail', ['post_id' => $post->getId()]) }}">Read</button>
                @if (Auth::check() && Auth::user()->isAdmin())
                    @if (!$post->isApproved())
                    <button class='js-approve-post btn' data-url="{{ route('approve-post', ['post_id' => $post->getId()]) }}">Approve</button>
                    @endif

                    <button class='js-remove-post btn' data-url="{{ route('remove-post', ['post_id' => $post->getId()]) }}">Remove</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

@else
<h2>We not yet have any post yet.</h2>
@endif

@section('modal')
<div id="post-modal" class="modal" role="dialog">
</div>
@endsection
