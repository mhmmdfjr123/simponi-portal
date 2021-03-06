<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Laravel Starter Content Configuration
	|--------------------------------------------------------------------------
	|
	| Default variable.
    | Author: Efriandika Pratama (efriandika@gmail.com)
	|
	*/

    // Tiny MCE Global Configuration
    'tinymce' => [
            'selector'      => "textarea.tinymce",
            'menubar'       => "edit insert view format table tools",
            'plugins'       => "wordcount code autolink autoresize image table link searchreplace textcolor fullscreen preview paste lists advlist",
            'toolbar'       => "undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            'paste_as_text' => true,
            'relative_urls' => false,
            // 'convert_urls'=> false,
            'image_advtab'  => true,
            'external_filemanager_path' => "/filemanager/",
            'filemanager_title' => "File Manager" ,
            'external_plugins'  => ["filemanager" => "/filemanager/plugin.min.js"],
            'content_css'   => '/theme/front/css/tinymce.css'
    ],

    // Special Page
    'page' => [
        'special' => [
            'home'      => [
                'title'     => 'Beranda',
                'action'    => 'home'
            ],
            'contact'   => [
                'title'     => 'Hubungi Kami',
                'action'    => 'contact'
            ],
            'download'   => [
	            'title'     => 'Download File',
	            'action'    => 'download'
            ],
            'faq' => [
                'title'     => 'FAQ',
                'action'    => 'faq'
            ],
            'fundFactSheet' => [
                'title'     => 'Fund Fact Sheet',
                'action'    => 'fund-fact-sheet'
            ],
            'simulation' => [
                'title'     => 'Simulasi Berdasarkan Iuran',
                'action'    => 'simulation'
            ],
            'simulationNeeds' => [
	            'title'     => 'Simulasi Berdasarkan Kebutuhan',
	            'action'    => 'simulation/based-on-needs'
            ],
        ]
    ],

];
