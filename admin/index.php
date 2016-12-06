<?php

include_once '../includePackage.php';
include_once '../wechat/serveManager.php';
session_start();


if (isset($_SESSION['login']) && DOMAIN == $_SESSION['login']) {
    $num=15;
    $getStr = '';

    foreach ($_GET as $k => $v) {
        if ($k == 'page') continue;
        $getStr .= $k . '=' . $v . '&';
    }

    if (isset($_GET['menu']) && array_key_exists($_GET['menu'], $_SESSION['pms'])) {
        switch ($_GET['sub']) {
            case 'add_dealer':
                $rank='';
                if(isset($_SESSION['dealer_rank'])){
                    $rank=' where rank>'.$_SESSION['dealer_rank'];
                }else{
                    $rank='where rank>0';
                }
                $rank=pdoQuery('gd_user_rank',null,null,$rank. ' order by rank asc');
                printAdminView('admin/view/dealer_add.html.php', '新建用户');
                break;
            case 'dealer_list':
                $page=$_GET['page'];
                $where=null;
                $rank=0;
                if(isset($_SESSION['dealer_id'])){
                    $where=array('use_parent_id'=>$_SESSION['dealer_id']);

                }
                $dealerList=pdoQuery('gd_users',null,$where,' limit ' . $page * $num . ', ' .$num);
                printAdminView('admin/view/dealer_list.html.php','经销商列表');
                break;
            case 'dealer_audit':
                if(!isset($_SESSION['dealer_id'])||$_SESSION['dealer_grade']==0){
                    $page=$_GET['page'];
                    $where=null;
//                    if(isset($_SESSION['dealer_id']))$where=array('f_id'=>$_SESSION['dealer_id']);
//                    else $where=array('f_id'=>'0');
                    $dealerList=pdoQuery('gd_audit_view',null,$where,' and use_id is not null limit ' . $page * $num . ', ' .$num);
                    printAdminView('admin/view/dealer_audit.html.php','经销商审核');
                }else{
                    printAdminView('admin/view/blank.html.php','首页');
                }
                break;
            case 'wx_config':
                printAdminView('admin/view/wechatConfig.html.php','微信设置');
                break;
        }
        exit;
    }

    if (isset($_GET['groupManager'])) {
        if (isset($_SESSION['pms']['group'])) {
            if (isset($_GET['groupList'])) {
                $slist = getGroupList();
                foreach ($slist as $row) {
                    if ($row['id'] == 1 || $row['id'] == 2) continue;//屏蔽星标组和黑名单
                    $list[] = $row;
                }
                if (!isset($list)) $list = array();
                printAdminView('admin/view/groupManage.html.php', '分组管理');
                exit;
            }
        } else {
            echo '权限不足';
            exit;
        }

    }
    if (isset($_GET['noticeList'])) {
        if (isset($_SESSION['pms']['notice'])) {
            $groupList = getGroupList();
            foreach ($groupList as $row) {
                if ($row['id'] < 3) continue;//屏蔽星标组和黑名单
                $glist[] = $row;
            }
            $where = null;
            $num = 15;
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            if (isset($_GET['situation'])) $where['situation'] = $_GET['situation'];
            if (isset($_GET['groupid'])) $where['groupid'] = $_GET['groupid'];
            if (isset($_GET['category'])) $where['category'] = $_GET['category'];
            $getStr = '';
            foreach ($_GET as $k => $v) {
                if ($k == 'page') continue;
                $getStr .= $k . '=' . $v . '&';
            }
            $getStr = rtrim($getStr, '&');
            $notice = pdoQuery('notice_view', null, $where, ' order by create_time desc limit ' . $page * $num . ', ' . $num);
            printAdminView('admin/view/notice.html.php', '通知列表');
            exit;

        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['reviewList'])) {
        if (isset($_SESSION['pms']['notice'])) {
            $where['notice_id'] = $_GET['reviewList'];
            $num = 15;
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
//            if(isset($_GET['situation']))$where['situation']=$_GET['source'];
//            if(isset($_GET['group']))$where['groupid']=$_GET['group'];
//            if(isset($_GET['category']))$where['category']=$_GET['category'];

            $reviewList = pdoQuery('review_view', null, $where, ' order by review_time desc limit ' . $page * $num . ', ' . $num);
            $reviewList = $reviewList->fetchAll();
            printAdminView('admin/view/review.html.php', '留言列表');
            exit;

        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['markList'])) {
        if (isset($_SESSION['pms']['notice'])) {
            $where['notice_id'] = $_GET['markList'];
            $num = 15;
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            $markList = pdoQuery('mark_view', null, $where, ' order by mark_time desc limit ' . $page * $num . ', ' . $num);
            printAdminView('admin/view/mark.html.php', '已读列表');

            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['newNotice'])) {
        if (isset($_SESSION['pms']['notice'])) {
            $notice = 2;
            printAdminView('admin/view/createNews.html.php', '新建通知');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['sendNotice'])) {
        if (isset($_SESSION['pms']['notice'])) {
            $readyQuery = pdoQuery('notice_tbl', null, array('situation' => '0'), null);
            foreach ($readyQuery as $row) {
                $ready[] = $row;
            }
            $groupList = getGroupList();
            foreach ($groupList as $row) {
                if ($row['id'] < 3) continue;//屏蔽星标组和黑名单
                $glist[] = $row;
            }
            printAdminView('admin/view/sendNotice.html.php', '发送通知');
            exit;

        } else {
            echo '权限不足';
            exit;
        }

    }


    if (isset($_GET['newslist'])) {
        $cateQuery = pdoQuery('category_tbl', null, null, null);
        $cateList = $cateQuery->fetchAll();
        $where = null;
        $num = 15;
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        if (isset($_GET['source'])) $where['source'] = $_GET['source'];
        if (isset($_GET['group'])) $where['groupid'] = $_GET['group'];
        if (isset($_GET['category'])) $where['category'] = $_GET['category'];
        $newsList = pdoQuery('news_tbl', null, $where, ' order by create_time desc limit ' . $page * $num . ', ' . $num);
        $getStr = '';
        foreach ($_GET as $k => $v) {
            if ($k == 'page') continue;
            $getStr .= $k . '=' . $v . '&';
        }
        $getStr = rtrim($getStr, '&');
        if (isset($_SESSION['pms']['news'])) {
//            echo getArrayInf($newsList);
            printAdminView('admin/view/newslist.html.php', '图文列表');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['createNews'])) {
        if (isset($_SESSION['pms']['news'])) {
            printAdminView('admin/view/createNews.html.php', '新建图文信息');
            exit;
        }
    }
    if (isset($_GET['userList'])) {
        if (isset($_SESSION['pms']['news'])) {
            $order = isset($_GET['order']) ? $_GET['order'] : 'subscribe_time';
            $order_rule = isset($_GET['rule']) ? $_GET['rule'] : 'desc';
            $where = array('subscribe' => 1);
            $num = 15;
            $page = isset($_GET['page']) ? $_GET['page'] : 0;
            $index = $page * $num;
            if (isset($_GET['groupid'])) $where['groupid'] = $_GET['groupid'];
            $userquery = pdoQuery('user_view', null, $where, "order by $order $order_rule limit $index,$num");
            $userlist = $userquery->fetchAll();
            $groupList = getGroupList();
            foreach ($groupList as $row) {
                if ($row['id'] < 3) continue;//屏蔽星标组和黑名单
                $glist[] = $row;
            }
            $getStr = '';
            foreach ($_GET as $k => $v) {
                if ($k == 'page') continue;
                $getStr .= $k . '=' . $v . '&';
            }
            $getStr = rtrim($getStr, '&');
            printAdminView('admin/view/user_list.html.php', '已关注列表');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }

    if (isset($_GET['review'])) {
        if (isset($_SESSION['pms']['review'])) {
//            $limit = isset($_GET['index']) ? ' limit ' . $_GET['index'] . ', 20' : ' limit 20';
//            $reviewQuery = pdoQuery('review_tbl', null, array('priority' => '5', 'public' => '0'), $limit);
//            foreach ($reviewQuery as $row) {
//                $review[] = $row;
//            };
//            if (null == $review) $review = array();

            printAdminView('admin/view/review.html.php', '评价管理');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['wechatConfig'])) {
        if (isset($_SESSION['pms']['wechat'])) {
            $button = getConfig('../config/buttonInf.json');
//            foreach ($button['button'] as $row) {
//                if($row['sub_button'])
//            }


            printAdminView('admin/view/wechatConfig.html.php', '微信公众平台');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['index'])) {
        if (isset($_SESSION['pms']['index'])) {
            $config = getConfig('../mobile/config/config.json');
            $remarkQuery = pdoQuery('index_remark_tbl', null, null, null);
            $frontImg = pdoQuery('ad_tbl', null, array('category' => 'banner'), null);
            printAdminView('admin/view/admin_index.html.php', 'Zaman Goz');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['categorylist'])) {
        if (isset($_SESSION['pms']['index'])) {
            $cate = pdoQuery('category_view', null, null, null);
            printAdminView('admin/view/category.html.php', 'Zaman Goz');
            exit;
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['jm'])) {
        if (isset($_SESSION['pms']['jm'])) {
            if (isset($_GET['jm_create'])) {
                if (isset($_GET['edit'])) {
                    $inf = pdoQuery('jm_news_tbl', null, array('id' => $_GET['edit']), ' limit 1');
                    $inf = $inf->fetch();
                    $fQuery = pdoQuery('jm_cate_tbl', array('f_id'), array('id' => $inf['category']), ' limit 1');
                    $fQuery = $fQuery->fetch();
                    $f_id = $fQuery['f_id'] > 0 ? $fQuery['f_id'] : $inf['category'];
                }
                $mode = 3;
                $jmMain = pdoQuery('jm_cate_tbl', null, array('f_id' => '-1'), null);
                $jmCate = $jmMain->fetchAll();
                $jmAll = pdoQuery('jm_cate_tbl', null, null, ' order by f_id asc, id asc');
                foreach ($jmAll as $row) {
                    if (-1 == $row['f_id']) {
                        $jmSCate[$row['id']] = $row;
                    } else {
                        $jmSCate[$row['f_id']]['option'][] = $row;
                    }
                }
                printAdminView('admin/view/createNews.html.php', '新建文章');
                exit;
            }
            if (isset($_GET['jm_cate'])) {
                $fcq = pdoQuery('jm_cate_tbl', null, array('f_id' => -1), null);
                foreach ($fcq as $row) {
                    $fc[$row['id']] = $row;
                }
                if (!$fc) $fc = array();
                $scQuery = pdoQuery('jm_cate_tbl', null, array('sub_num' => '0'), ' and f_id>-1');
                foreach ($scQuery as $row) {
                    if (!isset($sc[$row['f_id']])) $sc[$row['f_id']]['name'] = $fc[$row['f_id']]['name'];
                    if ($row['id']) {
                        $sc[$row['f_id']]['sc'][] = array(
                            'id' => $row['id'],
                            'name' => $row['name']
                        );
                    }
                }
                if (!isset($sc)) $sc = array();
                printAdminView('admin/view/jm_category.html.php', '军民融合分类');
                exit;
            }
            if (isset($_GET['jm_list'])) {
                $jmMain = pdoQuery('jm_cate_tbl', null, array('f_id' => '-1'), null);
                $jmCate = $jmMain->fetchAll();
                $jmAll = pdoQuery('jm_cate_tbl', null, null, ' order by f_id asc, id asc');
                foreach ($jmAll as $row) {
                    if (-1 == $row['f_id']) {
                        $jmSCate[$row['id']] = $row;
                    } else {
                        $jmSCate[$row['f_id']]['option'][] = $row;
                    }
                }
                if (!$jmCate) $jmCate = array();
                if (!$jmSCate) $jmSCate = array();
                $order = isset($_GET['order']) ? $_GET['order'] : 'create_time';
                $order_rule = isset($_GET['rule']) ? $_GET['rule'] : 'desc';
                $num = 15;
                $page = isset($_GET['page']) ? $_GET['page'] : 0;
                $index = $page * $num;
                $where = null;
                if (isset($_GET['cate']) && $_GET['cate'] > -1) $where['category'] = $_GET['cate'];
                $getStr = '';
                foreach ($_GET as $k => $v) {
                    if ($k == 'page') continue;
                    $getStr .= $k . '=' . $v . '&';
                }
                $getStr = rtrim($getStr, '&');
                $query = pdoQuery('jm_news_tbl', array('id', 'category', 'title', 'title_img', 'type'), $where, " order by $order $order_rule limit $index,$num");
                foreach ($query as $row) {
                    $newsList[] = $row;
                }
                if (!$newsList) $newsList = array();
                printAdminView('admin/view/jm_list.html.php', '文章列表');
                exit;

            }
        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['bbs'])) {
        if (isset($_SESSION['pms']['bbs'])) {
            if (isset($_GET['bbslist'])) {
                $group = getGroupList();
                foreach ($group as $row) {
                    if ($row['id'] > 0 && $row['id'] < 100) continue;
                    $groupList[] = $row;
                }
                $where = null;
                if (isset($_GET['groupid'])) $where['groupid'] = $_GET['groupid'];
                if (isset($_GET['openid'])) $where['open_id'] = $_GET['openid'];
                $order = isset($_GET['order']) ? $_GET['order'] : 'issue_time';
                $order_rule = isset($_GET['rule']) ? $_GET['rule'] : 'desc';

                $num = 15;
                $page = isset($_GET['page']) ? $_GET['page'] : 0;
                $index = $page * $num;
                $bbsQuery = pdoQuery('bbs_admin_list_view', null, $where, "order by $order $order_rule limit $index,$num");
                foreach ($bbsQuery as $row) {
                    $bbsList[] = $row;
                }
                if (!isset($bbsList)) $bbsList = array();
                $getStr = '';
                foreach ($_GET as $k => $v) {
                    if ($k == 'page') continue;
                    $getStr .= $k . '=' . $v . '&';
                }
                $getStr = rtrim($getStr, '&');
                printAdminView('admin/view/bbs_list.html.php', '社区帖子');
                exit;
            }
            if (isset($_GET['topic_detail'])) {
                $t_id = $_GET['t_id'];
                $infQuery = pdoQuery('bbs_topic_tbl', null, array('id' => $t_id), ' limit 1');
                $inf = $infQuery->fetch();


            }
            if (isset($_GET['topic_img'])) {

            }
            if (isset($_GET['createTopic'])) {
            }
        }
    }
    if (isset($_GET['std'])) {
        if (isset($_SESSION['pms']['std'])) {
            if (isset($_GET['createQuestion']) || isset($_GET['editQuestion']) || isset($_GET['questionList'])) {
                $order = isset($_GET['order']) ? $_GET['order'] : 'create_time';
                $rule = isset($_GET['rule']) ? $_GET['rule'] : 'desc';
                $num = 15;
                $page = isset($_GET['page']) ? $_GET['page'] : 0;
                $index = $page * $num;
                $where = array();
                if (isset($_GET['type'])) $where['type'] = $_GET['type'];
                $query = pdoQuery('std_question_tbl', null, $where, " order by $order $rule limit $index,$num");
                $getStr = '';
                foreach ($_GET as $k => $v) {
                    if ($k == 'page') continue;
                    $getStr .= $k . '=' . $v . '&';
                }
                $getStr = rtrim($getStr, '&');
                foreach ($query as $row) {
                    $nearList[] = array(
                        'id' => $row['id'],
                        'content' => mb_substr($row['content'], 0, 20, 'utf-8'),
                        'create_time' => date("Y-m-d H:i:sa", $row['create_time'])
                    );
                }
                if (!isset($nearList)) $nearList = array();
                $type = pdoQuery('std_type_tbl', null, null, null);
                $type = $type->fetchAll();
            }
            if (isset($_GET['createQuestion'])) {
                printAdminView('admin/view/std_createQuestion.html.php', '创建新题');
            }
            if (isset($_GET['editQuestion'])) {
                $query = pdoQuery('std_question_view', null, array('id' => $_GET['q_id']), ' limit 4');
                foreach ($query as $row) {
                    if (!isset($inf)) {
                        $inf = $row;
                    }
                    $inf['options'][] = array('id' => $row['o_id'], 'content' => $row['o_content'], 'correct' => $row['correct']);
                }
                printAdminView('admin/view/std_editQuestion.html.php', '编辑试题');
                exit;
            }
            if (isset($_GET['questionList'])) {
                printAdminView('admin/view/std_questionList.html.php', '试题列表');
                exit;

            }
            if (isset($_GET['userScore'])) {
                $search = '';
                $order = isset($_GET['order']) ? $_GET['order'] : 'create_time';
                $order_rule = isset($_GET['order_rule']) ? $_GET['order_rule'] : 'desc';
                $num = 30;
                $page = isset($_GET['page']) ? $_GET['page'] : 0;
                $index = $page * $num;
                $where = array();
                if (isset($_GET['groupid'])) $where['groupid'] = $_GET['groupid'];
                if (isset($_GET['openid'])) $where['openid'] = $_GET['openid'];
                $query = pdoQuery('std_score_view', null, $where, "$search order by $order $order_rule limit $index,$num");
                foreach ($query as $row) {
                    $scoreList[] = $row;
                }
                if (!isset($scoreList)) $scoreList = array();
                $getStr = '';
                foreach ($_GET as $k => $v) {
                    if ($k == 'page') continue;
                    $getStr .= $k . '=' . $v . '&';
                }
                $getStr = rtrim($getStr, '&');
                $group = getGroupList();
                foreach ($group as $row) {
                    if ($row['id'] > 0 && $row['id'] < 100) continue;
                    $groupList[] = $row;
                }
                printAdminView('admin/view/std_scoreList.html.php', '成绩查询');
                exit;


            }
        }
    }
    if (isset($_GET['operator'])) {
        if (isset($_SESSION['pms']['operator'])) {
            $query = pdoQuery('pms_tbl', null, null, null);
            foreach ($query as $row) {
                $pmsList[$row['key']] = array('value' => $row['key'], 'name' => $row['name']);
            }
            $query = pdoQuery('pms_view', null, null, null);
            foreach ($query as $row) {
                if (!isset($opList[$row['id']])) {
                    $opList[$row['id']] = array(
                        'id' => $row['id'],
                        'name'=> $row['name'],
                        'pwd' => $row['pwd'],
                        'pms' => $pmsList
                    );
//                    $opList[$row['id']]=$pmsList;
                }
                $opList[$row['id']]['pms'][$row['pms']]['checked'] = 'checked';
            }
//            mylog(getArrayInf($opList));
            printAdminView('admin/view/operator.html.php', '操作员管理');
            exit;

        } else {
            echo '权限不足';
            exit;
        }
    }
    if (isset($_GET['logout'])) {//登出
        session_unset();
        include 'view/login.html.php';
        exit;
    }
    printAdminView('admin/view/blank.html.php', 'Zaman Goz');
    exit;
} else {
    if (isset($_GET['login'])) {
        $name = $_POST['adminName'];
        $pwd = $_POST['password'];
        if ($_POST['adminName'] . $_POST['password'] == ADMIN . PASSWORD) {
            $_SESSION['login'] = DOMAIN;
            $_SESSION['operator_id'] = -1;
            $_SESSION['dealer_rank']=0;
//            $pms = pdoQuery('pms_tbl', null, null, null);
//            foreach ($pms as $row) {
//                $_SESSION['pms'][$row['id']] = array($row['id']=>$row['name']);
//            }
            printAdminView('admin/view/blank.html.php', 'Zaman Goz');
        } else {
            $query = pdoQuery('operator_tbl', null, array('name' => $name, 'md5' => md5($pwd)), ' limit 1');
            $op_inf = $query->fetch();
            if (!$op_inf) {
                $dealQuery=pdoQuery('gd_users',null,array('use_phone'=>$name,'use_password'=>md5($pwd),'use_note'=>'pass'),' limit 1');
                $dealer_inf=$dealQuery->fetch();
                    if($dealer_inf){
                        $_SESSION['login'] = DOMAIN;
                        $_SESSION['dealer_id']=$dealer_inf['use_id'];
                        $_SESSION['dealer_grade']=$dealer_inf['use_grade'];
                        $_SESSION['dealer_rank']=$dealer_inf['use_rank'];
                        printAdminView('admin/view/blank.html.php', '潮品贸易');
                        exit;
                    }else{
                        include 'view/login.html.php';
                        exit;
                    }
            } else {
                $_SESSION['login'] = DOMAIN;
                $_SESSION['operator_id'] = $op_inf['id'];

//                $pms = pdoQuery('op_pms_tbl', null, array('o_id' => $op_inf['id']), null);
//                foreach ($pms as $row) {
////                    $_SESSION['pms'][$row['id']] = array($row['name'];
//                }
                printAdminView('admin/view/blank.html.php', 'Zaman Goz');
                exit;
            }

        }
        exit;
    }
    include 'view/login.html.php';
    exit;
}