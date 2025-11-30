<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DeveloperTask;
use App\Models\DeveloperApplication;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DeveloperController extends Controller
{
    public function index()
    {
        $tasks = DeveloperTask::with('translations')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $pageContents = PageContent::with('translations')
            ->where('page', 'developers')
            ->get();
            
        $content = [];
        foreach ($pageContents as $pageContent) {
            $content[$pageContent->section] = $pageContent->content;
        }
            
        return view('web.developers', compact('tasks', 'content'));
    }
    
    public function apply(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'stack' => 'nullable|string|max:255',
            'github' => 'nullable|url|max:255',
            'portfolio' => 'nullable|url|max:255',
            'message' => 'nullable|string',
        ]);
        
        $application = DeveloperApplication::create($validated);
        
        // Send email notification
        try {
            $stack = $application->stack ?: 'Не указан';
            $github = $application->github ?: 'Не указан';
            $portfolio = $application->portfolio ?: 'Не указан';
            $message = $application->message ?: 'Нет';
            
            Mail::raw(
                "Новая заявка от разработчика:\n\n" .
                "Имя: {$application->name}\n" .
                "Контакты: {$application->contact}\n" .
                "Стек: {$stack}\n" .
                "GitHub: {$github}\n" .
                "Портфолио: {$portfolio}\n" .
                "Сообщение: {$message}\n",
                function ($mailMessage) {
                    $mailMessage->to(config('mail.from.address'))
                        ->subject('Новая заявка от разработчика');
                }
            );
        } catch (\Exception $e) {
            Log::error('Failed to send developer application email: ' . $e->getMessage());
        }
        
        // Send to Telegram if webhook is configured
        $this->sendToTelegram($application);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.'
            ]);
        }
        
        return back()->with('success', 'Спасибо! Ваша заявка отправлена.');
    }
    
    private function sendToTelegram($application)
    {
        $webhook = config('services.telegram.webhook');
        if (!$webhook) {
            return;
        }
        
        $stack = $application->stack ?: 'Не указан';
        $github = $application->github ?: 'Не указан';
        $portfolio = $application->portfolio ?: 'Не указан';
        $appMessage = $application->message ?: 'Нет';
        
        $message = "🔧 *Новая заявка от разработчика*\n\n" .
            "👤 Имя: {$application->name}\n" .
            "📧 Контакты: {$application->contact}\n" .
            "💻 Стек: {$stack}\n" .
            "🔗 GitHub: {$github}\n" .
            "📁 Портфолио: {$portfolio}\n" .
            "💬 Сообщение: {$appMessage}";
        
        try {
            file_get_contents($webhook . '?text=' . urlencode($message));
        } catch (\Exception $e) {
            Log::error('Failed to send to Telegram: ' . $e->getMessage());
        }
    }
}

