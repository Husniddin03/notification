<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enter text</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="{{ route('files.check') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Enter text</label>
                <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="20"></textarea>
            </div>
            <input type="text" name="id" id="id" value="{{ $id }}" hidden>
            <button class="btn btn-success">Ckeck</button>
        </form>
    </div>
</body>

</html>
