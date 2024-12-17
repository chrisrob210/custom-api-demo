<?php

class BlogController
{
    public static function latest()
    {
        return response('Latest blog post');
    }

    public static function popular()
    {
        return response('Popular blog post');
    }

    public static function oldest()
    {
        return response('oldest blog post');
    }
}
