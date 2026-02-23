<x-layouts.app>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact us</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1550px; margin: 50px auto; }
        label { display: block; margin: 15px 0 5px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; }
        button { padding: 12px 20px; background: #777777; color: white; border: none; cursor: pointer; }
        .success { color: rgb(255, 152, 217); font-weight: bold; }
    </style>
</head>
<body>
@if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <h1>Contact us here!</h1>

        <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Message</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit">Submit</button>
    </form>
</body>
</html>


















</x-layouts.app>
