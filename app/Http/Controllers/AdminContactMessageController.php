<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the contact messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read when viewed
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Remove the specified contact message from storage.
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Mesaj başarıyla silindi.');
    }

    /**
     * Mark message as read/unread
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function toggleRead(ContactMessage $contactMessage)
    {
        $contactMessage->update([
            'is_read' => !$contactMessage->is_read
        ]);
        
        return redirect()->back()->with('success', 
            $contactMessage->is_read ? 'Mesaj okundu olarak işaretlendi.' : 'Mesaj okunmadı olarak işaretlendi.');
    }
    
    /**
     * Show form to reply to a contact message
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function showReplyForm(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.reply', compact('contactMessage'));
    }
    
    /**
     * Send a reply to a contact message
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function sendReply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);
        
        try {
            // Send email
            Mail::to($contactMessage->email)
                ->send(new ContactReplyMail($contactMessage, $validated['message']));
            
            // Mark as read
            if (!$contactMessage->is_read) {
                $contactMessage->update(['is_read' => true]);
            }
            
            return redirect()->route('admin.contact-messages.show', $contactMessage)
                ->with('success', 'Yanıt başarıyla gönderildi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'E-posta gönderilirken bir hata oluştu: ' . $e->getMessage())
                ->withInput();
        }
    }
}
