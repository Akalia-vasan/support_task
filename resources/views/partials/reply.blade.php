<div class="border-t border-gray-200 pt-4">
    <p class="font-semibold">{{$comment->agent->name ?? ''}} ({{$comment->created_at}}):</p>
    <p>{{$comment->comment ?? ''}}</p>
</div>