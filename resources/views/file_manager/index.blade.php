<!-- resources/views/file_manager/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="mt-3 mb-3">
                    <h3>Create Folder</h3>
                    <form action="/file-manager/folder" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="folder_name">Folder Name:</label>
                        <input type="text" id="folder_name" name="folder_name" placeholder="Folder name.."
                            class="form-control d-block mb-2" required>
                        <button type="submit" class="btn btn-primary">Create Folder</button>
                        <a href="{{ url('/') }}" class="btn btn-primary">Back</a>

                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Folders</h2>
                @foreach ($folders as $folder)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $folder->name }}</h5>
                            <p class="card-text">
                                <a href="{{ route('show.folder', ['folderPath' => $folder->path])}}" class="btn btn-primary">Open</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
