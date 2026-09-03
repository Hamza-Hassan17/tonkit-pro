<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        // PKWebHost shared hosting note: PHP mail() often gets flagged as spam or
        // blocked outright. Use SMTP (e.g. your own domain email via cPanel, or
        // Mailgun/SendGrid) in .env — set MAIL_MAILER=smtp and the MAIL_HOST /
        // MAIL_USERNAME / MAIL_PASSWORD from cPanel's Email Accounts section.
        Mail::raw(
            "Name: {$validated['name']}\nEmail: {$validated['email']}\nPhone: {$validated['phone']}\n\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail->to(config('mail.from.address'))
                    ->subject('New Contact Form Submission — TonKit.Pro')
                    ->replyTo($validated['email'], $validated['name']);
            }
        );

        return back()->with('success', 'Thanks — we\'ve received your message and will get back to you shortly.');
    }
}
