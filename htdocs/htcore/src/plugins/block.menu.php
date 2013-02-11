<?
function cDeep_block_menu($params, $content, &$cDeep)
{
        
        

        
	$Menu = $cDeep->obj['Site']->getMenu($params['start'], $params);
        
        $cDeep->assign('Test',$Menu);
	
	if (empty($content))
	{
		$cDeep->assign('Menu', $Menu);
	}
	else 
	{
		$cDeep->assign('Menu');
	}
        
        
        ////////////////////////// генерируем sitemap.xml

        $file = fopen("sitemap.xml", "w");
        $host=$_SERVER['SERVER_NAME'];
        
        $item = intval($cDeep->State['Item'][0]);
        $gallerys= $cDeep->obj['DB']->select('SELECT * FROM `p_gallery` WHERE `enabled`=1 AND `Parent`=?d order by `date` desc', $item);
        var_dump();
        $cDeep->assign('gallerys', $gallerys);

        $head= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        fwrite($file, $head);
        
        
        foreach ($gallerys as $gallery)
        {
            $url="<url>\n";
            $loc="\t<loc>".$host."/photo/" . $gallery['id'] . ".xml</loc>\n";
            $lastmod="\t<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $changefreq="\t<changefreq>monthly</changefreq>\n";
            $priority="\t<priority>1</priority>\n";
            $endurl="</url>\n";
            fwrite($file, $url); 
            fwrite($file, $loc); 
            fwrite($file, $lastmod); 
            fwrite($file, $changefreq); 
            fwrite($file, $priority); 
            fwrite($file, $endurl); 
        };
        
     //   foreach ($Menu as $t)
       //         echo $t['SUB'][0]['link'];
                //echo $Menu[0]['SUB'][0]['link'];
        
        
        foreach ($Menu as $m)
        {
            if($m['SUB'][0]['link'])
            {
                
                $url="<url>\n";
                $loc="\t<loc>".$host."" . $m['SUB'][0]['link'] . "</loc>\n";
                $lastmod="\t<lastmod>" . date('Y-m-d') . "</lastmod>\n";
                $changefreq="\t<changefreq>monthly</changefreq>\n";
                $priority="\t<priority>1</priority>\n";
                $endurl="</url>\n";
                fwrite($file, $url); 
                fwrite($file, $loc); 
                fwrite($file, $lastmod); 
                fwrite($file, $changefreq); 
                fwrite($file, $priority); 
                fwrite($file, $endurl); 
                
                if($m['SUB'][0]['SUB'][0]['link'])
                {
                    $url="<url>\n";
                    $loc="\t<loc>".$host."" . $m['SUB'][0]['SUB'][0]['link'] . "</loc>\n";
                    $lastmod="\t<lastmod>" . date('Y-m-d') . "</lastmod>\n";
                    $changefreq="\t<changefreq>monthly</changefreq>\n";
                    $priority="\t<priority>1</priority>\n";
                    $endurl="</url>\n";
                    fwrite($file, $url); 
                    fwrite($file, $loc); 
                    fwrite($file, $lastmod); 
                    fwrite($file, $changefreq); 
                    fwrite($file, $priority); 
                    fwrite($file, $endurl); 
                    
                
                }
                
                
                
            }
        };
        

        
        foreach ($Menu as $m)
        {
          
                 
             
                 
            $url="<url>\n";
            $loc="\t<loc>".$host."" . $m['link'] . "</loc>\n";
            $lastmod="\t<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $changefreq="\t<changefreq>monthly</changefreq>\n";
            $priority="\t<priority>1</priority>\n";
            $endurl="</url>\n";
            fwrite($file, $url); 
            fwrite($file, $loc); 
            fwrite($file, $lastmod); 
            fwrite($file, $changefreq); 
            fwrite($file, $priority); 
            fwrite($file, $endurl); 
        };

        
        $news= $cDeep->obj['DB']->select('SELECT * FROM `p_news` WHERE `enabled`=1', $item);
       // var_dump($news);
        $cDeep->assign('news', $news);    
        
        foreach ($news as $onenews)
        {
            
            $url="<url>\n";
            $loc="\t<loc>".$host."/news/" . $onenews['id'] . ".xml</loc>\n";
            $lastmod="\t<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $changefreq="\t<changefreq>monthly</changefreq>\n";
            $priority="\t<priority>1</priority>\n";
            $endurl="</url>\n";
            fwrite($file, $url); 
            fwrite($file, $loc); 
            fwrite($file, $lastmod); 
            fwrite($file, $changefreq); 
            fwrite($file, $priority); 
            fwrite($file, $endurl);
        }
        
        
        $bottom= "\n</urlset>\n";
        fwrite($file, $bottom);
        fclose($file); 

        ////////////////////////////////////////////////////////
        
        
	return $content;
}
?>