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
		$this->params['subject'] = '【' . qa_opt('site_title') . '】お問い合わせありがとうございます(自動返信)';
		$this->params['body'] = $this->body_create($inparams, $ipaddress);
		$this->params['toname'] = $inparams['name'];
		$this->params['html'] = false;
	}

	private function body_create($params, $ipaddress = null)
	{
		$body = "お問い合わせありがとうございます。\n\n";

		$body .= "以下の内容でお問い合わせを受け付けました。このメールは自動送信されております。\n\n";

		$body .= "担当者からの返信をお待ち下さい。\n\n";

		$body .= "なお、お問い合わせから質問の投稿はできません。質問を投稿される方は、\n";
		$body .= "ユーザー登録後に以下のページから質問を投稿してください。\n\n";

		$body .= "質問投稿ページ：\n";
		$body .= qa_path('ask') . "\n\n";

		$body .= "------- お問い合わせ内容 ------\n";
		$body .= "コメント:\n";
		$body .= $params['message'] . "\n\n";

		$body .= "お名前:\n";
		$body .= $params['name']."\n\n";

		$body .= "メールアドレス:\n";
		$body .= $params['email']."\n\n";

		$body .= "直前のページ:\n";
		$body .= $params['previous']."\n\n";

		$body .= "IPアドレス:\n";
		$body .= $ipaddress."\n\n";

		$body .= "ブラウザ:\n";
		$body .= $params['browser']."\n";

		return $body;
	}

	public function send()
	{
		qa_send_email($this->params);
	}
}
