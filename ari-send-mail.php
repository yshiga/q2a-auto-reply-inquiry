<?php

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

require_once QA_INCLUDE_DIR.'qa-app-options.php';
require_once QA_INCLUDE_DIR.'qa-app-emails.php';

class ari_send_mail
{
	private $params;

	public function __construct($inparams, $ipaddress)
	{
		$this->params = array();
		$this->params['fromemail'] = qa_opt('from_email');
		$this->params['fromname'] = qa_opt('site_title');
		$this->params['toemail'] = $inparams['email'];
		$this->params['subject'] = qa_lang_html_sub('auto_replay_inquiry_lang/subject', qa_opt('site_title'));
		$this->params['body'] = $this->body_create($inparams, $ipaddress);
		$this->params['toname'] = $inparams['name'];
		$this->params['html'] = false;
	}

	private function body_create($params, $ipaddress = null)
	{
		$body = qa_lang_html('auto_reply_inquiry_lang/body_header');

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/body_ask', qa_path('ask', null, qa_opt('site_url')));

		$body .= qa_lang_html('auto_reply_inquiry_lang/mail_body_naiyo');
		
		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_comment', $params['message']);;

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_name',  $params['name']);

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_email',  $params['email']);

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_previous', $params['previous']);

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_ipaddress', $ipaddress);

		$body .= qa_lang_html_sub('auto_reply_inquiry_lang/mail_body_browser', $params['browser']);

		return $body;
	}

	public function send()
	{
		qa_send_email($this->params);
	}
}
