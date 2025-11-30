<?php

namespace Database\Seeders;

use App\Models\DeveloperTask;
use Illuminate\Database\Seeder;

class DeveloperTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Backend разработчик (Laravel)',
                'description' => 'Разработка backend части веб-приложения на Laravel. Работа с API, базами данных, интеграции с внешними сервисами.',
                'stack' => 'PHP, Laravel, PostgreSQL, Redis, Docker',
                'format' => 'Удаленно, полный день',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Frontend разработчик (Vue.js)',
                'description' => 'Разработка пользовательского интерфейса на Vue.js. Создание компонентов, работа с API, оптимизация производительности.',
                'stack' => 'JavaScript, Vue.js, TypeScript, Vite, Tailwind CSS',
                'format' => 'Удаленно, полный день',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Мобильный разработчик (React Native)',
                'description' => 'Разработка мобильных приложений для iOS и Android на React Native. Интеграция с API, нативная производительность.',
                'stack' => 'JavaScript, React Native, TypeScript, Redux',
                'format' => 'Удаленно, полный день',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'DevOps инженер',
                'description' => 'Настройка CI/CD, контейнеризация, облачная инфраструктура. Мониторинг и оптимизация производительности.',
                'stack' => 'Docker, Kubernetes, AWS/Azure, CI/CD, Linux',
                'format' => 'Удаленно, полный день',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Full-stack разработчик',
                'description' => 'Разработка полного цикла: от backend до frontend. Работа над различными проектами, полная ответственность за продукт.',
                'stack' => 'PHP, Laravel, JavaScript, Vue.js, PostgreSQL',
                'format' => 'Удаленно, полный день',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($tasks as $taskData) {
            // Extract common fields
            $task = [
                'stack' => $taskData['stack'],
                'format' => $taskData['format'],
                'order' => $taskData['order'],
                'is_active' => $taskData['is_active'],
            ];
            
            // Create task
            $taskModel = DeveloperTask::create($task);
            
            // Create translations for all languages
            // For now, use Russian as base for all languages (can be updated later)
            $translations = [
                'ru' => [
                    'title' => $taskData['title'],
                    'description' => $taskData['description'],
                ],
                'en' => [
                    'title' => $taskData['title'], // TODO: Add English translations
                    'description' => $taskData['description'], // TODO: Add English translations
                ],
                'az' => [
                    'title' => $taskData['title'], // TODO: Add Azerbaijani translations
                    'description' => $taskData['description'], // TODO: Add Azerbaijani translations
                ],
            ];
            
            foreach ($translations as $locale => $translationData) {
                $taskModel->saveTranslation($locale, $translationData);
            }
        }
    }
}

