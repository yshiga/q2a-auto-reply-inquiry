<?php

require_once QA_PLUGIN_DIR.'q2a-auto-reply-inauiry/ari-send-mail.php';

class qa_auto_reply_inquiry
{

	function process_event($event, $userid, $handle, $cookieid, $params)
	{

		if ($event === 'feedback') {
			if (isset($params['email'])) {
				$ipaddress = qa_remote_ip_address();
				$autoreply = new ari_send_mail($params, $ipaddress);
				$autoreply->send();
			}
		}
	}
	//
	// private function get_oldquestion($postid = null)
	// {
	// 	$post = qa_db_single_select(qa_db_full_post_selectspec(null, $postid));
	// 	return $post;
	// }
}
