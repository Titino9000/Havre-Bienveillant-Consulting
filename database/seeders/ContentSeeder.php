<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\KnowledgeHub;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Sliders
        Slider::create([
            'title' => 'Building Stronger Minds, Healthier Communities',
            'subtitle' => 'Professional counseling, psychosocial support, mental health training, and positive education consulting for individuals, families, schools, organizations, and communities.',
            'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/e/e9/Sky_view_of_hills_of_Rwanda.jpg',
            'is_active' => true,
            'order' => 1
        ]);

        // 2. Seed Knowledge Hub (Articles)
        $articles = [
            [
                'title' => 'Understanding Stress and How to Manage It',
                'type' => 'article',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Rwanda_tea.jpg',
                'content' => 'Practical strategies to recognize stress triggers and build healthier coping mechanisms in daily life.',
                'is_active' => true,
            ],
            [
                'title' => 'Helping Children Build Emotional Resilience',
                'type' => 'article',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/5/58/Rwanda_schoolchildren.jpg',
                'content' => 'How parents can create supportive environments that encourage emotional growth and adaptability.',
                'is_active' => true,
            ],
            [
                'title' => 'Teacher Wellbeing Strategies',
                'type' => 'article',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/8/83/Kigali2018Cropped.jpg',
                'content' => 'Why educators must prioritize their own mental health to effectively support their students.',
                'is_active' => true,
            ],
            [
                'title' => 'Positive Parenting Tips',
                'type' => 'article',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Kigali%2C_the_cleanest_city_in_Africa.jpg',
                'content' => 'Evidence-based approaches to fostering a nurturing and respectful parent-child relationship.',
                'is_active' => true,
            ],
            [
                'title' => 'Supporting Adolescents Through Change',
                'type' => 'article',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/b/b7/Holly_Rwanda_Landscape_Image_hills_of_Rwanda.jpg',
                'content' => 'Understanding the psychological transitions of adolescence and how to offer meaningful support.',
                'is_active' => true,
            ]
        ];

        foreach ($articles as $article) {
            KnowledgeHub::create($article);
        }

        // Seed Knowledge Hub (PDFs)
        $pdfs = [
            [
                'title' => 'HBC Ltd Company Profile',
                'type' => 'pdf',
                'content' => 'Comprehensive overview of our services and methodology.',
                'is_active' => true,
            ],
            [
                'title' => 'Mental Health Awareness Brochure',
                'type' => 'pdf',
                'content' => 'A quick guide to recognizing and supporting mental health needs.',
                'is_active' => true,
            ],
            [
                'title' => 'Positive Parenting Guide',
                'type' => 'pdf',
                'content' => 'Practical tips for parents to foster healthy emotional development.',
                'is_active' => true,
            ],
            [
                'title' => 'Teacher Wellbeing Checklist',
                'type' => 'pdf',
                'content' => 'A self-assessment tool for educators to monitor their stress levels.',
                'is_active' => true,
            ]
        ];

        foreach ($pdfs as $pdf) {
            KnowledgeHub::create($pdf);
        }

        // Seed Knowledge Hub (Videos)
        $videos = [
            [
                'title' => 'The Importance of Mental Health in Education',
                'type' => 'video',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/8/88/Kigali_City_Tower.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Building Resilience in the Workplace',
                'type' => 'video',
                'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg',
                'is_active' => true,
            ]
        ];

        foreach ($videos as $video) {
            KnowledgeHub::create($video);
        }

        // 3. Seed FAQs
        $faqs = [
            [
                'question' => 'Is counseling confidential?',
                'answer' => 'Yes. We maintain strict confidentiality in accordance with professional ethics and applicable laws, except where disclosure is required to protect someone\'s safety or comply with legal obligations.',
                'is_active' => true,
                'order' => 1
            ],
            [
                'question' => 'Who can receive counseling services?',
                'answer' => 'Children, adolescents, adults, parents, teachers, and other individuals seeking professional psychosocial support.',
                'is_active' => true,
                'order' => 2
            ],
            [
                'question' => 'Do I need an appointment?',
                'answer' => 'Yes. We recommend scheduling an appointment so we can prepare and dedicate sufficient time to your needs.',
                'is_active' => true,
                'order' => 3
            ],
            [
                'question' => 'Do you work with schools?',
                'answer' => 'Yes. We provide counseling, teacher training, mental health programs, parent workshops, and educational consulting for schools.',
                'is_active' => true,
                'order' => 4
            ],
            [
                'question' => 'Can organizations request customized training?',
                'answer' => 'Yes. We tailor workshops and consulting services to the objectives and context of each organization.',
                'is_active' => true,
                'order' => 5
            ],
            [
                'question' => 'Do you provide online consultations?',
                'answer' => 'Where appropriate, online consultations and virtual training sessions can be arranged.',
                'is_active' => true,
                'order' => 6
            ],
            [
                'question' => 'Do you work outside Kigali?',
                'answer' => 'Yes. Depending on the service, we can travel to other parts of Rwanda and discuss arrangements for regional engagements.',
                'is_active' => true,
                'order' => 7
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
