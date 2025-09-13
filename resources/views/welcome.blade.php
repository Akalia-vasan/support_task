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
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>
                        <a
                            href="{{ route('search') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Search
                        </a>
                    @endauth
                </nav>
            @endif
        </header>
        
            <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
                <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                    <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                        <h1 class="flex items-center justify-center text-xl font-extrabold">Request Support Team</h1>
                        <form method="POST" action="{{route('ticket.store')}}" id="add_ticket_form">
                        @csrf
                            <div class="mb-6">
                                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer Name</label>
                                <input type="text" name="customer_name" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CUSTOMER NAME" value="{{ old('customer_name') ?? ''}}" required>
                            </div>
                            <div class="mb-6">
                                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Problem</label>
                                <textarea name="problem_description" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="PROBLEM DESCRIPTION"  required>{{old('problem_description') ?? ''}}</textarea>
                            </div>
                            <div class="mb-6">
                                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="text" name="email" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="EMAIL" value="{{ old('email') ?? ''}}"  required>
                            </div>
                            <div class="mb-6">
                                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact No.</label>
                                <input type="text" name="phone" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="PHONE NO." value="{{ old('phone') ?? ''}}"  required>
                            </div>
                            <button type="button" id="submit_form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SUBMIT</button>
                        </form>
                    </div>
                </main>
            </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
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
            var ticket_form = $('form#add_ticket_form');
            $(document).on('click', 'button#submit_form', function (e) {

                e.preventDefault();
                $('form#add_ticket_form').validate({
                    rules: {
                        customer_name: {
                            required: true,
                            minlength: 3,
                            maxlength: 150

                        },
                        problem_description: {
                            required: true,
                            minlength: 10
                        },
                        email: {
                            required: true,
                            email: true,
                            maxlength: 200
                        },
                        phone: {
                            required: true,
                            digits: true,
                            minlength: 10,
                            maxlength: 12
                        }
                        
                    },
                    messages: {
                        customer_name: {
                            required:'The name is required.',
                            minlength:'Customer name must be at least 3 characters.',
                            maxlength:'Customer name may not be greater than 150 characters.',
                        },
                        problem_description: {
                            required:'The Problem Description is required.',
                            minlength:'The Problem Description must be at least 10 characters.',
                        },
                        email: {
                            required:'The email is required.',
                            email:'Please enter a valid email address.',
                            maxlength:'The email not be greater than 200 characters',
                        },
                        phone: {
                            digits: 'Please enter digits Only',
                            required: 'The contact no is required.',
                            minlength: 'Contact no must be at least 10 characters.',
                            maxlength: 'Contact no not be greater than 12 characters.',
                        }
                    }
                });
                if ($('form#add_ticket_form').valid()) {
                    var data = $('form#add_ticket_form').serialize();
                    var url = $('form#add_ticket_form').attr('action');
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function (result) {
                            if (result.success == 1) {
                                resetForm();
                                toastr.success(result.msg);

                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });

            function resetForm()
            {
                ticket_form[0].reset();
            }
        });
    </script>
</html>
