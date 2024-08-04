<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Process the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the message to the database
        $contactMessage = ContactMessage::create($validatedData);

        // Send an email notification
        Mail::to(config('mail.admin_email'))->send(new ContactFormSubmitted($contactMessage));

        // Optionally, send an auto-reply to the user
        // Mail::to($validatedData['email'])->send(new ContactFormAutoReply($contactMessage));

        return redirect()->route('contact')->with('success', 'Pesan Anda telah terkirim. Terima kasih telah menghubungi kami.');
    }
}
