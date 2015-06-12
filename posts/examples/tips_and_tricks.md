<!--
summary = "Useful Tips & Tricks"
author = Paul Blundell
date = 2015-06-11 20:00
-->

## Drafts

Sometimes you might want to upload a document but not yet publish it. This is one way of achieving this:

Create a new metadata variable in your document like so:

    <!--
    summary = This is a draft
    author = Test
    date = 2015-06-11 19:30
    status = draft
    -->

And then in `category.html.twig`, replace the page_content with the following:

    <section class="posts">
      {% for post in posts %}
        {% if post.status is not defined or post.status != 'draft' %} 
        <article class="post">
            <h2 class="title">{{ post.title }}</h2>
            <div class="info">
              Published by <span class="author">{{ post.author }}</span>
              on <span class="date">{{ post.date }}</span>
            </div>
            <p>{% if post.summary is defined %}{{ post.summary }}{% endif %}</p>
            <a href="/{{ category }}/{{ post.id }}">Read more</a>
        </article>
        {% endif %}
      {% endfor %}
    </section>
    
The if statement checks if the status is defined, if not it will continue to display the post in the list, otherwise it makes sure the status is not `draft` before displaying.
This will stop the post displaying in the category list but the post will still be accessibly by directly entering the url.
