<?php
namespace MyBC\News\Api\Data;


interface PostInterface {
    const POST_ID        = 'post_id';
    const URL            = 'url';
    const TITLE          = 'title';
    const CONTENT        = 'content';
    const PUBLISHED_DATE = 'published_date';
    const IS_ACTIVE      = 'is_active';

    public function getId();

    public function getUrl();

    public function getTitle();

    public function getContent();

    public function isActive();

    public function getPublishedDate();

    public function setId($id);

    public function setUrl($url);

    public function setTitle($title);

    public function setContent($content);

    public function setIsActive($isActive);

    public function setPublishedDate($published_date);
}
