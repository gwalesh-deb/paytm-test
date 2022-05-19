<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Paytm Payment Gateway Integrate - Tutsmake.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
        rel="stylesheet">
    <style>
        .mt40 {
            margin-top: 40px;
        }

    </style>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-lg-12 mt40">
                <div class="card-header" style="background: #0275D8;">
                    <h2>Register for Event</h2>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Something went wrong<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment') }}" method="POST" name="paytm">
           @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Mobile Number</strong>
                        <input type="text" name="mobile_number" class="form-control"
                            placeholder="Enter Mobile Number">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Email Id</strong>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email id">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Event Fees</strong>
                        <input type="text" name="amount" class="form-control" placeholder="" value="100" readonly="">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>

</body>

</html>
