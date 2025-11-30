<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $pageContents = PageContent::with('translations')
            ->where('page', 'contacts')
            ->get();
            
        $content = [];
        foreach ($pageContents as $pageContent) {
            $content[$pageContent->section] = $pageContent->content;
        }
            
        return view('web.contacts', compact('content'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);
        
        $contactRequest = ContactRequest::create($validated);
        
        // Send email notification
        try {
            $message = $contactRequest->message ?: 'Нет';
            
            Mail::raw(
                "Новая заявка с сайта:\n\n" .
                "Имя: {$contactRequest->name}\n" .
                "Контакты: {$contactRequest->contact}\n" .
                "Сообщение: {$message}\n",
                function ($mailMessage) {
                    $mailMessage->to(config('mail.from.address'))
                        ->subject('Новая заявка с сайта');
                }
            );
        } catch (\Exception $e) {
            Log::error('Failed to send contact email: ' . $e->getMessage());
        }
        
        // Send to Telegram if webhook is configured
        $this->sendToTelegram($contactRequest);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.'
            ]);
        }
        
        return back()->with('success', 'Спасибо! Ваше сообщение отправлено.');
    }
    
    private function sendToTelegram($contactRequest)
    {
        $webhook = config('services.telegram.webhook');
        if (!$webhook) {
            return;
        }
        
        $requestMessage = $contactRequest->message ?: 'Нет';
        
        $message = "📧 *Новая заявка с сайта*\n\n" .
            "👤 Имя: {$contactRequest->name}\n" .
            "📞 Контакты: {$contactRequest->contact}\n" .
            "💬 Сообщение: {$requestMessage}";
        
        try {
            file_get_contents($webhook . '?text=' . urlencode($message));
        } catch (\Exception $e) {
            Log::error('Failed to send to Telegram: ' . $e->getMessage());
        }
    }
}

