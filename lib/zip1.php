<?php
//error_reporting(0);


		use Facebook\FacebookSession;
		use Facebook\FacebookRedirectLoginHelper;
		use Facebook\FacebookRequest;
		use Facebook\FacebookResponse;
		use Facebook\FacebookSDKException;
		use Facebook\FacebookRequestException;
		use Facebook\FacebookAuthorizationException;
		use Facebook\GraphObject;

        include('include.php');
		if ( isset( $session ) )
		{
			$_SESSION['fb_login_session'] = $session;
			$_SESSION['fb_token'] = $session->getToken();
			$session = new FacebookSession( $session->getToken() );
            if(isset($_GET['ida']))
            {
                $alb_id=$_GET['ida'];
    			$request_album_photo=new FacebookRequest($session,'GET','/'.$alb_id.'/photos?fields=source');
    			$response_album_photo=$request_album_photo->execute();
    			$album_photo=$response_album_photo->getGraphObject()->asArray();
                if(isset($_REQUEST['album_id']))
{
	$response = array();
	$zip_name = $_SESSION['fbuser'];
	$zip_name=basename(str_replace(' ', '_', $zip_name));
	$zip_name = "./$zip_name.zip";
	$a_id=$_REQUEST['album_id'];

	$zip = new ZipArchive;
	if ($zip->open($zip_name,ZipArchive::CREATE) === TRUE){

		$a = $facebook->api("/{$a_id}");
		$a_name=$a['name'];
		if($zip->addEmptyDir($a_name)) {
			$photos = '';
			$photos = $facebook->api("/{$a_id}/photos");
			$photo = '';
		    if(!empty($album_photo))
    			{
    					foreach($album_photo['data'] as $alb)
    					{
    					        						$alb=(array) $alb;
					$tmp=rand(11,10000) .".jpeg";
					$str = file_get_contents($alb['source']);
					$zip->addFromString("$a_name/$tmp", $str) or die ("ERROR: Could not add file: ".$alb['source']);
			        }
            }
			$response['album_id'] = $a_id;
			$response['status'] = true;
			$response['url'] = 'download.php?filename='.$zip_name;

			$zip->close();
			echo json_encode($response);
		}
	}

}


    						echo "<img height='350px' width='350px' src='".$alb['source']."'/>";
    					}
    			}
            
            else//album id not set
            {

            }
		
?>

	



?>