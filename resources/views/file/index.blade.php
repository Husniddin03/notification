<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Material Design Responsive Table</title>
    <style>
        body {
            margin: 0;
            font-family: "Roboto", sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        thead {
            background-color: #f0f0f0;
        }

        th,
        td {
            text-align: left;
            padding: 16px;
        }

        th {
            font-weight: 500;
            color: #555;
        }

        td a {
            color: #3f51b5;
            text-decoration: none;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #e0e0e0;
        }

        .button {
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-bottom: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 20px;
                background: white;
                padding: 15px;
                border-radius: 6px;
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            }

            td {
                padding: 10px 0;
                text-align: right;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 16px;
                font-weight: bold;
                text-align: left;
                color: #888;
            }
        }
    </style>
</head>

<body>

    @if (session('success'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif


    <h1>Material Design Responsive Table</h1>
    <p>Table of my other Material Design works (list was updated 08.2015)</p>

    <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" class="button" name="file" id="file" accept=".txt">
        <input type="text" class="button" name="name" id="name" placeholder="File Name">
        <button type="submit" class="button">Upload</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Link</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td data-label="ID">{{ $file->id }}</td>
                    <td data-label="Name">{{ $file->name }}</td>
                    <td data-label="Link">
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank">Download</a>
                    </td>
                    <td data-label="Status">Uploaded</td>
                    <td data-label="Actions">
                        <a href="{{ route('files.edit', $file->id) }}" class="button"
                            style="background-color: #2196F3;">Answer</a>
                        <a href="{{ route('files.show', $file->id) }}" class="button"
                            style="background-color: #4caf50;">View</a>

                        <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" onclick="return confirm('Are you sure?')"
                                style="background-color: #f44336;">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>
