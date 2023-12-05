<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DTR Webpage | Edit Data Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('css/editLogs.css') }}" />
</head>

<body>
    <div class="container">
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-title">
                    <h1>Edit Logs</h1>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <form action="{{ route('updatelog', ['log' => $log]) }}" method="post">
                    @csrf @method('put')
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $log->name }}" />
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" value="{{ $log->time }}" />
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="{{ $log->date }}" />
                    <input href="#" class="btn btn-primary" type="submit" value="Update">
                    <a class="btn btn-primary" href="{{ route('log') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
