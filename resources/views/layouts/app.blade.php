<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            button:disabled {
                opacity: 50%;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
        <script>
            disableOnClick()
            disableOnSubmit()

            // Flash message
            let messages = document.querySelectorAll('.flash-message');

            messages.forEach(message => {
                setTimeout(function () {
                    message.parentNode.removeChild(message)
                }, 4000)
            })

            // Button - prevent multiple clicks
            function disableOnClick() {
                let btns = document.querySelectorAll('.disable-onClick')
            
                btns.forEach(btn => {
                    btn.addEventListener('click', e => {
                        btn.disabled = true
                    })    
                })
            }
            
            // Form - prevent multiple submits
            function disableOnSubmit() {
                let forms = document.querySelectorAll('.disable-onSubmit')

                forms.forEach(form => {
                    form.addEventListener('submit', e => {
                        e.preventDefault()
                        let btn = form.getElementsByTagName('button')[0]
                        // Disable button
                        btn.disabled = true
                        // Submit form
                        form.submit()
                    })
                })
            }
        </script>
    </body>
</html>
