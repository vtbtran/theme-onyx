<?php
/*
Template Name: News Page (Static UI)
*/
get_header();

// DỮ LIỆU GIẢ (DUMMY DATA) - Mô phỏng bài viết để lên giao diện
// 1. Bài nổi bật (Hero)
// $hero_post = [
//     'title' => 'ONYX Launches Revolutionary AI Camera System for Educational Institutions',
//     'date'  => 'March 10, 2024',
//     'read'  => '5 min read',
//     'desc'  => 'Our latest AI-powered camera system brings advanced security and learning analytics to schools worldwide, featuring real-time behavior analysis and automated attendance tracking.',
//     // Đảm bảo file ảnh này tồn tại trong thư mục assets/images theme của bạn
//     'img'   => get_template_directory_uri() . '/assets/images/news.png' 
// ];

// $recent_posts = [
//     [
//         'title' => 'Partnership with Global Education Network Expands STEM Reach',
//         'date' => 'March 8, 2024',
//         'desc' => 'ONYX partners with leading educational organizations to bring STEM programs to over 500 schools across 15 countries.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'AI Technology Wins Innovation Award at Tech Summit 2024',
//         'date' => 'March 5, 2024',
//         'desc' => 'Our AI camera technology receives recognition for outstanding innovation in educational technology at the annual Tech Summit.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'New STEM Curriculum Helps Students Excel in Robotics Competition',
//         'date' => 'March 1, 2024',
//         'desc' => 'Students using ONYX STEM curriculum achieve remarkable success in national robotics competition, showcasing the effectiveness of our programs.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Quarterly Report: 200% Growth in AI Camera Deployments',
//         'date' => 'February 28, 2025',
//         'desc' => 'ONYX reports significant growth in AI camera installations across educational and commercial sectors in Q1 2024.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Webinar Series: Future of AI in Education Attracts 10K+ Participants',
//         'date' => 'February 25, 2024',
//         'desc' => 'Our educational webinar series reaches milestone attendance, highlighting growing interest in AI-powered learning solutions.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ],
//     [
//         'title' => 'Research Study: AI Cameras Improve School Safety by 85%',
//         'date' => 'February 20, 2024',
//         'desc' => 'Independent research confirms significant safety improvements in schools using ONYX AI camera systems.',
//         'img'  => get_template_directory_uri() . '/assets/images/news.png'
//     ]
// ];
?>
<?php
while ( have_posts() ) :
    the_post();
    
    the_content();

endwhile;
?>

<?php get_footer(); ?>