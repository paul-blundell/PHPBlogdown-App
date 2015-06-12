<!--
summary = "PHP Blogdown is a quick and easy blogging platform. Upload your markdown documents and everything is created for you..."
author = Paul Blundell
date = 2015-06-11 19:00
-->

PHPBlogdown was created to provide a very quick and easy blogging platform. All you need to do is write your markdown documents and upload them to your server.

## How does it work

The core of the `application` does most of the work and will iterate through your directories creating categories and finding posts by searching for markdown files. The core then simply returns arrays which are processed by your application.

For example, the snippet below will retrieve all categories:

    $blog = new PHPBlogdown\Blog('config.ini');
    $categories = $blog->categories->get_all();
    
And this will get a list of posts in the category:

    $posts = $blog->posts->get_all('category_name');
    
The following will get a specific post:

    $post = $blog->posts->get('about', 'what_is_this');

which will return an array structured as follows:

    [
        'id' => 'what_is_this',
        'title' => 'What Is This',
        'summary' => 'PHP Blogdown is..<ommitted>',
        'author' => 'Paul Blundell',
        'body' => '<html_output>'
    ]
    
The posts metadata, summary, autor, etc. is defined at the top of the markdown document, like so:

    <!--
    summary = "PHP Blogdown is a quick and easy blogging platform. Upload your markdown documents and everything is created for you..."
    author = Paul Blundell
    date = 2015-06-11 11:56
    -->

This must be the first HTML-style comment in the document. This is processed by PHP Blogdown as if it were an INI file, so you can add as much meta information as needed and it will be returned in the array.

## Why should I use this

So, why should you use this? I don't know. If you think it suits your needs then go ahead and use it. This was created for a quick blog as all the others were very bloated, I wanted something lightweight, fast, allowed me to just write markdown
documents and use composer so I could easily integrate it into other applications.

- Install in seconds.
- Just upload your markdown files and your done.
- It's fast.
- It's lightweight, the core is only 1.5kb (before installing dependencies).