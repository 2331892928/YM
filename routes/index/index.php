
<?php
/*
 * @作者：AMEN
 * @官网：https://www.ymypay.cn/
 * @博客：https://blog.ymypay.cn/
 * 湮灭网络工作室
 */
//示例路由，类名必须为Index，文件名无所谓
//第一个方法必须为start，且为public，因为他是入口
//其余最好是private，保护
//此框架可以在任意地方引入类以及函数，但如果是为了全局使用，请在根目录app.php引入
//如果是局部引入，使用前引入即可
class Index{
    public function start(YM_request $request){
        //通过这种方法当前请求是get还是post，这样就可以单独拦截，若post和get都接收，直接写即可
        //获取参数：$request->query_get()/body_post,已过滤xss
//        if($request->whetherGet()){
//            $this->get($request);
//        }else{
////            $this->post($request);
//            $request->error(405,'not post');
//        }
        //文件输出示例
        $this->text($request);
        //更多帮助请查看：https://ym-php.rkru.cn
    }
    private function get(YM_request $request){
        $request->send('现在是get');
        $request->send('cookies:');
        $request->send($request->cookies());
        $request->send('访问者ip：');
        $request->send($request->ip());

    }
    private function post(YM_request $request){
        $request->send('现在是post');
        $request->send('headar:');
        $request->send($request->header());
        $request->send('访问者ip：');
        $request->send($request->ip()); //若此ip返回不满意，可直接用 php原生获取ip

    }
    private function text(YM_request $request){
        include_once __includes__.'/class/AMEN.php';
        $AMEN = new AMEN();
        $params = $request->params();


        if(count($params)==1 && $params[0]==""){
            if($AMEN->is_mobile_request()){
                //读取header
//                $header = file_get_contents(__views__.'/index/MOBILE/header.html');
//                //导航栏
//                $navigationBar = file_get_contents(__views__.'/index/MOBILE/navigationBar.html');
//                //尾部
//                $top = file_get_contents(__views__.'/index/MOBILE/top.html');
                $request->render(__webSite__.'views/index/MOBILE/index.html');
            }else{
                //读取header
                $header = file_get_contents(__views__.'/index/PC/header.html');
                //导航栏
                $navigationBar = file_get_contents(__views__.'/index/PC/navigationBar.html');
                //home
                $home = file_get_contents(__views__.'/index/PC/home.html');
                //关于团队
                $about = file_get_contents(__views__.'/index/PC/about.html');
                //团队服务
                $service = file_get_contents(__views__.'/index/PC/service.html');
                //项目展示
                $project = file_get_contents(__views__.'/index/PC/project.html');
                //团队成员
                $team = file_get_contents(__views__.'/index/PC/team.html');
                //合作
                $merchantCooperation = file_get_contents(__views__.'/index/PC/merchantCooperation.html');
                //联系
                $contact = file_get_contents(__views__.'/index/PC/contact.html');
                //尾部
                $top = file_get_contents(__views__.'/index/PC/top.html');
                //工作室名称
                $gzs = "湮灭网络工作室";
                //工作室名言
                $my = "湮灭所有代码创造的世界";
                $res = ['header'=>$header,'navigationBar'=>$navigationBar,'home'=>$home, 'about'=>$about, 'service'=>$service, 'project'=>$project, 'team'=>$team, 'merchantCooperation'=>$merchantCooperation, 'contact'=>$contact,'top'=>$top, 'gzs'=>$gzs, 'my'=>$my];
                $res['ip'] = $request->ipV2(2);
                $request->render(__webSite__.'views/index/PC/index.html',$res);
            }
        }else if($params[0]=="sitemap.xml" or $params[0]=="robots.txt"){
//            $path = implode("/",$params);
//            $request->render(__webSite__.'views/index/'.$path);
            $request->render(__webSite__.$params[0]);
        }else{
            $request->send("你来到了页面未完成区域");
        }




    }
}