<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Project;
use App\Models\TechStack;
use App\Models\Award;
use App\Models\Profile;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Profile Settings
        Profile::updateOrCreate(['email' => 'anwarfaishal86@gmail.com'], [
            'name' => 'Faishal Anwar',
            'title' => 'Machine Learning Engineer',
            'github_url' => 'https://github.com/',
            'linkedin_url' => 'https://linkedin.com/in/',
            'instagram_url' => 'https://instagram.com/',
        ]);

        // Skills (Hero cards)
        Skill::updateOrCreate(['title' => 'Machine Learning'], [
            'icon' => 'brain',
            'description' => 'Advanced neural networks, deep learning models, and NLP solutions designed for complex predictive tasks.',
        ]);
        Skill::updateOrCreate(['title' => 'Data Engineering'], [
            'icon' => 'database',
            'description' => 'Architecting high-performance data pipelines, ETL processes, and scalable big data foundations.',
        ]);
        Skill::updateOrCreate(['title' => 'Cloud Architecture'], [
            'icon' => 'cloud',
            'description' => 'Designing secure, resilient, and highly available cloud infrastructures with automated deployment.',
        ]);

        // Experience
        Experience::updateOrCreate(['title' => 'Machine Learning Engineer', 'company' => 'Tech Solutions Inc.'], [
            'period' => 'Jan 2024 — Present',
            'description' => 'Developing end-to-end ML pipelines and optimizing model performance for production-scale AI services.',
        ]);
        Experience::updateOrCreate(['title' => 'Data Scientist Intern', 'company' => 'Adobe Systems'], [
            'period' => 'Jun 2023 — Dec 2023',
            'description' => 'Conducted large-scale data analysis and implemented recommendation engines using Adobe\'s customer cloud.',
        ]);

        // Education
        Education::updateOrCreate(['degree' => 'Undergraduate Student, Technical Informatics'], [
            'institution' => 'UNISSULA',
            'period' => 'Present',
            'description' => 'Deepening knowledge in distributed systems, advanced algorithms, and cloud computing.',
        ]);

        // Projects
        Project::updateOrCreate(['slug' => 'ai-sentiment-analyzer'], [
            'title' => 'AI Sentiment Analyzer',
            'year' => '2024',
            'description' => 'A real-time sentiment analysis tool using NLP to classify customer feedback with high accuracy using Transformer models.',
            'icon' => 'brain',
            'tags' => ['Python', 'PyTorch', 'BERT'],
            'is_featured' => true,
        ]);

        // Tech Stack
        $stacks = [
            // Machine Learning
            ['category' => 'Machine Learning & AI', 'name' => 'Python', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg', 'description' => 'Primary language for model development and data research.'],
            ['category' => 'Machine Learning & AI', 'name' => 'TensorFlow', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tensorflow/tensorflow-original.svg', 'description' => 'Framework for building and deploying production-grade ML models.'],
            ['category' => 'Machine Learning & AI', 'name' => 'PyTorch', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/pytorch/pytorch-original.svg', 'description' => 'Advanced deep learning research and flexible model building.'],
            ['category' => 'Machine Learning & AI', 'name' => 'Scikit-Learn', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/scikitlearn/scikitlearn-original.svg', 'description' => 'Industry-standard library for classical ML algorithms.'],

            // Data Engineering
            ['category' => 'Data Engineering', 'name' => 'SQL', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original-wordmark.svg', 'description' => 'Complex querying and large-scale data manipulation.'],
            ['category' => 'Data Engineering', 'name' => 'PostgreSQL', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg', 'description' => 'Primary RDBMS for structured data storage.'],
            ['category' => 'Data Engineering', 'name' => 'Apache Spark', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apachespark/apachespark-original.svg', 'description' => 'Distributed data processing for massive datasets.'],
            ['category' => 'Data Engineering', 'name' => 'MongoDB', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg', 'description' => 'NoSQL storage for flexible and semi-structured data.'],

            // Cloud & Architecture
            ['category' => 'Cloud & Infrastructure', 'name' => 'AWS', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg', 'description' => 'Enterprise cloud services and architecture.'],
            ['category' => 'Cloud & Infrastructure', 'name' => 'Docker', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg', 'description' => 'Containerization for consistent deployment environments.'],
            ['category' => 'Cloud & Infrastructure', 'name' => 'Kubernetes', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/kubernetes/kubernetes-plain.svg', 'description' => 'Orchestrating containerized applications at scale.'],
            ['category' => 'Cloud & Infrastructure', 'name' => 'Terraform', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/terraform/terraform-original.svg', 'description' => 'Infrastructure as Code for automated cloud setup.'],

            // MLOps & Automation
            ['category' => 'MLOps & Automation', 'name' => 'MLflow', 'icon_url' => 'https://cdn.simpleicons.org/mlflow/0194E2', 'description' => 'Platform for the machine learning lifecycle and experiment tracking.'],
            ['category' => 'MLOps & Automation', 'name' => 'GitHub Actions', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/githubactions/githubactions-original.svg', 'description' => 'CI/CD automation for testing and deployment pipelines.'],
            ['category' => 'MLOps & Automation', 'name' => 'Prometheus', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/prometheus/prometheus-original.svg', 'description' => 'Monitoring and alerting toolkit for cloud-native environments.'],
        ];

        // Clear old stacks and re-seed
        TechStack::truncate();
        foreach ($stacks as $stack) {
            TechStack::create($stack);
        }

        // Awards & Honors
        Award::updateOrCreate(['title' => '1st Place Machine Learning Hackathon'], [
            'issuer' => 'Global Tech Innovations',
            'year' => '2025',
            'description' => 'Winner of the national-level hackathon for developing an AI-driven disaster response system.',
        ]);
    }
}
