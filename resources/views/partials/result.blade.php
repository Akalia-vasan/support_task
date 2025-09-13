<div class="container mx-auto p-4 print:p-0">

      <h1 class="text-2xl font-bold mb-4 print:text-xl">Support Ticket {{$ticket->ref_no}}</h1>
      @php
        $status = 'New';
        if($ticket->status == 1)
        {
            $status = 'Opened';
        }
        elseif($ticket->status == 2)
        {
            $status = 'Replied';
        }
        elseif($ticket->status == 3)
        {
            $status = 'Closed';
        }

      @endphp

      <div class="grid grid-cols-2 gap-4 mb-6 print:grid-cols-1 print:gap-2">
        <div>
          <p class="font-semibold">Status:</p>
          <p>{{$status}}</p>
        </div>
        <!-- More ticket details -->
      </div>

      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2 print:text-lg">Issue Description</h2>
        <p class="text-gray-700">{{$ticket->problem_description}}</p>
      </div>

      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2 print:text-lg">Replies</h2>
        @foreach($ticket->comments ?? [] as $comment)
        <div class="border-t border-gray-200 pt-4">
            <p class="font-semibold">{{$comment->agent->name ?? ''}} ({{$comment->created_at}}):</p>
            <p>{{$comment->comment ?? ''}}</p>
        </div>
        @endforeach
        <!-- More log entries -->
      </div>
  </div>