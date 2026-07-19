<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service::truncate();
        
        $services = [
            [
                'title_en' => 'Individual Counseling',
                'subtitle_en' => 'Helping Individuals Navigate Life\'s Challenges',
                'description_en' => 'We provide confidential counseling services that help individuals better understand their emotions, strengthen coping skills, and improve their overall wellbeing in a safe and supportive environment.',
                'audiences_en' => "Children\nAdolescents\nYoung Adults\nAdults\nParents\nTeachers",
                'features_en' => "Anxiety and stress\nEmotional wellbeing\nBehavioral challenges\nFamily and relationship concerns\nSelf-esteem and confidence\nGrief and loss\nPersonal development\nLife transitions",
                'benefits_en' => "Confidential sessions\nA compassionate, non-judgmental environment\nPractical coping strategies\nPersonalized support plans",
                'cta_text_en' => 'Book a Counseling Session',
                'icon' => 'bx-user',
                'type' => 'counseling'
            ],
            [
                'title_en' => 'School Mental Health Programs',
                'subtitle_en' => 'Supporting Healthy Learning Environments',
                'description_en' => 'Schools play a vital role in children\'s emotional and social development. We partner with educational institutions to create learning environments where students and educators can thrive.',
                'audiences_en' => "Schools\nStudents\nTeachers",
                'features_en' => "Student counseling\nTeacher wellbeing support\nClassroom mental health awareness\nEmotional resilience programs\nSchool wellbeing initiatives\nPositive behavior support\nParent engagement",
                'benefits_en' => "Improved student wellbeing\nBetter classroom relationships\nStronger teacher confidence\nHealthier school culture",
                'cta_text_en' => 'Partner With Us',
                'icon' => 'bxs-school',
                'type' => 'consulting'
            ],
            [
                'title_en' => 'Positive Education Consulting',
                'subtitle_en' => 'Building Positive Learning Communities',
                'description_en' => 'Positive education integrates academic achievement with emotional wellbeing. We help schools and families create environments where children can grow intellectually, socially, and emotionally.',
                'audiences_en' => "Schools\nEducators\nParents",
                'features_en' => "Positive discipline guidance\nSocio-emotional learning\nParent education workshops\nTeacher coaching\nChild development support\nSchool culture improvement",
                'benefits_en' => "Improved communication\nStronger parent-school collaboration\nBetter student engagement\nPositive learning environments",
                'cta_text_en' => 'Learn More',
                'icon' => 'bx-book-reader',
                'type' => 'consulting'
            ],
            [
                'title_en' => 'Mental Health Training & Workshops',
                'subtitle_en' => 'Building Knowledge That Creates Lasting Impact',
                'description_en' => 'We design and facilitate engaging workshops that increase mental health awareness, strengthen psychosocial skills, and equip participants with practical tools for everyday life.',
                'audiences_en' => "Schools\nNGOs\nCompanies\nGovernment Institutions\nCommunity Groups",
                'features_en' => "Mental Health Awareness\nStress Management\nBurnout Prevention\nEmotional Intelligence\nPsychological First Aid\nBuilding Resilience\nSelf-Care\nEffective Communication",
                'benefits_en' => "Increased mental health awareness\nStronger psychosocial skills\nPractical tools for everyday life\nEngaging workshops",
                'cta_text_en' => 'Request a Training Program',
                'icon' => 'bx-chalkboard',
                'type' => 'workshop'
            ],
            [
                'title_en' => 'Organizational Wellness',
                'subtitle_en' => 'Supporting Healthy Workplaces',
                'description_en' => 'Healthy organizations are built on healthy people. We help organizations foster supportive work environments where employees feel valued, resilient, and productive.',
                'audiences_en' => "NGOs\nCompanies\nPublic Institutions\nHealthcare Facilities\nEducational Institutions",
                'features_en' => "Workplace wellbeing programs\nStaff resilience workshops\nBurnout prevention\nLeadership support\nTeam communication\nEmployee mental health awareness",
                'benefits_en' => "Supportive work environments\nEmployees feel valued\nIncreased resilience\nImproved productivity",
                'cta_text_en' => 'Request an Organizational Assessment',
                'icon' => 'bx-building-house',
                'type' => 'consulting'
            ],
            [
                'title_en' => 'Psychosocial Support',
                'subtitle_en' => 'Strengthening Individuals and Communities',
                'description_en' => 'Psychosocial support helps people cope with difficult life circumstances while rebuilding emotional wellbeing, social connections, and resilience.',
                'audiences_en' => "Individuals\nFamilies\nCommunities",
                'features_en' => "Crisis support\nTrauma-informed interventions\nFamily support\nCommunity wellbeing initiatives\nGroup support sessions\nReferral and coordination",
                'benefits_en' => "Respectful interventions\nConfidentiality\nCulturally appropriate methods\nTailored to the individual or community",
                'cta_text_en' => 'Contact Our Team',
                'icon' => 'bx-group',
                'type' => 'counseling'
            ]
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
