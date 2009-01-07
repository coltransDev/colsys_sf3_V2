<?
if ($reportes_pager->haveToPaginate()):   
	if ($reportes_pager->getPage() != 1):				
		 echo link_to(image_tag("first.png"), $url.'?page=1',"border=0 ") ;	
		 echo link_to(image_tag("previous.png"), $url.'?page='.$reportes_pager->getPreviousPage(),"border=0 ");									
	endif;		
   
	
  	foreach ($reportes_pager->getLinks() as $page): 
  		if( $page == $reportes_pager->getPage() ){
			echo $page;
		}else{
			echo link_to($page, $url.'?page='.$page	);	
		}
				
    	echo ($page != $reportes_pager->getCurrentMaxLink()) ? '-' : ''; 
  	endforeach; 
	if ($reportes_pager->getPage() != $reportes_pager->getLastPage() ):			
		 echo link_to(image_tag("next.png"), $url.'?page='.$reportes_pager->getNextPage(), "border=0 ");	
		 echo link_to(image_tag("last.png"), $url.'?page='.$reportes_pager->getLastPage(), "border=0 ");		
		
		
  	endif;
endif; 
?>
<br />
<br />