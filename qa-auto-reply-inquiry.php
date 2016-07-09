<?php

require_once QA_PLUGIN_DIR.'q2a-auto-reply-inquiry/ari-send-mail.php';

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
}
