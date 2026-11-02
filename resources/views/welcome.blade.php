<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>

    <link rel = "preconnect" href = "https://fonts.googleapis.com">
    <link rel = "preconnect" href = "https://fonts.gtstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel = "stylesheet" href="/css/app.css">
</head>
<body>
    <div class="payment-container">
        <h1 class="payment-title">Payment Form</h1>
    
        @if (session('success'))
            <div class="alert-success">
                {{session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors -> all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul> 
            </div>
        @endif

    <form action="{{ route('payments.store') }}" method = "POST">
        @csrf
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input
                
                type = "text"
                id = "full_name"
                name ="full_name"
                value= "{{ old('full_name') }}"
                placeholder="Type here your full name"
                required
                >
            </div>

            <div class="form-group">
                <label for="email">Email ID*</label>
                <input
                type = "email"
                id = "email"
                name = "email"
                value= "{{ old('email') }}"
                placeholder="Type here your email id"
                required
                >
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input
                    type = "tel"
                    id = "phone_number"
                    name = "phone_number"
                    value= "{{ old('phone_number') }}"
                    placeholder="Type here your phone number"
                    inputmode="numeric"
                    pattern="[0-9]{9,15}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required
                >
            </div>

            <div class="form-group">
                <label for="amount_donation">Amount donation</label>
                <input
                    type = "number"
                    id = "amount_donation"
                    name = "amount_donation"
                    value= "{{ old('amount_donation') }}"
                    placeholder="13456789"
                    min="1"
                    step = "any"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                    required
                >
            </div>

        <button type="submit" class="btn-payment">Make a payment now</button>

    </form>
    </div>
</body>
</html>