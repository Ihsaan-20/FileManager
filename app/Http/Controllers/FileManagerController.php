<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        $folders = Folder::get();
        // dd($folders);
        return view('file_manager.index', compact('folders'));
    }

    public function create()
    {
        return view('file_manager.create');
    }

    public function createFolder(Request $request)
    {

        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);

        $folderName = $request->input('folder_name');

        // Construct the path for the new folder (without including "folders/")
        $path = $folderName;

        // Check if the folder already exists
        if (Storage::exists($path)) {
            return redirect()->back()->with('error', 'Folder already exists.');
        }

        // Create the folder in the storage
        Storage::makeDirectory($path);

        // Save folder information to the database using the Folder model
        $folder = Folder::create([
            'name' => $folderName,
            'path' => $path,
            'type' => 'folder',
            'size' => 0,  // You can set it to 0 for folders
        ]);


        if($folder)
        {
            return redirect()->back()->with('success', 'Folder created successfully.');
        }else{
            return back()->with('error', 'failed!');
        }
    }

    public function showFolder($folderPath)
    {
        // dd($folderPath);
        $files = Storage::files($folderPath);
        $folders = Storage::directories($folderPath);
        return view('file_manager.folder', compact('files', 'folders', 'folderPath'));
    }

    public function uploadFile(Request $request, $folderPath)
    {
        $request->validate([
            'file_name' => 'required|mimes:pdf,doc,docx|max:10240', // Adjust the file types and size as needed
        ]);

        $file = $request->file('file_name');
        $fileName = $file->getClientOriginalName();

        // Upload the file to the specified folder
        Storage::putFileAs($folderPath, $file, $fileName);

        // Save file information to the database
        File::create([
            'file_name' => $fileName,
            'path' => $folderPath . '/' . $fileName,
            'type' => pathinfo($fileName, PATHINFO_EXTENSION), // Get the file extension
            'size' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function downloadFile($id)
    {
        // Logic to download a file
    }

    public function downloadZip()
    {
        // Logic to download a zip file
    }

    public function shareLink($id)
    {
        // Logic to generate and display a shareable link
    }
}
