<?php
namespace MyBC\News\Api\Data;


interface PostInterface {
    const POST_ID       = 'post_id';
    const URL_KEY       = 'url_key';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const CREATION_TIME = 'creation_time';
    const IS_ACTIVE     = 'is_active';

    public function getId();

    public function getUrlKey();

    public function getTitle();

    public function getContent();

    public function getCreationTime();

    public function isActive();

    public function setId($id);

    public function setUrlKey($url_key);

    public function setTitle($title);

    public function setContent($content);

    public function setCreationTime($creationTime);

    public function setIsActive($isActive);
}
