<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
       <script src="https://cdn.tailwindcss.com/3.4.16"></script>
       <style>
        .error {
            color: #e81818;
        }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none"> 
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
                            <p class="font-semibold">From</p>
                            <p>{{$ticket->customer_name}}({{$ticket->email}})</p>
                            </div>
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
                            <div id="result_section">
                            </div>
                            <!-- More log entries -->
                        </div>
                        <form action="{{route('reply')}}" id="reply_form" class="space-y-4 p-4 border rounded-md shadow-sm">
                            @csrf
                            <input name="support_ticket_id" value="{{$ticket->id}}" type="hidden">
                            <h3 class="text-lg font-medium">Leave a Reply</h3>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                                <textarea required id="message" name="comment" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Type your reply here..."></textarea>
                            </div>
                            <div>
                                <button type="button" id="submit-reply" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </body>
    <!-- Toastr -->
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
     <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
     <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation-1.16.0/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation-1.16.0/dist/additional-methods.min.js') }}"></script>
    
    <script>
        $(document).ready(function () {
            var reply_form = $('form#reply_form');
            $(document).on('click', 'button#submit-reply', function (e) {

                e.preventDefault();
                
                if ($('form#reply_form').valid()) {
                    var data = $('form#reply_form').serialize();
                    var url = $('form#reply_form').attr('action');
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: data,
                        dataType: "html",
                        success: function (result) {
                            if (result != '') {
                                $('#result_section').html(result);
                                resetForm();
                            }
                        }
                    });
                }
            });
            function resetForm()
            {
                reply_form[0].reset();
            }
        });
    </script>
</html>
