<?php
namespace App\Services;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactService {

    public function contactFormSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:6000',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $data = [
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'subject' => $validated['subject'] ,
            'message' => $validated['message'],
        ];

        $adminEmail = config('app.default_email');
        if (empty($adminEmail)) {
            Log::error('Admin email is not set in the configuration.');
            return false;
        }
        try {
            // Mail::to($adminEmail)->send(new ContactMail($data));
            Mail::to($adminEmail)->queue(new ContactMail($data));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it)
            Log::error('Contact form submission failed: ' . $e);
            return false;
        }

        return true;
    }

}