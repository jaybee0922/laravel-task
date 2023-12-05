<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DTR Webpage | Add Data Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/css/app.css" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>
    <div class="container">
        <div class="dtr-title">
            <h1>DTR Webpage</h1>
        </div>

        {{-- Logs Creation Modal Hidden --}}
        <button class="btn btn-primary" onclick="openModal()">Add - Via Modal </button>
        <a href="#" onclick="importModal()" class="btn btn-success">Import - Via Excel</a>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-title">
                    <h1>Add Data Logs</h1>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <form action="{{ route('insertLog') }}" method="post">
                    @csrf
                    @method('post')
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required />
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required />
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required />
                    <button class="btn btn-primary" type="submit">Add</button>
                    <button class="btn btn-primary close" onclick="closeModal()" type="submit">
                        Cancel
                    </button>
                </form>
            </div>
        </div>


        {{-- Import modal for excel --}}
        <div class="container">
            <div id="importModal" class="modal">
                <div class="modal-content import">
                    <div class="modal-title">
                        <h1>Import File</h1>
                    </div>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('importLog') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('get')
                        <div class="form-group">
                            <label for="file">Choose Excel File</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                        <a class="btn btn-primary" href="{{ route('log') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        {{-- catch sessions messages starts --}}
        @if (session()->has('success'))
            <h4 class="success-message">
                " {!! session('success') !!} "
            </h4>
        @endif
        @if (session()->has('deleted'))
            <h4 class="delete-message">
                " {!! session('deleted') !!} "
            </h4>
        @endif
        {{-- catch sessions messages ends --}}

        <div class="main-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $num = 1;
                    @endphp
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $num++ }}</td>
                            <td>
                                {{ $log->name }}
                                <a href="{{ route('editLog', ['log' => $log]) }}">
                                    <i class="fas fa-pencil-alt pointer-cursor"></i></a>
                            </td>
                            <td>
                                {{ $log->time }}
                                <a href="{{ route('editLog', ['log' => $log]) }}"><i
                                        class="fas fa-pencil-alt pointer-cursor"></i></a>
                            </td>
                            <td>
                                {{ $log->date }}
                                <a href="{{ route('editLog', ['log' => $log]) }}"><i
                                        class="fas fa-pencil-alt pointer-cursor"></i>
                                </a>
                            </td>
                            <th>
                                <form action="{{ route('trashLog', ['log' => $log]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                        <i class="fas fa-trash pointer-cursor"></i>
                                    </button>
                                </form>

                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 1rem;font-size:1.1rem;color:#999;">--
                                No
                                records found --</td>
                        </tr>
                    @endforelse
                </thead>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        const openModal = () => {
            document.querySelector("#myModal").style.display = "block";
        };

        const closeModal = () => {
            document.querySelector("#myModal").style.display = "none";
        };
    </script>
</body>

</html>
