<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function showForm()
    {
        return view('pages.contact');
    }

    public function submitForm(Request $request)
    {
        // Validate the form
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Prepare the data to save
        $data = "Submitted at: " . now()->toDateTimeString() . "\n";
        $data .= "Name: " . $validated['name'] . "\n";
        $data .= "Email: " . $validated['email'] . "\n";
        $data .= "Message: " . $validated['message'] . "\n";
        $data .= str_repeat("-", 50) . "\n\n";

        // Append to submissions.txt (creates the file automatically)
        Storage::disk('local')->append('submissions.txt', $data);

        return redirect()->route('contact')
            ->with('success', 'Form submitted successfully! Thank you for contacting us.');
    }
}
