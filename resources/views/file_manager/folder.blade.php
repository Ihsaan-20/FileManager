

@extends('layouts.app')

@section('content')
    <h2>Folder: {{ $folderPath }}</h2>

    <div>
        <h3>Files</h3>
        @foreach ($files as $file)
            <p>{{ $file }}</p>
        @endforeach
    </div>

    <div>
        <h3>Folders</h3>
        @foreach ($folders as $folder)
            <p>{{ $folder }}</p>
        @endforeach
    </div>

    <div>
        <h3>Upload File</h3>
        <form action="/file-manager/folder/{{ $folderPath }}/upload" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="folder_id" value="">
            <label for="file">Choose file:</label>
            <input type="file" name="file_name" required>
            <button type="submit">Upload File</button>
        </form>
    </div>
@endsection
