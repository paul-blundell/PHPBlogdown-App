<!--
summary = "How to adapt PHPBlogdown into your application."
author = Paul Blundell
date = 2015-06-11 19:30
-->

## Set up

    // Initialise the Blog
    $blog = new Blog('/path/to/config.ini');
    
    // Get a list of all categories
    $categories = $blog->categories->get_all();
    
    // Get the subcategories for a specific category
    $subcategories = $blog->categories->get('category');
    
    // Get all the posts in a category
    $posts = $blog->posts->get_all('category');
    
    // Get the post
    $post = $blog->posts->get('category','post');
    
## Metadata

    <!--
    summary = How to adapt PHPBlogdown into your application.
    author = Paul Blundell
    date = 2015-06-11 19:30
    custom = A custom variables
    long = "You can have longer values by surrounding it in
    quotes which will allow you to use as many lines as you
    need for your value..."
    -->
    
To use your variable in the post Twig template:

    {% if post.long is defined %}{{ post.long }}{% endif %}

Unless you plan to use the same variable on every single document, always surround it with an `if is defined`.