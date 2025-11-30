<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'ru' => [
                    'title' => 'Веб-разработка',
                    'description' => 'Создание современных веб-приложений с использованием передовых технологий.',
                    'problem' => 'Необходимость в надежном, масштабируемом веб-приложении, которое соответствует современным стандартам безопасности и производительности.',
                    'solution' => 'Разработка с использованием Laravel, Vue.js, PostgreSQL. Архитектура микросервисов, RESTful API, оптимизация производительности.',
                    'result' => 'Высокопроизводительное приложение с быстрой загрузкой, безопасностью на уровне enterprise и возможностью масштабирования.',
                ],
                'en' => [
                    'title' => 'Web Development',
                    'description' => 'Creating modern web applications using cutting-edge technologies.',
                    'problem' => 'Need for a reliable, scalable web application that meets modern security and performance standards.',
                    'solution' => 'Development using Laravel, Vue.js, PostgreSQL. Microservices architecture, RESTful API, performance optimization.',
                    'result' => 'High-performance application with fast loading, enterprise-level security and scalability.',
                ],
                'az' => [
                    'title' => 'Veb İnkişaf',
                    'description' => 'Ən son texnologiyalardan istifadə edərək müasir veb tətbiqlərinin yaradılması.',
                    'problem' => 'Müasir təhlükəsizlik və performans standartlarına cavab verən etibarlı, miqyaslanan veb tətbiqinə ehtiyac.',
                    'solution' => 'Laravel, Vue.js, PostgreSQL istifadə edərək inkişaf. Mikroservis arxitekturası, RESTful API, performans optimallaşdırması.',
                    'result' => 'Sürətli yükləmə, enterprise səviyyəli təhlükəsizlik və miqyaslanma imkanı ilə yüksək performanslı tətbiq.',
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'ru' => [
                    'title' => 'Мобильная разработка',
                    'description' => 'Разработка нативных и кроссплатформенных мобильных приложений.',
                    'problem' => 'Потребность в мобильном приложении, которое работает стабильно на iOS и Android, с нативным UX.',
                    'solution' => 'Разработка на React Native или Flutter. Нативная производительность, единая кодовая база, оптимизация под обе платформы.',
                    'result' => 'Мобильное приложение с нативным UX, высокой производительностью и единой кодовой базой для обеих платформ.',
                ],
                'en' => [
                    'title' => 'Mobile Development',
                    'description' => 'Development of native and cross-platform mobile applications.',
                    'problem' => 'Need for a mobile application that works stably on iOS and Android with native UX.',
                    'solution' => 'Development on React Native or Flutter. Native performance, single codebase, optimization for both platforms.',
                    'result' => 'Mobile application with native UX, high performance and single codebase for both platforms.',
                ],
                'az' => [
                    'title' => 'Mobil İnkişaf',
                    'description' => 'Yerli və platformalararası mobil tətbiqlərinin inkişafı.',
                    'problem' => 'iOS və Android-də yerli UX ilə sabit işləyən mobil tətbiqə ehtiyac.',
                    'solution' => 'React Native və ya Flutter-də inkişaf. Yerli performans, vahid kod bazası, hər iki platforma üçün optimallaşdırma.',
                    'result' => 'Hər iki platforma üçün yerli UX, yüksək performans və vahid kod bazası ilə mobil tətbiq.',
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'ru' => [
                    'title' => 'Backend разработка',
                    'description' => 'Проектирование и разработка серверной части приложений.',
                    'problem' => 'Требуется надежный backend с высокой производительностью, способный обрабатывать большие объемы данных.',
                    'solution' => 'Архитектура на Laravel/PHP или Node.js. Оптимизация запросов, кеширование, очереди задач, микросервисная архитектура.',
                    'result' => 'Масштабируемый backend с высокой производительностью, надежностью и возможностью обработки больших нагрузок.',
                ],
                'en' => [
                    'title' => 'Backend Development',
                    'description' => 'Design and development of server-side applications.',
                    'problem' => 'Need for a reliable backend with high performance capable of processing large volumes of data.',
                    'solution' => 'Architecture on Laravel/PHP or Node.js. Query optimization, caching, task queues, microservices architecture.',
                    'result' => 'Scalable backend with high performance, reliability and ability to handle large loads.',
                ],
                'az' => [
                    'title' => 'Backend İnkişaf',
                    'description' => 'Server tərəfinin tətbiqlərinin dizaynı və inkişafı.',
                    'problem' => 'Böyük həcmli məlumatları emal edə bilən yüksək performanslı etibarlı backend-ə ehtiyac.',
                    'solution' => 'Laravel/PHP və ya Node.js-də arxitektura. Sorğu optimallaşdırması, keşləmə, tapşırıq növbələri, mikroservis arxitekturası.',
                    'result' => 'Böyük yükləri idarə edə bilən yüksək performans, etibarlılıq və imkan ilə miqyaslanan backend.',
                ],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'ru' => [
                    'title' => 'API разработка',
                    'description' => 'Создание RESTful и GraphQL API для интеграции систем.',
                    'problem' => 'Необходимость интеграции различных систем через единый API интерфейс с документацией.',
                    'solution' => 'Разработка RESTful API на Laravel с документацией Swagger/OpenAPI. Версионирование, аутентификация, rate limiting.',
                    'result' => 'Надежный API с полной документацией, версионированием и возможностью интеграции с любыми системами.',
                ],
                'en' => [
                    'title' => 'API Development',
                    'description' => 'Creating RESTful and GraphQL APIs for system integration.',
                    'problem' => 'Need to integrate various systems through a single API interface with documentation.',
                    'solution' => 'RESTful API development on Laravel with Swagger/OpenAPI documentation. Versioning, authentication, rate limiting.',
                    'result' => 'Reliable API with full documentation, versioning and ability to integrate with any systems.',
                ],
                'az' => [
                    'title' => 'API İnkişaf',
                    'description' => 'Sistem inteqrasiyası üçün RESTful və GraphQL API-lərinin yaradılması.',
                    'problem' => 'Sənədləşmə ilə vahid API interfeysi vasitəsilə müxtəlif sistemlərin inteqrasiyasına ehtiyac.',
                    'solution' => 'Swagger/OpenAPI sənədləşməsi ilə Laravel-də RESTful API inkişafı. Versiyalaşdırma, autentifikasiya, rate limiting.',
                    'result' => 'Hər hansı sistemlərlə inteqrasiya imkanı ilə tam sənədləşmə, versiyalaşdırma ilə etibarlı API.',
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'ru' => [
                    'title' => 'DevOps и инфраструктура',
                    'description' => 'Настройка CI/CD, контейнеризация, облачная инфраструктура.',
                    'problem' => 'Требуется автоматизация деплоя, масштабируемая инфраструктура и мониторинг приложений.',
                    'solution' => 'Настройка Docker, Kubernetes, CI/CD пайплайнов. Облачная инфраструктура (AWS/Azure/GCP), мониторинг и логирование.',
                    'result' => 'Автоматизированный деплой, масштабируемая инфраструктура и полный мониторинг приложений.',
                ],
                'en' => [
                    'title' => 'DevOps and Infrastructure',
                    'description' => 'CI/CD setup, containerization, cloud infrastructure.',
                    'problem' => 'Need for deployment automation, scalable infrastructure and application monitoring.',
                    'solution' => 'Docker, Kubernetes, CI/CD pipeline setup. Cloud infrastructure (AWS/Azure/GCP), monitoring and logging.',
                    'result' => 'Automated deployment, scalable infrastructure and full application monitoring.',
                ],
                'az' => [
                    'title' => 'DevOps və İnfrastruktur',
                    'description' => 'CI/CD quraşdırması, konteynerizasiya, bulud infrastrukturu.',
                    'problem' => 'Dəyişiklik avtomatlaşdırması, miqyaslanan infrastruktur və tətbiq monitorinqinə ehtiyac.',
                    'solution' => 'Docker, Kubernetes, CI/CD pipeline quraşdırması. Bulud infrastrukturu (AWS/Azure/GCP), monitorinq və loqlaşdırma.',
                    'result' => 'Avtomatlaşdırılmış dəyişiklik, miqyaslanan infrastruktur və tam tətbiq monitorinqi.',
                ],
                'order' => 5,
                'is_active' => true,
            ],
            [
                'ru' => [
                    'title' => 'Техническая поддержка',
                    'description' => 'Поддержка и развитие существующих проектов.',
                    'problem' => 'Необходимость в постоянной поддержке, обновлениях и развитии существующего проекта.',
                    'solution' => 'Регулярные обновления, исправление багов, добавление новых функций, оптимизация производительности.',
                    'result' => 'Стабильно работающий проект с регулярными обновлениями и технической поддержкой.',
                ],
                'en' => [
                    'title' => 'Technical Support',
                    'description' => 'Support and development of existing projects.',
                    'problem' => 'Need for constant support, updates and development of existing project.',
                    'solution' => 'Regular updates, bug fixes, new features, performance optimization.',
                    'result' => 'Stable project with regular updates and technical support.',
                ],
                'az' => [
                    'title' => 'Texniki Dəstək',
                    'description' => 'Mövcud layihələrin dəstəyi və inkişafı.',
                    'problem' => 'Mövcud layihənin daimi dəstəyi, yeniləmələri və inkişafına ehtiyac.',
                    'solution' => 'Müntəzəm yeniləmələr, xəta düzəlişləri, yeni funksiyalar, performans optimallaşdırması.',
                    'result' => 'Müntəzəm yeniləmələr və texniki dəstək ilə sabit layihə.',
                ],
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            // Extract common fields
            $service = [
                'order' => $serviceData['order'],
                'is_active' => $serviceData['is_active'],
            ];
            
            // Create service
            $serviceModel = Service::create($service);
            
            // Create translations for all languages
            foreach (['ru', 'en', 'az'] as $locale) {
                if (isset($serviceData[$locale])) {
                    $serviceModel->saveTranslation($locale, $serviceData[$locale]);
                }
            }
        }
    }
}
