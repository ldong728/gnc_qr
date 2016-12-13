<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2016/12/12
 * Time: 16:27
 */
include_once 'interfaceHandler.php';

class newsSdk
{

    public function __construct()
    {

    }

    private function getMediaList($type, $offset, $count = 20)
    {
        $request = array('type' => $type, 'offset' => $offset, 'count' => $count);
        $json = interfaceHandler::getHandler()->postArrayByCurl('https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN', $request);
        return json_decode($json, true);
    }

    public function getNewsList($offset, $count)
    {
        $news = $this->getMediaList('news', $offset, $count);
        $value=array();
        foreach ($news['item'] as $row) {
            $media_id = $row['media_id'];
            $art_img = 'image/' . $media_id . '.jpg';
            $art_title = $row['content']['news_item'][0]['title'];
            $art_short_text = $row['content']['news_item'][0]['digest'];
            $art_text = $row['content']['news_item'][0]['content'];
            $url = $row['content']['news_item'][0]['url'];
            $art_add_time = timeMysqlToUnix($row['content']['update_time']);
            if (!file_exists('../' . $art_img)) {
                $img = getFromUrl($row['content']['news_item'][0]['thumb_url']);
                file_put_contents('../' . $art_img, $img);
            }
            $value[] = array('media_id' => $media_id, 'title' => $art_title, 'digest' => $art_short_text, 'title_img' => $art_img, 'content' =>$art_text, 'url' => $url, 'create_time' => $art_add_time);
        }
        return $value;
    }

}