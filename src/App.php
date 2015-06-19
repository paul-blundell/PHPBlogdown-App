<?php

namespace PHPBlogdown\App;

use PHPBlogdown\Blog;

class App
{
    /**
     * @var string
     */
    const CONFIG_FILE = '../src/config.ini';
    
    /**
     * @var string
     */
    const TEMPLATE_PATH = '../src/View';
    
    /**
     * @var string
     */
    const TEMPLATE_CACHE = '../templates/cache';
    
    /**
     * @var \Slim\Slim
     */
    private $app;
    
    /**
     * @var Blog
     */
    private $blog;

    /**
     * Run the App
     */
    public static function run()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }
    
    /**
     * Constructor
     */
    protected function __construct() 
    {
        $this->app = new \Slim\Slim(array(
            'templates.path' => self::TEMPLATE_PATH
        ));
        
        $this->app->view(new \Slim\Views\Twig());
        $this->app->view->parserOptions = array(
            'charset' => 'utf-8',
            'cache' => realpath(self::TEMPLATE_CACHE),
            'auto_reload' => true,
            'strict_variables' => false,
            'autoescape' => true
        );
        
        $this->blog = new Blog(self::CONFIG_FILE);
        
        $this->initGlobals();
        
        $this->initRoutes();
        
        $this->app->run();
    }
    
    /**
     * Initialise variables available to all
     * Twig templates
     */
    private function initGlobals()
    {
        $twig = $this->app->view->getEnvironment();
        $twig->addGlobal('categories', $this->blog->get_categories());
    }
    
    /**
     * Initialise the Apps routes
     */
    private function initRoutes()
    {
        $this->app->get('/', function() {
            $this->app->render('index.html.twig');
        });
        
        $this->app->get('/:category', function($category_id) {
            $category = $this->blog->get_categories()->get($category_id);
            $this->app->render('category.html.twig', [
                'category' => $category_id,
                'posts' => $this->blog->get_posts($category)
            ]);
        });
        
        $this->app->get('/:category/:post', function($category_id, $post) {
            $category = $this->blog->get_categories()->get($category_id);
            $this->app->render('post.html.twig', [
                'post' =>  $this->blog->get_post($category, $post)
            ]);
        });
    }
}