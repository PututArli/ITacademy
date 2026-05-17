<?php
class CourseModel {
    public function getCourses() {
        return [
            [
                'thumb_class' => 't1', 
                'icon' => '</>', 
                'label' => 'Modul 1 - 4',
                'title' => 'HTML & CSS Dasar',
                'desc' => 'Pelajari struktur halaman web, styling, dan layout modern menggunakan Flexbox serta Grid. Cocok untuk pemula absolut.',
                'tags' => ['12 Video', '4 Kuis', '1 Proyek']
            ],
            [
                'thumb_class' => 't2', 
                'icon' => '{ }', 
                'label' => 'Modul 5 - 8',
                'title' => 'JavaScript Fundamental',
                'desc' => 'Kuasai variabel, fungsi, DOM manipulation, dan event handling untuk membuat halaman web interaktif dan dinamis.',
                'tags' => ['10 Video', '3 Kuis', '1 Proyek']
            ],
            [
                'thumb_class' => 't3', 
                'icon' => '⚙', 
                'label' => 'Modul 9 - 12',
                'title' => 'Proyek Akhir: Landing Page',
                'desc' => 'Gabungkan semua skill yang sudah dipelajari ke dalam satu proyek utuh. Hasilnya akan direview dan dinilai oleh mentor.',
                'tags' => ['4 Video', 'Proyek Akhir', 'Sertifikat']
            ]
        ];
    }

    public function getMentors() {
        return [
            [
                'avatar' => 'RP', 
                'name' => 'Rafael Putut', 
                'spec' => 'Frontend Developer',
                'bio' => '5 tahun pengalaman di industri web. Spesialis HTML, CSS, dan JavaScript modern.'
            ],
            [
                'avatar' => 'PA', 
                'name' => 'Putut Arli', 
                'spec' => 'UI/UX Designer',
                'bio' => 'Desainer berpengalaman yang juga menguasai frontend. Membantu kamu bikin layout yang rapi.'
            ]
        ];
    }

    public function getPricing() {
        return [
            [
                'featured' => false, 
                'tier' => 'Free', 
                'amount' => 'Rp 0', 
                'period' => 'Gratis selamanya',
                'features' => [
                    ['icon' => 'check', 'text' => 'Akses materi dasar', 'class' => 'check'],
                    ['icon' => 'check', 'text' => 'Kuis latihan', 'class' => 'check'],
                    ['icon' => 'times', 'text' => 'Kirim tugas proyek', 'class' => 'cross'],
                    ['icon' => 'times', 'text' => 'Review dari mentor', 'class' => 'cross'],
                    ['icon' => 'times', 'text' => 'Sertifikat digital', 'class' => 'cross']
                ],
                'btn_class' => 'btn-outline', 
                'btn_text' => 'Daftar Gratis'
            ],
            [
                'featured' => true, 
                'tier' => 'Premium', 
                'amount' => 'Rp 99.000', 
                'period' => 'per bulan',
                'features' => [
                    ['icon' => 'check', 'text' => 'Semua materi & video', 'class' => 'check'],
                    ['icon' => 'check', 'text' => 'Kuis latihan', 'class' => 'check'],
                    ['icon' => 'check', 'text' => 'Kirim tugas proyek', 'class' => 'check'],
                    ['icon' => 'check', 'text' => 'Review & feedback mentor', 'class' => 'check'],
                    ['icon' => 'check', 'text' => 'Sertifikat digital (PDF)', 'class' => 'check']
                ],
                'btn_class' => 'btn-primary', 
                'btn_text' => 'Daftar Premium'
            ]
        ];
    }
}