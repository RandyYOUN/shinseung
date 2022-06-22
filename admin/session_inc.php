<?php
  session_start();
  if( isset( $_SESSION[ 'USERNAME' ] ) ) {
    $jb_login = TRUE;
	$username = $_SESSION[ 'USERNAME' ];
	$userid = $_SESSION[ 'USERID' ];
	$depname = $_SESSION[ 'DEPNAME' ];
	$depid = $_SESSION[ 'DEPID' ];
	$depthid = $_SESSION[ 'DEPTH_ID' ];
	$position_id = $_SESSION[ 'POSITION_ID' ];
	$decid = $_SESSION[ 'DEC_ID' ];
  }


  $TITLE="신승 CRM";
?>