<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return view('file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Faylni tekshirish
        $request->validate([
            'file' => 'required|file|mimes:txt|max:2048',
        ]);

        // 2. Faylni saqlash
        $uploadedFile = $request->file('file');
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName(); // unique name
        $filePath = $uploadedFile->storeAs('uploads', $fileName, 'public');
        $fileName = $request->name;

        // 3. Ma’lumotni bazaga yozish
        File::create([
            'name' => $fileName,
            'path' => $filePath,
        ]);

        // 4. Orqaga redirect qilish
        return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
    }

    public function check(Request $request)
    {
        $file = File::findOrFail($request->id);
        $text = $request->text;
        $filePath = storage_path('app/public/' . $file->path);
        preg_match_all('/(\d+)\.\s(.+?)(?=(\d+\.\s)|\z)/s', $text, $matches, PREG_SET_ORDER);

        $questions = [];

        foreach ($matches as $match) {
            $fullText = trim($match[2]);
            $lines = explode("\n", $fullText);

            $question = array_shift($lines); // birinchi qatorda savol bo'ladi
            $options = array_map('trim', $lines); // qolganlari variantlar

            $questions[] = [
                'question' => $question,
                'options' => $options
            ];
        }

        // Natijani chiqaramiz
        echo "<pre>";
        print_r($questions);
        echo "</pre>";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::findOrFail($id);
        return response()->file(storage_path('app/public/' . $file->path));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('file.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::findOrFail($id);

        // Faylni storage'dan o‘chiramiz
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        // Bazadan o‘chiramiz
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully!');
    }
}
