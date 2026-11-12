<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Project</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        img {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Data Project</h2>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Gambar</th>
                <th width="20%">Title</th>
                <th width="15%">Teknologi</th>
                <th width="35%">Description</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $index => $project)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">
                    @if($project->image && file_exists(public_path('gambar/' . $project->image)))
                        <img src="{{ public_path('gambar/' . $project->image) }}" alt="{{ $project->title }}">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->teknologi }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>